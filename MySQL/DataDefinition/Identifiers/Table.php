<?php

namespace GIndie\DBHandler\MySQL\DataDefinition\Identifiers;

/**
 * GI-DBHandler-DVLP - Table
 *
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * @copyright (c) 2018 Angel Sierra Vega. Grupo INDIE.
 *
 * @package GIndie\DBHandler\DataDefinition
 *
 * @since 18-04-30
 * @edit 18-05-01
 * - Moved file from [base_dir]\Instances to [base_dir]\HandlerDefinition\Instance
 * - Updated namespace
 * @version 00.A5
 * @edit 18-10-02
 * - Upgraded version
 * @edit 18-11-02
 * - - Moved file from [base_dir]\Common to [base_dir]\Common\DataDefinition\Identifiers
 */
interface Table
{

    /**
     * The name of the database related to the table
     * @since 18-04-30 
     */
    public static function databaseClassname();
}
