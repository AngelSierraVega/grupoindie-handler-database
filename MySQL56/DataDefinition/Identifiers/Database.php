<?php

namespace GIndie\DBHandler\MySQL56\DataDefinition\Identifiers;

/**
 * GI-DBHandler-DVLP - Database
 * 
 * @link <https://dev.mysql.com/doc/refman/5.6/en/create-database.html>
 * @link <https://dev.mysql.com/doc/refman/5.6/en/alter-database.html>
 * @link <https://dev.mysql.com/doc/refman/5.6/en/drop-database.html>
 *
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * @copyright (CC) 2020 Angel Sierra Vega. Grupo INDIE.
 * @license file://LICENSE
 *
 * @package GIndie\DBHandler\DataDefinition\MySQL56\
 * @subpackage MySQL56
 *
 * @version 00.A0
 * @since 18-04-27
 * @edit 18-10-02
 * - Upgraded version
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
