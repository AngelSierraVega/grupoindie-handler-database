<?php

namespace GIndie\DBHandler\MySQL56\DataDefinition;

/**
 * GI-DBHandler-DVLP - Column_References
 * 
 * @link <https://dev.mysql.com/doc/refman/5.6/en/create-table.html#create-table-indexes-keys>
 *
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * @copyright (c) 2018 Angel Sierra Vega. Grupo INDIE.
 *
 * @package GIndie\DBHandler\DataDefinition\MySQL56\
 *
 * @since 18-04-29
 * @version DEPRECATED
 */
interface Column_References
{

    /**
     * 
     */
    public static function unique();

    /**
     * 
     */
    public static function primary();

    /**
     * 
     */
    public static function referenceDefinition();
}
