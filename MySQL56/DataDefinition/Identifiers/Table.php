<?php

namespace GIndie\DBHandler\MySQL56\DataDefinition\Identifiers;

/**
 * GI-DBHandler-DVLP - Table
 * 
 * @link <https://dev.mysql.com/doc/refman/5.6/en/create-table.html>
 * @link <https://dev.mysql.com/doc/refman/5.6/en/create-table.html#create-table-name>
 *
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * @copyright (CC) 2020 Angel Sierra Vega. Grupo INDIE.
 * @license file://LICENSE
 *
 * @package GIndie\DBHandler\DataDefinition\MySQL56\
 *
 * @version 00.A0
 * @since 18-04-27
 * @edit 18-10-02
 * - Upgraded version
 */
interface Table
{

    /**
     * tbl_name
     * 
     * The table name can be specified as db_name.tbl_name to create the table in 
     * a specific database. This works regardless of whether there is a default 
     * database, assuming that the database exists. If you use quoted identifiers, 
     * quote the database and table names separately. For example, write `mydb`.`mytbl`, 
     * not `mydb.mytbl`.
     * 
     * Rules for permissible table names are given in Section 9.2, “Schema Object Names”.
     * <https://dev.mysql.com/doc/refman/5.6/en/identifiers.html>
     * 
     * @since 18-04-29
     */
    public static function name();

    /**
     * 
     * The table name can be specified as db_name.tbl_name to create the table in 
     * a specific database. This works regardless of whether there is a default 
     * database, assuming that the database exists. If you use quoted identifiers, 
     * quote the database and table names separately. For example, write `mydb`.`mytbl`, 
     * not `mydb.mytbl`.
     * 
     * Rules for permissible table names are given in Section 9.2, “Schema Object Names”.
     * <https://dev.mysql.com/doc/refman/5.6/en/identifiers.html>
     * 
     * @since 18-04-29
     */
    public static function databaseName();

    /**
     * 
     * @return array
     * @since 18-04-27
     * @edit 18-04-30
     * - Defined attributes and return
     */
    public static function columns();

    /**
     * 
     * @param string $name
     * @param \GIndie\DBHandler\MySQL56\DataDefinition\Identifiers\Column\Definition\DataType $dataType
     * 
     * @return \GIndie\DBHandler\MySQL56\DataDefinition\Identifiers\Column
     * 
     * @since 18-04-27
     * @edit 18-04-30
     * - Defined attributes and return
     */
    public static function columnDefinition($name, Column\Definition\DataType $dataType);

    /**
     * [reference_definition] = ([keys] [constraints] [foreign_keys])
     * 
     * @since 18-04-30
     * @todo 
     * - Description
     * @return string
     */
    public static function referenceDefinition();
}
