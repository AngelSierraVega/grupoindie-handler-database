<?php

/**
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * @copyright (C) 2018 Angel Sierra Vega. Grupo INDIE.
 *
 * @package GIndie\DBHandler\Components\Test
 * 
 * @version 00.70
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
 * @edit 18-10-02
 * - Upgraded version
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
     * @since 18-10-02
     */
    protected static function tableDefinition()
    {
        "@todo";
    }

}
