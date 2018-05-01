<?php

namespace GIndie\DBHandler\MySQL56\DataDefinition\Column;

/**
 * Once defined the table and the column name, [this class] defines the specification
 * of a Column. Note: Indexes and references are defined at table-level.
 * 
 * MySQL 5.6 structure:
 * 
 * [column_definition] = [data_type] [NOT NULL | NULL] [DEFAULT default_value] [AUTO_INCREMENT] 
 * [COMMENT 'string'] [COLUMN_FORMAT {FIXED|DYNAMIC|DEFAULT}] [STORAGE {DISK|MEMORY|DEFAULT}]
 * 
 * @link <https://dev.mysql.com/doc/refman/5.6/en/create-table.html#create-table-types-attributes>
 * 
 * Note on NOT NULL: In MySQL 5.6, only the InnoDB, MyISAM, and MEMORY storage engines support indexes on 
 * columns that can have NULL values. In other cases, you must declare indexed columns as 
 * NOT NULL or an error results.
 * 
 * Note on DEFAULT: If the NO_ZERO_DATE or NO_ZERO_IN_DATE SQL mode is enabled and a date-valued default is 
 * not correct according to that mode, CREATE TABLE produces a warning if strict SQL mode is 
 * not enabled and an error if strict mode is enabled. For example, with NO_ZERO_IN_DATE 
 * enabled, c1 DATE DEFAULT '2010-00-00' produces a warning.
 * 
 * Note on AUTOINCREMENT: For MyISAM tables, you can specify an AUTO_INCREMENT secondary column in a 
 *  multiple-column key. See Section 3.6.9, “Using AUTO_INCREMENT”.
 *  To make MySQL compatible with some ODBC applications, you can find the AUTO_INCREMENT 
 *  value for the last inserted row with the following query:
 *    SELECT * FROM tbl_name WHERE auto_col IS NULL
 *    This method requires that sql_auto_is_null variable is not set to 0. See Section 5.1.7, 
 *    “Server System Variables”.
 *  For information about InnoDB and AUTO_INCREMENT, see Section 14.8.1.5, “AUTO_INCREMENT 
 *  Handling in InnoDB”. For information about AUTO_INCREMENT and MySQL Replication, see 
 *  Section 17.4.1.1, “Replication and AUTO_INCREMENT”.
 * 
 * Only the InnoDB and MyISAM storage engines support indexing on BLOB and TEXT columns. 
 * For example: CREATE TABLE test (blob_col BLOB, INDEX(blob_col(10)));
 * 
 *
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * @copyright (c) 2018 Angel Sierra Vega. Grupo INDIE.
 *
 * @package DatabaseHandler
 * @subpackage MySQL56
 *
 * @version 00 
 * @since 18-04-29
 * - Added methods from GIndie\DBHandler\MySQL56\DataDefinition\Column
 * @edit 18-05-01
 * - Defined constructor and main setters and getters
 * @version A0
 */
interface Definition
{

    /**
     * Once defined the table and the column name, [this class] defines the specification
     * of a Column.
     * 
     * @link <https://dev.mysql.com/doc/refman/5.6/en/create-table.html#create-table-types-attributes>
     * 
     * @param \GIndie\DBHandler\MySQL56\DataDefinition\Column\Definition\DataType $dataType 
     * Represents the data type in a column definition. spatial_type represents
     * a spatial data type. The data type syntax shown is representative only. For a full 
     * description of the syntax available for specifying column data types, as well as 
     * information about the properties of each type, see Chapter 11, Data Types, and 
     * Section 11.5, “Spatial Data Types”.
     * 
     * @since 18-05-01
     */
    public function __construct(Definition\DataType $dataType);

    /**
     * If neither NULL nor NOT NULL is specified, the column is treated as though NULL had 
     * been specified.
     * 
     * @param boolean $value 
     * @return \Self
     * 
     * @since 18-04-27
     * @edit 18-05-01
     * - Defined interface for setter.
     */
    public function setNotNull($value = true);

    /**
     * Specifies a default value for a column. With one exception, the default value must be a 
     * constant; it cannot be a function or an expression. This means, for example, that you 
     * cannot set the default for a date column to be the value of a function such as NOW() or 
     * CURRENT_DATE. The exception is that you can specify CURRENT_TIMESTAMP as the default for 
     * a TIMESTAMP or DATETIME column. See Section 11.3.5, “Automatic Initialization and Updating 
     * for TIMESTAMP and DATETIME”.
     * 
     * If a column definition includes no explicit DEFAULT value, MySQL determines the default 
     * value as described in Section 11.6, “Data Type Default Values”.
     * 
     * BLOB and TEXT columns cannot be assigned a default value.
     * 
     * @param mixed $value 
     * @return \Self
     * 
     * @since 18-04-27
     * @edit 18-05-01
     * - Defined interface for setter.
     */
    public function setDefaultValue($value);

