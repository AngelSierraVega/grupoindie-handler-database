<?php

namespace GIndie\DBHandler\HandlerDefinition\Instance;

/**
 * GI-DBHandler-DVLP - Table
 *
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * @copyright (c) 2018 Angel Sierra Vega. Grupo INDIE.
 *
 * @package DatabaseHandler
 *
 * @version 00.1
 * @since 18-04-30
 * @edit 18-05-01
 * - Moved file from [base_dir]\Instances to [base_dir]\HandlerDefinition\Instance
 * - Updated namespace
 */
interface Table
{

    /**
     * The name of the database related to the table
     * @since 18-04-30 
     */
    public static function databaseClassname();
}
