<?php

/**
 * GI-DBHandler-DVLP - Table
 *
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * @copyright (c) 2018 Angel Sierra Vega. Grupo INDIE.
 *
 * @package GIndie\DBHandler\MySQL57
 *
 * @version 00.90
 * @since 18-11-02
 */

namespace GIndie\DBHandler\MySQL57\Handler;

use GIndie\DBHandler\MySQL57\DataDefinition;
use GIndie\DBHandler\MySQL57\Statement;

/**
 * @edit 18-10-01
 * - Upgraded delete()
 * @edit 18-10-02
 * - Upgraded version
 * @edit 18-11-01
 * - Moved stmSelect(), getAssocByAttribute(), getAssocById() from Deprecated\Mysql\Table
 * @todo Validate moved methods
 * @edit 18-11-02
 * - Copied code from \GIndie\DBHandler\MySQL56\...
 */
class Table
{

    /**
     *
     * @var \GIndie\DBHandler\MySQL57\DataDefinition\Instance\Table
     * @since 18-08-05
     */
    private $table;

    /**
     * 
     * @param \GIndie\DBHandler\MySQL57\Handler\DataDefinition\Identifiers\Table $tableInstance
     * @since 18-08-05
     */
    public function __construct(DataDefinition\Identifiers\Table $tableInstance)
    {
        $this->table = $tableInstance;
    }

    /**
     * 
     * @return boolean
     * @throws \GIndie\DBHandler\ExceptionDBHandler
     * @since 18-08-05
     * @edit 18-08-07
     * - Check if table exists
     * @todo
     * - Other validations
     */
    public function execValidation()
    {

        /**
         * Checks if table exists
         * CHECK TABLE test_table FAST QUICK;
         */
        $statement = Statement\DataManipulation::select(["count(*)"], ["INFORMATION_SCHEMA" => "TABLES"]);
        $statement->addConditionEquals("TABLE_SCHEMA", $this->table->databaseName());
        $statement->addConditionEquals("TABLE_NAME", $this->table->name());
        $statement = "CHECK TABLE `{$this->table->databaseName()}`.`{$this->table->name()}` QUICK;";
        $query = \GIndie\DBHandler\MySQL57::query($statement);
        $array = $query->fetch_array();
        switch ($array[3])
        {
            case "OK":
                break;
            default:
                /**
                 * 
                 */
                throw \GIndie\DBHandler\ExceptionDBHandler::checkTable($array[3]);
                break;
        }
        return true;
    }

    /**
     * 
     * @return \mysqli_result|boolean <b>FALSE</b> on failure. For successful SELECT, 
     * SHOW, DESCRIBE or EXPLAIN queries <b>mysqli_query</b> will return a 
     * <b>mysqli_result</b> object. For other successful queries <b>mysqli_query</b> 
     * will return <b>TRUE</b>.
     * @since 18-08-16
     */
    public function showColumns()
    {
        $query = Statement\DataAdministration::showColulmns($this->getTable()->name());
        $query->setDatabaseName($this->getTable()->databaseName());
        $result = \GIndie\DBHandler\MySQL57::query($query);
        return $result;
    }

    /**
     * 
     * @return string
     * @since 18-08-25
     */
    public function countRows()
    {
        $query = Statement\DataManipulation::select(["COUNT(*)"], $this->getTableReference());
        $result = \GIndie\DBHandler\MySQL57::query($query);
        return $result->fetch_row()[0];
    }

    /**
     * 
     * @return array
     * @since 18-08-26
     */
    public function getTableReference()
    {
        return [$this->getTable()->databaseName() => $this->getTable()->name()];
    }

    /**
     * 
     * @param type $conditions
     * @return boolean
     * @throws \Exception
     * @since 18-08-29
     * @edit 18-10-01
     * - Graciously handle IS NULL condition
     */
    public function delete($conditions)
    {
        $query = Statement\DataManipulation::delete($this->getTableReference());
        foreach ($conditions as $key => $value) {
            if (\is_null($value)) {
                $query->addConditionIsNull($key);
//                $value = "NULL";
            } else {
                $query->addConditionEquals($key, $value);
            }
        }
        //throw new \Exception($query);
        $result = \GIndie\DBHandler\MySQL57::query($query);
        if (\GIndie\DBHandler\MySQL57::getConnection()->affected_rows < 1) {
            throw new \Exception("QUERY: {$query}<br>NO AFFECTED ROWS");
        }
//        $this->getTable()->columns();
//        var_dump($this->getTable()->referenceDefinition());
//        var_dump($this->getTable()->referenceDefinition()->getPrimaryKeyName());
//        var_dump($value);
        if ($result === false) {
            throw new \Exception("QUERY: {$query}<br>ERROR: " . \GIndie\DBHandler\MySQL57::getConnection()->error);
        }
        return true;
    }

