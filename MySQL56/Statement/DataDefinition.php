<?php

/**
 * [Factory for] DataDefinition
 *
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * @copyright (c) 2018 Angel Sierra Vega. Grupo INDIE.
 *
 * @package GIndie\DBHandler\MySQL56\Statement
 *
 * @version 0A.30
 * @since 18-04-07
 */

namespace GIndie\DBHandler\MySQL56\Statement;

/**
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
 */
class DataDefinition
{

    /**
     * DROP TABLE removes one or more tables. You must have the DROP privilege for 
     * each table.
     *
     * Be careful with this statement! It removes the table definition and all table 
     * data. For a partitioned table, it permanently removes the table definition, 
     * all its partitions, and all data stored in those partitions. It also removes 
     * the partitioning definition (.par) file associated with the dropped table.
     * 
     * DROP TABLE causes an implicit commit, except when used with the TEMPORARY 
     * keyword. See Section 13.3.3, “Statements That Cause an Implicit Commit”.
     * 
     * Use IF EXISTS to prevent an error from occurring for tables that do not exist. 
     * Instead of an error, a NOTE is generated for each nonexistent table; these 
     * notes can be displayed with SHOW WARNINGS. See Section 13.7.5.41, “SHOW 
     * WARNINGS Syntax”.
     * 
     * IF EXISTS can also be useful for dropping tables in unusual circumstances 
     * under which there is an .frm file but no table managed by the storage engine. 
     * (For example, if an abnormal server exit occurs after removal of the table 
     * from the storage engine but before .frm file removal.)
     * 
     * The TEMPORARY keyword has the following effects:
     * - The statement drops only TEMPORARY tables.
     * - The statement does not cause an implicit commit.
     * - No access rights are checked. A TEMPORARY table is visible only with the 
     *   session that created it, so no check is necessary.
     * 
     * Using TEMPORARY is a good way to ensure that you do not accidentally drop a 
     * non-TEMPORARY table.
     * 
     * The RESTRICT and CASCADE keywords do nothing. They are permitted to make 
     * porting easier from other database systems.
     * 
     * @link <https://dev.mysql.com/doc/refman/5.6/en/drop-table.html>
     * 
     * @param string $tableName
     * @return \GIndie\DBHandler\MySQL56\Statement\DataDefinition\DropTable
     * @since 18-08-16
     */
    public static function dropTable($tableName)
    {
        return new DataDefinition\DropTable($tableName);
    }

    /**
     * https://dev.mysql.com/doc/refman/5.6/en/create-table.html
     * @return \GIndie\DBHandler\MySQL56\Statement\DataDefinition\CreateTable
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
     * @return \GIndie\DBHandler\MySQL56\Statement\DataDefinition\CreateSchema
     * 
     * @since 18-04-07
     * @edit 18-05-03
     */
    public static function createDatabase($name, $characterSet, $collation)
    {
        return new DataDefinition\CreateSchema($name, $characterSet, $collation);
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
    public static function dropDatabase($name)
    {
        return new DataDefinition\DropDatabase($name);
    }

}
