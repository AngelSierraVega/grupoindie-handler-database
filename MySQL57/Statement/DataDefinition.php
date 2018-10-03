<?php

/**
 * GI-DBHandler-DVLP - DataDefinition
 *
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * @copyright (c) 2018 Angel Sierra Vega. Grupo INDIE.
 *
 * @package GIndie\DBHandler\MySQL57\Statement
 *
 * @version 00.75
 * @since 18-04-07
 * @todo Upgrade DocBlock
 */

namespace GIndie\DBHandler\MySQL57\Statement;

/**
 * 
 * @edit 18-05-03
 * - Moved file from [base_dir]\MySQL\Statement to [base_dir]\MySQL56\Statement
 * - Updated namespace
 * - createDatabase() Copied from [base_dir]\MySQL\Statement, updated return value
 * @edit 18-08-02
 * - Added dropDatabase()
 * @edit 18-08-15
 * - Added createTable()
 * @edit 18-08-16
 * - Added dropTable()
 * @edit 18-10-02
 * - Upgraded version
 * @edit 18-11-02
 * - Copied code from MySQL56\...
 */
class DataDefinition
{

    /**
     * 
     * @param string $tableName
     * @return \GIndie\DBHandler\MySQL57\Statement\DataDefinition\DropTable
     * @since 18-08-16
     */
    public static function dropTable($tableName)
    {
        return new DataDefinition\DropTable($tableName);
    }

    /**
     * 
     * @return \GIndie\DBHandler\MySQL57\Statement\DataDefinition\CreateTable
     * @since 18-08-15
     */
    public static function createTable($tableName)
    {
        return new DataDefinition\CreateTable($tableName);
    }

    /**
     * Creates a new Create Database Statement Object.
     * 
     * @param string $name
     * @param string $characterSet
     * @param string $collation
     * @return \GIndie\DBHandler\MySQL57\Statement\DataDefinition\CreateSchema
     * 
     * @since 18-04-07
     * @edit 18-05-03
     */
    public static function createDatabase($name, $characterSet, $collation)
    {
        return new DataDefinition\CreateSchema($name, $characterSet, $collation);
    }

    /**
     * 
     * @param string $name
     * @return \GIndie\DBHandler\MySQL57\Statement\DataDefinition\DropDatabase
     * 
     * @since 18-08-02
     */
    public static function dropDatabase($name)
    {
        return new DataDefinition\DropDatabase($name);
    }

}