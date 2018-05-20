<?php

namespace GIndie\DBHandler\MySQL56\Instance;

use GIndie\DBHandler\MySQL56\DataDefinition;

/**
 * GI-DBHandler-DVLP - Database
 *
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * @copyright (c) 2018 Angel Sierra Vega. Grupo INDIE.
 *
 * @package GIndie\DBHandler\MySQL56\Instance
 *
 * @version 00.F0
 * @since 18-04-30
 * @edit 18-04-30
 * - Added code from ..\MySQL\Schema
 * - Abstract class, implements \GIndie\DBHandler\MySQL56\DataDefinition\Database 
 */
abstract class Database implements DataDefinition\Database
{

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

}