    /**
     * An integer or floating-point column can have the additional attribute AUTO_INCREMENT. 
     * When you insert a value of NULL (recommended) or 0 into an indexed AUTO_INCREMENT 
     * column, the column is set to the next sequence value. Typically this is value+1, where 
     * value is the largest value for the column currently in the table. AUTO_INCREMENT 
     * sequences begin with 1.
     * 
     * To retrieve an AUTO_INCREMENT value after inserting a row, use the LAST_INSERT_ID() 
     * SQL function or the mysql_insert_id() C API function. See Section 12.14, 
     * “Information Functions”, and Section 23.8.7.37, “mysql_insert_id()”.
     * 
     * If the NO_AUTO_VALUE_ON_ZERO SQL mode is enabled, you can store 0 in AUTO_INCREMENT 
     * columns as 0 without generating a new sequence value. See Section 5.1.10, 
     * “Server SQL Modes”.
     * 
     * There can be only one AUTO_INCREMENT column per table, it must be indexed, and it 
     * cannot have a DEFAULT value. An AUTO_INCREMENT column works properly only if it 
     * contains only positive values. Inserting a negative number is regarded as inserting 
     * a very large positive number. This is done to avoid precision problems when numbers 
     * “wrap” over from positive to negative and also to ensure that you do not accidentally 
     * get an AUTO_INCREMENT column that contains 0.
     * 
     * @param boolean $value 
     * @return \Self
     * 
     * @since 18-04-27
     * @edit 18-05-01
     * - Defined interface for setter.
     */
    public function setAutoIncrement($value = true);

    /**
     * A comment for a column can be specified with the COMMENT option, up to 1024 characters 
     * long. The comment is displayed by the SHOW CREATE TABLE and SHOW FULL COLUMNS statements.
     * 
     * @param string $comment 
     * @return \Self
     * 
     * @since 18-04-27
     * @edit 18-05-01
     * - Defined interface for setter.
     */
    public function setComment($comment);

    /**
     * @return boolean
     * 
     * @since 18-04-27
     * @edit 18-05-01
     * - Defined interface for getter.
     */
    public function getNotNull();

    /**
     * BLOB and TEXT columns cannot be assigned a default value.
     * 
     * @return mixed
     * 
     * @since 18-04-27
     * @edit 18-05-01
     * - Defined interface for getter.
     */
    public function getDefaultValue();

    /**
     * An integer or floating-point column can have the additional attribute AUTO_INCREMENT. 
     * 
     * @return boolean
     * 
     * @since 18-04-27
     * @edit 18-05-01
     * - Defined interface for getter.
     */
    public function getAutoIncrement();

    /**
     * @return string
     * 
     * @since 18-04-27
     * @edit 18-05-01
     * - Defined interface for getter.
     */
    public function getComment();

    /**
     * COLUMN_FORMAT
     * 
     * In NDB Cluster, it is also possible to specify a data storage format for individual columns 
     * of NDB tables using COLUMN_FORMAT. Permissible column formats are FIXED, DYNAMIC, and 
     * DEFAULT. FIXED is used to specify fixed-width storage, DYNAMIC permits the column to be 
     * variable-width, and DEFAULT causes the column to use fixed-width or variable-width storage 
     * as determined by the column's data type (possibly overridden by a ROW_FORMAT specifier).
     * 
     * For NDB tables, the default value for COLUMN_FORMAT is DEFAULT.
     * 
     * COLUMN_FORMAT currently has no effect on columns of tables using storage engines other than 
     * NDB. In MySQL 5.6 and later, COLUMN_FORMAT is silently ignored.
     * 
     * @since 18-04-27
     * @todo public function setColumnFormat();
     * @todo public function getColumnFormat();
     * 
     * 
     * 
     * STORAGE
     * 
     * For NDB tables, it is possible to specify whether the column is stored on disk 
     * or in memory by using a STORAGE clause. STORAGE DISK causes the column to be 
     * stored on disk, and STORAGE MEMORY causes in-memory storage to be used. The 
     * CREATE TABLE statement used must still include a TABLESPACE clause:
     * mysql> CREATE TABLE t1 (
     *     ->     c1 INT STORAGE DISK,
     *     ->     c2 INT STORAGE MEMORY
     *     -> ) ENGINE NDB;
     * ERROR 1005 (HY000): Can't create table 'c.t1' (errno: 140)
     * 
     * mysql> CREATE TABLE t1 (
     *     ->     c1 INT STORAGE DISK,
     *     ->     c2 INT STORAGE MEMORY
     *     -> ) TABLESPACE ts_1 ENGINE NDB;
     * Query OK, 0 rows affected (1.06 sec)
     * 
     * For NDB tables, STORAGE DEFAULT is equivalent to STORAGE MEMORY.
     * 
     * The STORAGE clause has no effect on tables using storage engines other than NDB. 
     * The STORAGE keyword is supported only in the build of mysqld that is supplied with 
     * NDB Cluster; it is not recognized in any other version of MySQL, where any attempt 
     * to use the STORAGE keyword causes a syntax error. 
     * 
     * @since 18-04-27
     * @todo public function setStorage();
     * @todo public function getStorage();
     */
}
