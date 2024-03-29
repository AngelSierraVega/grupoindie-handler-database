<?php

/**
 * GI-DBHandler-DVLP - Database
 *
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * @copyright (CC) 2020 Angel Sierra Vega. Grupo INDIE.
 * @license file://LICENSE
 *
 * @package GIndie\DBHandler\MySQL57
 *
 * @version DOING
 * @since 18-11-02
 */

namespace GIndie\DBHandler\MySQL57\Handler;

use GIndie\DBHandler\MySQL57\DataDefinition;
use GIndie\DBHandler\MySQL57\Statement;

/**
 * 
 * @edit 18-11-02
 * - Copied code from \GIndie\DBHandler\MySQL56\...
 */
class Database
{

    /**
     *
     * @var \GIndie\DBHandler\MySQL57\DataDefinition\Instance\Database
     * @since 18-07-26
     */
    private $database;

    /**
     * 
     * @param \GIndie\DBHandler\MySQL57\Handler\DataDefinition\Identifiers\Database $databaseClass
     * @since 18-07-26
     */
    public function __construct(DataDefinition\Identifiers\Database $databaseClass)
    {
        $this->database = $databaseClass;
    }

    /**
     * 
     * @return boolean
     * @throws \GIndie\DBHandler\ExceptionDBHandler
     * @since 18-04-07
     * @edit 18-04-30
     * @edit 19-01-09
     * - Validation from \GIndie\DBHandler\MySQL57::defaultGlobalVars() 
     */
    public function execValidation()
    {
        $statement = Statement\DataManipulation::select(["DEFAULT_CHARACTER_SET_NAME", "DEFAULT_COLLATION_NAME"],
                ["INFORMATION_SCHEMA" => "SCHEMATA"]);
        $statement->addConditionEquals("SCHEMA_NAME", $this->database->name());
        $query = \GIndie\DBHandler\MySQL57::query($statement);
//        $array = $query->fetch_assoc();
//        $array = \GIndie\DBHandler\MySQL57::defaultGlobalVars();
        switch (false)
        {
            //check if schema exists
            case ($query->num_rows > 0):
                //$this->exists = false;
                throw \GIndie\DBHandler\ExceptionDBHandler::databaseNotFound($this->database->name());
            /**
             * Check if charset and collation are correctly defined
             * @edit 19-01-09
             */
            case (\strcmp(\GIndie\DBHandler\MySQL57::defaultGlobalVars()["character_set_database"],
                $this->database->charset()) == 0):
                throw \GIndie\DBHandler\ExceptionDBHandler::invalidDefinition("DEFAULT_CHARACTER_SET_NAME",
                    $this->database->charset(),
                    \GIndie\DBHandler\MySQL57::defaultGlobalVars()["character_set_database"]);
            case (\strcmp(\GIndie\DBHandler\MySQL57::defaultGlobalVars()["collation_database"],
                $this->database->collation()) == 0):
                throw \GIndie\DBHandler\ExceptionDBHandler::invalidDefinition("DEFAULT_COLLATION_NAME",
                    $this->database->collation(),
                    \GIndie\DBHandler\MySQL57::defaultGlobalVars()["collation_database"]);
        }
        return true;
    }

    /**
     * @link <https://dev.mysql.com/doc/refman/5.7/en/create-database.html>
     * CREATE {DATABASE | SCHEMA} [IF NOT EXISTS] db_name
     * [DEFAULT] CHARACTER SET [=] charset_name
     * [DEFAULT] COLLATE [=] collation_name
     * @return \GIndie\DBHandler\MySQL57\Statement\CreateSchema
     * @since 18-04-06
     * @edit 18-04-07
     */
    public function stmCreate()
    {
        return Statement\DataDefinition::createDatabase($this->database->name(),
                $this->database->charset(), $this->database->collation());
    }

    /**
     * @param string $name
     * @return \GIndie\DBHandler\MySQL57\Statement\DataDefinition\DropDatabase
     * 
     * @since 18-08-02
     */
    public function stmDrop()
    {
        return Statement\DataDefinition::dropDatabase($this->database->name());
    }

    /**
     * @return \GIndie\DBHandler\MySQL57\DataDefinition\Instance\Database
     * @since 18-08-02
     */
    public function getDatabase()
    {
        return $this->database;
    }

    /**
     *
     * @var type 
     * @since 18-08-07
     */
    private $tables;

    /**
     * 
     * @return array|\GIndie\DBHandler\MySQL57\Handler\Table
     * @since 18-08-07
     */
    public function getTables()
    {
        if (!isset($this->tables)) {
            $this->tables = [];
            foreach ($this->getDatabase()->getTableClassnames() as $tableClass) {
                $this->tables[$tableClass] = new \GIndie\DBHandler\MySQL57\Handler\Table($tableClass::instance());
            }
        }
        return $this->tables;
    }

}
