<?php

namespace GIndie\DBHandler\MySQL56\DataDefinition;

/**
 * GI-DBHandler-DVLP - Column
 * 
 * @link <https://dev.mysql.com/doc/refman/5.6/en/create-table.html>
 * 
 * [tbl_name] [col_name] [column_definition]
 * 
 * Note: Constraints and Indexes are defined at table level.
 *
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * @copyright (c) 2018 Angel Sierra Vega. Grupo INDIE.
 *
 * @package DatabaseHandler
 * @subpackage MySQL56
 *
 * @version 00
 * @since 18-04-27
 * @edit 18-04-29
 * - Created interface
 * - Defined attributes
 * @todo
 * - Define references
 */
interface Column
{

    /**
     * @since 18-04-29
     * @return string
     */
    public static function tableName();

    /**
     * @since 18-04-29
     * @return string
     */
    public static function name();

    /**
     * [column_definition] = [data_type] [NOT NULL | NULL] [DEFAULT default_value] [AUTO_INCREMENT] 
     * [COMMENT 'string'] [COLUMN_FORMAT {FIXED|DYNAMIC|DEFAULT}] [STORAGE {DISK|MEMORY|DEFAULT}]
     * 
     * @since 18-04-29
     * @return string
     */
    public static function columnDefinition();
    
}