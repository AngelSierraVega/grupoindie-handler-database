<?php

/**
 * GI-DBHandler-DVLP - Database
 *
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * @copyright (CC) 2020 Angel Sierra Vega. Grupo INDIE.
 * @license file://LICENSE
 *
 * @package GIndie\DBHandler\MySQL57\DataDefinition
 *
 * @version 00.90
 * @since 18-11-02
 * @todo Upgrade DocBlock to MySQL57
 */

namespace GIndie\DBHandler\MySQL57\DataDefinition\Identifiers;

/**
 * 
 * @edit 18-11-02
 * - Copied code from GIndie\DBHandler\MySQL56\...
 */
interface Database
{

    /**
     * The name of the database
     * @since 18-02-14
     * @return string
     */
    public static function name();

    /**
     * @since 18-04-06
     * @return null|string
     */
    public static function charset();

    /**
     * @since 18-04-06
     * @return null|string
     */
    public static function collation();
}
