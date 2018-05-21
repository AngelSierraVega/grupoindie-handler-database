<?php

/**
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * @copyright (C) 2018 Angel Sierra Vega. Grupo INDIE.
 *
 * @package GIndie\DBHandler\Components\Test
 * 
 * @version 0A.23
 * @since 18-04-30
 */

namespace GIndie\DBHandler\Components\DatabaseDefinitionTest;

use GIndie\DBHandler\MySQL56;

/**
 *
 * @edit 18-05-05
 * - Updated namespace
 * @edit 18-05-21
 * - Moved file from [sndbx_folder]\Platform\..
 * @todo 
 * - Functional columns()
 */
class TBL01Simple extends MySQL56\Instance\Table
{

    /**
     * 
     * @return string
     */
    public static function databaseClassname()
    {
        return DBTest::class;
    }

    /**
     * 
     * @return string
     */
    public static function name()
    {
        return "01_simple";
    }

    /**
     * 
     * @return array
     */
    public static function columns()
    {
        static::columnDefinitionSerial($name);
        static::columnDefinitionChar($name);
        static::columnDefinitionVarchar($name);
        static::columnDefinitionInt($name);
        return parent::columns();
    }

}
