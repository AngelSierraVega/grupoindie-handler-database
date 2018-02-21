<?php

namespace GIndie\DBHandler\MySQL;

/**
 * DVLP-DBHandler - Table
 *
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * @copyright (c) 2018 Angel Sierra Vega. Grupo INDIE.
 *
 * @package DatabaseHandler
 *
 * @version GI-DBH.00.00 18-02-14 Empty class created.
 * @edit GI-DBH.00.01 18-02-15
 * - Abstract class
 * - Class implements \GIndie\DBHandler\Interfaces\Table
 */
abstract class Table implements \GIndie\DBHandler\Interfaces\Table
{

    /**
     * 
     * @return string
     * @since GI-DBH.00.01
     */
    public static function schemaName()
    {
        $schema = static::schema();
        return $schema::name();
    }

    /**
     * 
     * @return \GIndie\DBHandler\MySQL\Statement\Select
     * @since GI-DBH.00.01
     */
    public static function stmSelect()
    {
        return Statement::select(["*"], [static::schemaName() => static::name()]);
    }

}
