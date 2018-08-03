<?php

/**
 * GI-DBHandler-DVLP - Database
 *
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * @copyright (c) 2018 Angel Sierra Vega. Grupo INDIE.
 *
 * @package GIndie\DBHandler\MySQL56\Instance
 *
 * @version 0A.70
 * @since 18-04-30
 */

namespace GIndie\DBHandler\MySQL56\Instance;

use GIndie\DBHandler\MySQL56\DataDefinition;

/**
 * 
 * @edit 18-04-30
 * - Added code from ..\MySQL\Schema
 * - Abstract class, implements \GIndie\DBHandler\MySQL56\DataDefinition\Identifiers\Database
 */
abstract class Database implements DataDefinition\Identifiers\Database
{
    /**
     *
     * @var \GIndie\DBHandler\MySQL56\Instance\Database 
     * @since 18-08-02
     * @deprecated since 18-08-15
     * private static $instance;
     */

    /**
     * @return \GIndie\DBHandler\MySQL56\Instance\Database
     * @since 18-08-02
     * @edit 18-08-15
     * - Upgraded method due to bug.
     */
    public static function getInstance()
    {
        return new static();
//        if (!isset(static::$instance)) {
//            static::$instance = new static();
//        }
//        return static::$instance;
    }

    /**
     * @since 18-04-06
     * - Added from ..\MySQL\Schema
     * @return string
     */
    public static function charset()
    {
        return "utf8";
    }

    /**
     * @since 18-04-06
     * - Added from ..\MySQL\Schema
     * @return string
     */
    public static function collation()
    {
        return "utf8_general_ci";
    }

    /**
     * @since 18-08-02
     * @edit 18-08-15
     * - Renamed from getTableClassname to getTableClassnames
     */
    abstract public static function getTableClassnames();
}
