<?php

namespace GIndie\DBHandler\MySQL56\Handler;

/**
 * GI-DBHandler-DVLP - Database
 *
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * @copyright (c) 2018 Angel Sierra Vega. Grupo INDIE.
 *
 * @package GIndie\DBHandler\MySQL56\
 *
 * @version 0A.40
 * 
 * @since 18-04-30
 * @edit 18-04-30
 * - Added code from ..\MySQL\Schema
 * @edit 18-05-02
 * - Moved file from [base_dir]\MySQL56\Handler to [base_dir]\MySQL56
 * @todo
 * - Upgrade methods
 * - Handle schemma
 */
class Database
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

}
