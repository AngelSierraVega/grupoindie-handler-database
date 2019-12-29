<?php

/**
 * GI-DBHandler-DVLP - ReferenceDefinition
 *
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * @copyright (c) 2018 Angel Sierra Vega. Grupo INDIE.
 *
 * @package GIndie\DBHandler\MySQL57\Instance
 *
 * @version 00.CA
 * @since 18-11-02
 * @todo Upgrade DocBlock
 */

namespace GIndie\DBHandler\MySQL57\Instance;

/**
 * 
 * @edit 18-08-27
 * - Updated formatedReference()
 * @edit 18-10-02
 * - Upgraded version
 * @edit 18-11-02
 * - Copied code from \GIndie\DBHandler\MySQL56\...
 * @edit 18-11-06
 * - Handles foreing keys on custom column
 * @edit 18-11-07
 * - Created addIndex()
 * @edit 19-02-15
 * - Added $foreignKeys, getForeignKeys()
 * @edit 19-12-29
 * - Added $uniqueColumns , getUniqueColumns(), getUniqueKeyName()
 * - Handle use of unique columns
 */
class ReferenceDefinition
{

    /**
     *
     * @var array
     * @since 18-08-20
     */
    private $references = [];

    /**
     *
     * @var array Stores the foreign key definitions
     * @since 19-02-15
     */
    private $foreignKeys = [];

    /**
     *
     * @var array Stores the unique column names
     * @since 19-12-29
     */
    private $uniqueColumns = [];

    /**
     * Gets an array with the column names defined as unique
     * @return array
     */
    public function getUniqueColumns()
    {
        return $this->uniqueColumns;
    }

    /**
     * 
     * @return array
     * @since 19-02-15
     */
    public function getForeignKeys()
    {
        return $this->foreignKeys;
    }

    /**
     * 
     * @return array
     * @since 18-08-20
     */
    public function getReferences()
    {
        return $this->references;
    }

    /**
     *
     * @var string 
     */
    private $primaryKeyName;

    /**
     * 
     * @param string $reference
     * @return \GIndie\DBHandler\MySQL57\Instance\ReferenceDefinition
     * @since 18-08-20
     * @edit 18-11-02
     * - Handle array on reference
     * @edit 19-12-29
     * - Handle unique columns
     */
    public function setPrimaryKey($reference, $orderIndex = false)
    {
        $this->primaryKeyName = $reference;
        switch (true) {
            case \is_array($reference):
                $reference = \join("`,`", $reference);
                break;

            default:
                break;
        }
        $tmp = "PRIMARY KEY (`{$reference}`";
        $tmp .= $orderIndex !== false ? " {$orderIndex})" : ")";
        $this->references[] = $tmp;
        $this->uniqueColumns[] = $this->primaryKeyName;
        return $this;
    }

    /**
     * Gets the defined primary key name
     * 
     * @return string
     * @since 18-08-20
     */
    public function getPrimaryKeyName()
    {
        return $this->primaryKeyName;
    }

    /**
     * Gets the (last) defined unique key name
     * 
     * @return string
     * @since 19-12-29
     */
    public function getUniqueKeyName()
    {
        return $this->uniqueColumns[\count($this->uniqueColumns) - 1];
    }

    /**
     * 
     * @param string|array $colName
     * @return string
     * @throws \Exception
     */
    private function formatedColName($columnName)
    {
        $rtnStr = "";
        switch (true) {
            case \is_array($columnName):
                $rtnStr .= "(`" . \join("`,`", $columnName) . "`)";
                break;
            case \is_string($columnName):
                $rtnStr .= "(`{$columnName}`)";
                break;
            default:
                var_dump($columnName);
                throw new \Exception("Unrecognized type for {$columnName}");
        }
        return $rtnStr;
    }

    /**
     * 
     * @param \GIndie\DBHandler\MySQL56\Instance\Table $tableInstance
     * @param string|array $columnName
     * 
     * @return string
     * 
     * @since 18-08-20
     * @edit 18-08-27
     * @edit 18-11-06
     * - Added param $columnName
     * - Use new param $columnName
     */
    private function formatedReference(Table $tableInstance, $columnName)
    {
        $dbName = $tableInstance->databaseName();
        $rtnStr = " REFERENCES `{$dbName}`.`" . $tableInstance->name() . "` ";
//        $pkName = $tableInstance::referenceDefinition()->getPrimaryKeyName();
        $rtnStr .= $this->formatedColName($columnName);
        return $rtnStr;
    }

