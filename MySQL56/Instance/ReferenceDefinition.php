<?php

/**
 * GI-DBHandler-DVLP - ReferenceDefinition
 *
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * @copyright (c) 2018 Angel Sierra Vega. Grupo INDIE.
 *
 * @package GIndie\DBHandler
 *
 * @version 0A.70
 * @since 18-08-20
 */

namespace GIndie\DBHandler\MySQL56\Instance;

/**
 * Description of ReferenceDefinition
 * 
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
     * @return \GIndie\DBHandler\MySQL56\Instance\ReferenceDefinition
     * @since 18-08-20
     */
    public function setPrimaryKey($reference)
    {
        $this->primaryKeyName = $reference;
        $this->references[] = "PRIMARY KEY (`{$reference}`)";
        return $this;
    }

    /**
     * 
     * @return string
     * @since 18-08-20
     */
    public function getPrimaryKeyName()
    {
        return $this->primaryKeyName;
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
        switch (true)
        {
            case \is_array($columnName):
                $rtnStr .= "(`" . \join("`,`", $columnName) . "`)";
                break;
            case \is_string($columnName):
                $rtnStr .= "(`{$columnName}`)";
                break;
            default:
                throw new \Exception("Unrecognized type for {$columnName}");
        }
        return $rtnStr;
    }

    /**
     * 
     * @param \GIndie\DBHandler\MySQL56\Instance\Table $tableInstance
     * @return string
     */
    private function formatedReference(Table $tableInstance)
    {
        $rtnStr = " REFERENCES `" . $tableInstance->name() . "` ";
        $rtnStr .= $this->formatedColName($tableInstance::referenceDefinition()->getPrimaryKeyName());
        return $rtnStr;
    }

    /**
     * [CONSTRAINT [symbol]] FOREIGN KEY
     * [index_name] (col_name,...) reference_definition
     * @param string $colName
     * @param \GIndie\DBHandler\MySQL56\Instance\Table $tableInstance
     * @param boolean|string $symbol
     * @return \GIndie\DBHandler\MySQL56\Instance\ReferenceDefinition
     * @throws \Exception
     * @since 18-08-20
     */
    public function addForeignKey($colName, Table $tableInstance, $symbol = false, $onDelete = "RESTRICT", $onUpdate = "NO ACTION")
    {
        $formatedColumn = "(`{$colName}`)";
        switch (true)
        {
            case ($symbol === true):
                throw new \Exception("@todo");
                break;
            case ($symbol === false):
                $this->references[] = "FOREIGN KEY {$formatedColumn}" . $this->formatedReference($tableInstance) . " ON DELETE {$onDelete} ON UPDATE {$onUpdate}";
                break;
            case \is_string($symbol):
                $this->references[] = "CONSTRAINT `{$symbol}` FOREIGN KEY {$formatedColumn}" . $this->formatedReference($tableInstance) . " ON DELETE {$onDelete} ON UPDATE {$onUpdate}";
                break;
            default:
                throw new \Exception("Unrecognized type for {$symbol}");
                break;
        }
        return $this;
    }

    /**
     * 
     * @param string $columnName
     * @param boolean|string $fullKeyname
     * @return \GIndie\DBHandler\MySQL56\Instance\ReferenceDefinition
     * @throws \Exception
     * @since 18-08-20
     */
    public function addUniqueKey($columnName, $fullKeyname = false)
    {
        $formatedColumn = $this->formatedColName($columnName);
        switch (true)
        {
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
        return $this;
    }

}