    /**
     * @param mixed $value
     * @return boolean
     * @since 18-08-26
     * @edit 18-08-29
     */
    public function deleteById($value)
    {
        $query = Statement\DataManipulation::delete($this->getTableReference());
        $query->addConditionEquals($this->getTable()->referenceDefinition()->getPrimaryKeyName(), $value);
        $result = \GIndie\DBHandler\MySQL57::query($query);
        $this->getTable()->columns();
        var_dump($this->getTable()->referenceDefinition());
        var_dump($this->getTable()->referenceDefinition()->getPrimaryKeyName());
        var_dump($value);
        if ($result === false) {
            throw new \Exception("QUERY: {$query}<br>ERROR: " . \GIndie\DBHandler\MySQL57::getConnection()->error);
        }
        return true;
    }

    /**
     * 
     * @param type $insertData
     * @since 18-08-26
     */
    public function insert($insertData)
    {
        $query = Statement\DataManipulation::insert($this->getTableReference(), $insertData);
        $result = \GIndie\DBHandler\MySQL57::query($query);
        if ($result === false) {
//            var_dump($insertData);
            throw new \Exception("QUERY: {$query}<br>ERROR: " . \GIndie\DBHandler\MySQL57::getConnection()->error);
        }
        return true;
    }

    /**
     * 
     * @return array
     * @since 18-08-26
     */
    public function selectAll()
    {
        $query = Statement\DataManipulation::select(["*"], [$this->getTable()->databaseName() => $this->getTable()->name()]);
        $result = \GIndie\DBHandler\MySQL57::query($query);
        return $result->fetch_all(\MYSQLI_ASSOC);
    }

    /**
     * 
     * @return boolean
     * @since 18-08-15
     * @edit 18-08-20
     * - Added reference definition
     * @edit 18-08-26
     * - Formatted column name
     * @todo
     * - ¿Throw exception?
     */
    public function createTable()
    {
        $query = Statement\DataDefinition::createTable($this->getTable()->name());
        $query->setDatabaseName($this->getTable()->databaseName());
        foreach ($this->getTable()->columns() as $columnName => $columnDefinition) {
            $query->addColumnDefinition("`{$columnName}` " . $columnDefinition->getColumnDefinition());
        }
        $query->setReferenceDefinition($this->getTable()->referenceDefinition()->getReferences());
//        var_dump($query . "");
        return \GIndie\DBHandler\MySQL57::query($query);
    }

    /**
     * 
     * @return boolean
     * @since 18-08-16
     * @todo
     * - ¿Throw exception?
     */
    public function dropTable()
    {
        $query = Statement\DataDefinition::dropTable($this->getTable()->name());
        $query->setDatabaseName($this->getTable()->databaseName());
        return \GIndie\DBHandler\MySQL57::query($query);
    }

    /**
     * @return \GIndie\DBHandler\MySQL57\Instance\Table
     * @since 18-08-02
     */
    public function getTable()
    {
        return $this->table;
    }

    /**
     * 
     * @return \GIndie\DBHandler\MySQL\Statement\Select
     * @since 18-02-15
     * @edit 18-11-01
     * - Moved from Deprecated\Mysql\Table
     * @todo Upgrade
     * @todo ¿deprecated?
     */
    public static function stmSelect()
    {
        return Statement::select(["*"], [static::schemaName() => static::name()]);
    }

    /**
     * 
     * @param string $attributeName
     * @param mixed $attributeValue
     * @return array
     * 
     * @since 18-02-22
     * @edit 18-05-05
     * - Simple error handling
     * @edit 18-11-01
     * - Moved from Deprecated\Mysql\Table
     * @todo Upgrade
     * @todo ¿deprecated?
     */
    public static function getAssocByAttribute($attributeName, $attributeValue)
    {
        $rtnArray = null;
        $Select = static::stmSelect();
        $Select->addConditionEquals($attributeName, $attributeValue);
        $Query = \GIndie\DBHandler\MySQL::query($Select);
        if ($Query) {
            switch ($Query->num_rows)
            {
                case 0:
                    break;
                default:
                    $rtnArray = $Query->fetch_assoc();
            }
        } else {
            \trigger_error(\GIndie\DBHandler\MySQL::getConnection()->error, \E_USER_ERROR);
        }
        return $rtnArray;
    }

    /**
     * 
     * @param mixed $id
     * @return array
     * 
     * @since 18-02-22
     * @deprecated since 18-05-02
     * @edit 18-11-01
     * - Moved from Deprecated\Mysql\Table
     * @todo Upgrade
     * @todo ¿deprecated?
     */
    public static function getAssocById($id)
    {
        return static::getAssocByAttribute(static::primaryKeyName(), $id);
    }

}
