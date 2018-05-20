<?php

namespace GIndie\DBHandler\MySQL56\Statement;

/**
 * [Factory for] DataDefinition
 *
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * @copyright (c) 2018 Angel Sierra Vega. Grupo INDIE.
 *
 * @package GIndie\DBHandler\MySQL56\Statement
 *
 * @since 18-04-07
 * @version AO
 * @edit 18-05-03
 * - Moved file from [base_dir]\MySQL\Statement to [base_dir]\MySQL56\Statement
 * - Updated namespace
 * - createDatabase() Copied from [base_dir]\MySQL\Statement, updated return value
 * @version 0A.10
 */
class DataDefinition
{

    /**
     * Creates a new Create Database Statement Object.
     * 
     * @param string $name
     * @param string $characterSet
     * @param string $collation
     * @return \GIndie\DBHandler\MySQL56\Statement\DataDefinition\CreateSchema
     * 
     * @since 18-04-07
     * @edit 18-05-03
     */
    public static function createDatabase($name, $characterSet, $collation)
    {
        return new DataDefinition\CreateSchema($name, $characterSet, $collation);
    }

}
