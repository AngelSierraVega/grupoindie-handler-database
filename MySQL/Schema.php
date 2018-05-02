<?php

namespace GIndie\DBHandler\MySQL;

/**
 * DVLP-DBHandler - Schema
 *
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * @copyright (c) 2018 Angel Sierra Vega. Grupo INDIE.
 *
 * @package DatabaseHandler
 *
 * @version GI-DBH.00.00 18-02-14 Empty class created.
 * - Class implements \GIndie\DBHandler\Interfaces\Schema
 * - Abstract class
 * @edit 18-04-06
 * - Added charset(), collation()
 * @deprecated since 18-04-30
 * - Copied code to ..\MySQL56\Handler\Database, ..\MySQL56\Instance\Database
 */
abstract class Schema implements \GIndie\DBHandler\Interfaces\Schema
{

    /**
     * 
     * @return boolean
     * @throws \GIndie\DBHandler\ExceptionDBHandler
     * @since 18-04-07
     */
    public static function validateSchemaDefinition()
    {
        $query = \GIndie\DBHandler\MySQL::query(Statement::select(["DEFAULT_CHARACTER_SET_NAME", "DEFAULT_COLLATION_NAME"], ["INFORMATION_SCHEMA" => "SCHEMATA"])->addConditionEquals("SCHEMA_NAME", static::name()));
        $array = $query->fetch_assoc();
        switch (false)
        {
            //check if schema exists
            case ($query->num_rows > 0):
                throw \GIndie\DBHandler\ExceptionDBHandler::databaseNotFound(static::name());
            //check if charset and collation are correctly defined
            case (\strcmp($array["DEFAULT_CHARACTER_SET_NAME"], static::charset()) == 0):
                throw \GIndie\DBHandler\ExceptionDBHandler::invalidDefinition("DEFAULT_CHARACTER_SET_NAME", static::charset(), $array["DEFAULT_CHARACTER_SET_NAME"]);
            case (\strcmp($array["DEFAULT_COLLATION_NAME"], static::collation()) == 0):
                throw \GIndie\DBHandler\ExceptionDBHandler::invalidDefinition("DEFAULT_COLLATION_NAME", static::collation(), $array["DEFAULT_COLLATION_NAME"]);
        }
        return true;
    }

    /**
     * @link <https://dev.mysql.com/doc/refman/5.7/en/create-database.html>
     * CREATE {DATABASE | SCHEMA} [IF NOT EXISTS] db_name
     * [DEFAULT] CHARACTER SET [=] charset_name
     * [DEFAULT] COLLATE [=] collation_name
     * @return \GIndie\DBHandler\MySQL\Statement\CreateSchema
     * @since 18-04-06
     * @edit 18-04-07
     */
    public static function stmCreate()
    {
        return Statement::createSchema(static::name(), static::charset(), static::collation());
    }
    
    /**
     * @since 18-04-06
     * @return string
     */
    public static function charset()
    {
        return "utf8";
    }

    /**
     * @since 18-04-06
     * @return string
     */
    public static function collation()
    {
        return "utf8_general_ci";
    }

}
