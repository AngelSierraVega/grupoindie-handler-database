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
 * @since 18-02-14
 * @edit 
 * - Class implements \GIndie\DBHandler\Interfaces\Schema
 * - Abstract class
 * @version 00
 * @edit 18-04-06
 * - Added charset(), collation()
 * @edit 18-04-07
 * - Functional class
 * @version A0
 * @deprecated since 18-04-30
 * - Copied code to ..\MySQL56\Handler\Database, ..\MySQL56\Instance\Database
 * @edit 18-05-02
 * - Moved file from [base_dir]\MySQL to [base_dir]\Deprecated\MySQL
 * @version A1.00
 */
abstract class Schema implements \GIndie\DBHandler\Interfaces\Schema
{

    /**
     * 
     * @return boolean
     * @throws \GIndie\DBHandler\ExceptionDBHandler
     * @since 18-04-07
     * @deprecated since 18-04-30
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
     * @deprecated since 18-04-30
     */
    public static function stmCreate()
    {
        return Statement::createSchema(static::name(), static::charset(), static::collation());
    }

    /**
     * @since 18-04-06
     * @return string
     * @deprecated since 18-04-30
     */
    public static function charset()
    {
        return "utf8";
    }

    /**
     * @since 18-04-06
     * @return string
     * @deprecated since 18-04-30
     */
    public static function collation()
    {
        return "utf8_general_ci";
    }

}
