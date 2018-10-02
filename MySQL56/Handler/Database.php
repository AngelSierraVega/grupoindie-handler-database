<?php

/**
 * GI-DBHandler-DVLP - Database
 *
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * @copyright (c) 2018 Angel Sierra Vega. Grupo INDIE.
 *
 * @package GIndie\DBHandler\MySQL56\
 *
 * @version 00.A5
 * @since 18-04-30
 */

namespace GIndie\DBHandler\MySQL56\Handler;

use GIndie\DBHandler\MySQL56\DataDefinition;
use GIndie\DBHandler\MySQL56\Statement;

/**
 * 
 * @edit 18-04-30
 * - Added code from ..\MySQL\Schema
 * @edit 18-05-02
 * - Moved file from [base_dir]\MySQL56\Handler to [base_dir]\MySQL56
 * @edit 18-10-02
 * - Upgraded version
 * @todo
 * - Upgrade methods
 * - Handle schemma
 */
class Database
{

    /**
     *
     * @var \GIndie\DBHandler\MySQL56\DataDefinition\Instance\Database
     * @since 18-07-26
     */
    private $database;

    /**
     * 
     * @param \GIndie\DBHandler\MySQL56\Handler\DataDefinition\Identifiers\Database $databaseClass
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
     */
    public function execValidation()
    {
        $statement = Statement\DataManipulation::select(["DEFAULT_CHARACTER_SET_NAME", "DEFAULT_COLLATION_NAME"], ["INFORMATION_SCHEMA" => "SCHEMATA"]);
        $statement->addConditionEquals("SCHEMA_NAME", $this->database->name());
        $query = \GIndie\DBHandler\MySQL56::query($statement);
        $array = $query->fetch_assoc();
        switch (false)
        {
            //check if schema exists
            case ($query->num_rows > 0):
                //$this->exists = false;
                throw \GIndie\DBHandler\ExceptionDBHandler::databaseNotFound($this->database->name());
            //check if charset and collation are correctly defined
            case (\strcmp($array["DEFAULT_CHARACTER_SET_NAME"], $this->database->charset()) == 0):
                throw \GIndie\DBHandler\ExceptionDBHandler::invalidDefinition("DEFAULT_CHARACTER_SET_NAME", static::charset(), $array["DEFAULT_CHARACTER_SET_NAME"]);
            case (\strcmp($array["DEFAULT_COLLATION_NAME"], $this->database->collation()) == 0):
                throw \GIndie\DBHandler\ExceptionDBHandler::invalidDefinition("DEFAULT_COLLATION_NAME", static::collation(), $array["DEFAULT_COLLATION_NAME"]);
        }
        return true;
    }

    /**
     * @link <https://dev.mysql.com/doc/refman/5.7/en/create-database.html>
     * CREATE {DATABASE | SCHEMA} [IF NOT EXISTS] db_name
     * [DEFAULT] CHARACTER SET [=] charset_name
     * [DEFAULT] COLLATE [=] collation_name
     * @return \GIndie\DBHandler\MySQL56\Statement\CreateSchema
     * @since 18-04-06
     * @edit 18-04-07
     */
    public function stmCreate()
    {
        return Statement\DataDefinition::createDatabase($this->database->name(), $this->database->charset(), $this->database->collation());
    }

    /**
     * DROP DATABASE drops all tables in the database and deletes the database. Be 
     * very careful with this statement! To use DROP DATABASE, you need the DROP 
     * privilege on the database. DROP SCHEMA is a synonym for DROP DATABASE. 
     * 
     * IF EXISTS is used to prevent an error from occurring if the database does 
     * not exist.
     * 
     * If the default database is dropped, the default database is unset (the 
     * DATABASE() function returns NULL).
     * 
     * If you use DROP DATABASE on a symbolically linked database, both the link and 
     * the original database are deleted.
     * 
     * DROP DATABASE returns the number of tables that were removed. This 
     * corresponds to the number of .frm files removed.
     * 
     * The DROP DATABASE statement removes from the given database directory those 
     * files and directories that MySQL itself may create during normal operation
     * 
     * DROP {DATABASE | SCHEMA} [IF EXISTS] db_name
     * 
     * @link <https://dev.mysql.com/doc/refman/5.6/en/drop-database.html>
     * 
     * @param string $name
     * @return \GIndie\DBHandler\MySQL56\Statement\DataDefinition\DropDatabase
     * 
     * @since 18-08-02
     */
    public function stmDrop()
    {
        return Statement\DataDefinition::dropDatabase($this->database->name());
    }

    /**
     * @return \GIndie\DBHandler\MySQL56\DataDefinition\Instance\Database
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
     * @return array|\GIndie\DBHandler\MySQL56\Handler\Table
     * @since 18-08-07
     */
    public function getTables()
    {
        if (!isset($this->tables)) {
            $this->tables = [];
            foreach ($this->getDatabase()->getTableClassnames() as $tableClass) {
                $this->tables[$tableClass] = new \GIndie\DBHandler\MySQL56\Handler\Table($tableClass::instance());
            }
        }
        return $this->tables;
        //var_dump($expression)
//        return $this->getDatabase()->getTableClassnames();
    }

}
