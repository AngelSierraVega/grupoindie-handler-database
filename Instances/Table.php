<?php

namespace GIndie\DBHandler\Instances;

/**
 * GI-DBHandler-DVLP - Table
 *
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * @copyright (c) 2018 Angel Sierra Vega. Grupo INDIE.
 *
 * @package DatabaseHandler
 *
 * @version 00
 * @since 18-04-30
 */
interface Table
{

    /**
     * The name of the database related to the table
     * @since 18-04-30 
     */
    public static function databaseClassname();
}
