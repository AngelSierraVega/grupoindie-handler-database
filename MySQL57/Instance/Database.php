<?php

/**
 * GI-DBHandler-DVLP - Database
 *
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * @copyright (c) 2018 Angel Sierra Vega. Grupo INDIE.
 *
 * @package GIndie\DBHandler\MySQL57\Instance
 *
 * @version 00.AA
 * @since 18-11-02
 */

namespace GIndie\DBHandler\MySQL57\Instance;

use GIndie\DBHandler\MySQL57\DataDefinition;

/**
 *  @edit 18-04-30
 * - Added code from ..\MySQL\Schema
 * - Abstract class, implements \GIndie\DBHandler\MySQL56\DataDefinition\Identifiers\Database
 * @edit 18-10-02
 * - Upgraded version
 * @edit 18-11-02
 * - Copied code from \GIndie\DBHandler\MySQL56\...
 */
abstract class Database implements DataDefinition\Identifiers\Database
{

    /**
     * @return \GIndie\DBHandler\MySQL57\Instance\Database
     * @since 18-08-02
     * @edit 18-08-15
     * - Upgraded method due to bug.
     */
    public static function getInstance()
    {
        return new static();
    }

    /**
     * 
     * @return string
     * @since 18-04-06
     * - Added from ..\MySQL\Schema
     * @edit 18-11-11
     * - Default to utf8mb4
     */
    public static function charset()
    {
        return "utf8mb4";//utf8
    }

    /**
     * 
     * @return string
     * @since 18-04-06
     * - Added from ..\MySQL\Schema
     * @edit 18-11-11
     * - Default to utf8mb4_unicode_ci
     */
    public static function collation()
    {
        return "utf8mb4_unicode_ci";//utf8_general_ci
    }

    /**
     * @since 18-08-02
     * @edit 18-08-15
     * - Renamed from getTableClassname to getTableClassnames
     */
    abstract public static function getTableClassnames();
}
