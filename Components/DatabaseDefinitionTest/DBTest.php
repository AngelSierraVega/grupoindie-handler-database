<?php

/**
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * @copyright (C) 2018 Angel Sierra Vega. Grupo INDIE.
 *
 * @package GIndie\DBHandler\Components\Test
 * 
 * @version 0A.2A
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
 */
class DBTest extends MySQL56\Instance\Database
{

    /**
     * The name of the database
     * @return string
     */
    public static function name()
    {
        return "gi_test_database";
    }

}
