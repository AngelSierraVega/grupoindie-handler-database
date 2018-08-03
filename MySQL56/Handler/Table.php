<?php

/**
 * GI-DBHandler-DVLP - Table
 *
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * @copyright (c) 2018 Angel Sierra Vega. Grupo INDIE.
 *
 * @package GIndie\DBHandler\MySQL56\
 *
 * @version 0A.80
 * @since 18-08-05
 */

namespace GIndie\DBHandler\MySQL56\Handler;

use GIndie\DBHandler\MySQL56\DataDefinition;
use GIndie\DBHandler\MySQL56\Statement;
use GIndie\DBHandler\MySQL56\Instance;

/**
 * 
 */
class Table
{

    /**
     *
     * @var \GIndie\DBHandler\MySQL56\DataDefinition\Instance\Table
     * @since 18-08-05
     */
    private $table;

    /**
     * 
     * @param \GIndie\DBHandler\MySQL56\Handler\DataDefinition\Identifiers\Table $tableInstance
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
        $query = \GIndie\DBHandler\MySQL56::query($statement);
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
        $result = \GIndie\DBHandler\MySQL56::query($query);
        return $result;
    }

    /**
     * 
     * @return boolean
     * @since 18-08-15
     * @edit 18-08-20
     * - Added reference definition
     * @todo
     * - ¿Throw exception?
     */
    public function createTable()
    {
        $query = Statement\DataDefinition::createTable($this->getTable()->name());
        $query->setDatabaseName($this->getTable()->databaseName());
        foreach ($this->getTable()->columns() as $columnName => $columnDefinition) {
            $query->addColumnDefinition($columnName . " " . $columnDefinition->getColumnDefinition());
        }
        $query->setReferenceDefinition($this->getTable()->referenceDefinition()->getReferences());
        return \GIndie\DBHandler\MySQL56::query($query);
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
        return \GIndie\DBHandler\MySQL56::query($query);
    }

    /**
     * @return \GIndie\DBHandler\MySQL56\Instance\Table
     * @since 18-08-02
     */
    public function getTable()
    {
        return $this->table;
    }

}