    /**
     * [CONSTRAINT [symbol]] FOREIGN KEY
     * [index_name] (col_name,...) reference_definition
     * @param string $colName
     * @param string|array $tableClass If string construct foreing key of class
     *      if array [$tableClass => $referenceColumn]
     * @param boolean|string $symbol
     * @return \GIndie\DBHandler\MySQL57\Instance\ReferenceDefinition
     * @throws \Exception
     * @since 18-08-20
     * @edit 18-11-03
     * - Param $tableInstance is now string
     * @edit 18-11-06
     * - Renamed param from $tableInstance to $tableClass
     * - Handles $tableClass is array
     * @edit 18-12-03
     * - Debuged foreign key
     * @edit 19-02-15
     * - Added foreing key
     */
    public function addForeignKey($colName, $tableClass, $symbol = false, $onDelete = "RESTRICT", $onUpdate = "NO ACTION")
    {
        if (\is_array($tableClass)) {
//            var_dump($tableClass);
            $referenceColumn = \array_values($tableClass)[0];
            $tableClass = \array_keys($tableClass)[0];
//            var_dump($tableClass);
        }
        if (\is_string($tableClass)) {
            if (\is_a($tableClass, Table::class, true)) {
                $tableInstance = $tableClass::instance();
                $tableInstance->columns();
            }
        } else {
            \trigger_error("tableClass should be string, called in " . \get_called_class(),
                \E_USER_ERROR);
        }
        $formatedColumn = "(`{$colName}`)";
        switch (true) {
            case ($symbol === true):
                throw new \Exception("@todo");
                break;
            case ($symbol === false):
                if (!isset($referenceColumn)) {
                    $referenceColumn = $tableInstance::referenceDefinition()->getPrimaryKeyName();
                }
                $this->references[] = "FOREIGN KEY {$formatedColumn}" .
                    $this->formatedReference($tableInstance, $referenceColumn) .
                    " ON DELETE {$onDelete} ON UPDATE {$onUpdate}";
                break;
            case \is_string($symbol):
                if (!isset($referenceColumn)) {
                    $referenceColumn = $tableInstance::referenceDefinition()->getPrimaryKeyName();
                }
                if (!isset($referenceColumn)) {
                    \trigger_error("PK not found for {$tableClass}", \E_USER_ERROR);
                }
                $this->references[] = "CONSTRAINT `{$symbol}` FOREIGN KEY {$formatedColumn}" .
                    $this->formatedReference($tableInstance, $referenceColumn) .
                    " ON DELETE {$onDelete} ON UPDATE {$onUpdate}";
                $this->foreignKeys[$colName] = $tableClass;
                break;
            default:
                throw new \Exception("Unrecognized type for {$symbol}");
                break;
        }
        return $this;
    }

    /**
     * 
     * @param type $columnName
     * @param type $indexName
     * @since 18-11-07
     */
    public function addIndex($columnName, $indexName)
    {
        $this->references[] = "INDEX `{$indexName}` (`{$columnName}`)";
        //`predio_n_cta` (`id_cuenta`)
    }

    /**
     * 
     * @param string $columnName
     * @param boolean|string $fullKeyname
     * @return \GIndie\DBHandler\MySQL57\Instance\ReferenceDefinition
     * @throws \Exception
     * @since 18-08-20
     * @edit 19-12-29
     * - Handle unique columns
     */
    public function addUniqueKey($columnName, $fullKeyname = false)
    {
        $formatedColumn = $this->formatedColName($columnName);
        switch (true) {
            case ($fullKeyname === true):
                throw new \Exception("@todo");
                $this->references[] = "UNIQUE KEY `idxnq_{$columnName}` {$formatedColumn}";
                break;
            case ($fullKeyname === false):
                $this->references[] = "UNIQUE KEY {$formatedColumn}";
                break;
            case \is_string($fullKeyname):
                $this->references[] = "UNIQUE KEY `{$fullKeyname}` {$formatedColumn}";
                break;
            default:
                throw new \Exception("Unrecognized type for {$fullKeyname}");
                break;
        }
        $this->uniqueColumns[] = $columnName;
        return $this;
    }

}
