<?php

namespace GIndie\DBHandler\MySQL56\DataDefinition;

/**
 * GI-DBHandler-DVLP - Database
 * 
 * @link <https://dev.mysql.com/doc/refman/5.6/en/create-database.html>
 * @link <https://dev.mysql.com/doc/refman/5.6/en/alter-database.html>
 * @link <https://dev.mysql.com/doc/refman/5.6/en/drop-database.html>
 *
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * @copyright (c) 2018 Angel Sierra Vega. Grupo INDIE.
 *
 * @package DatabaseHandler
 * @subpackage MySQL56
 *
 * @version 00
 * @since 18-04-27
 */
interface Database
{

    /**
     * The name of the database
     * @since 18-02-14
     * - Added from \GIndie\DBHandler\Interfaces\Schema
     * @return string
     */
    public static function name();

    /**
     * @since 18-04-06
     * - added from \GIndie\DBHandler\MySQL\Schema
     * @return null|string
     */
    public static function charset();

    /**
     * @since 18-04-06
     * - added from \GIndie\DBHandler\MySQL\Schema
     * @return null|string
     */
    public static function collation();
}
