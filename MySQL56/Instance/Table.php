<?php

namespace GIndie\DBHandler\MySQL56\Instance;

use GIndie\DBHandler\Instances;
use GIndie\DBHandler\MySQL56\DataDefinition;

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
abstract class Table implements Instances\Table, DataDefinition\Identifiers\Table
{

    /**
     * @since 18-04-30
     * @var GIndie\DBHandler\MySQL56\Instance\Database 
     */
    private static $database;

    /**
     * @since 18-04-30
     * @return string
     */
    public static function databaseName()
    {
        if (!isset(static::$databaseClassName)) {
            $tmpName = static::databaseClassname();
            static::$database = new $tmpName();
            unset($tmpName);
        }
        return static::$database->name();
    }

    /**
     * @since 18-04-30
     * @var array The columns of the table
     */
    private static $columns = [];

    /**
     * @since 18-04-30
     * @return array
     */
    public static function columns()
    {

        if (empty(static::$columns)) {
            \trigger_error("Columns not defined.", \E_USER_ERROR);
        }
        return static::$columns;
    }

    /**
     * @since 18-04-30
     * @param string $name
     * @param \GIndie\DBHandler\MySQL56\Instance\ColumnType $dataType
     * @return \GIndie\DBHandler\MySQL56\Instance\ColumnDefinition
     */
    public static function columnDefinition($name, ColumnType $dataType)
    {
        static::$columns[$name] = new ColumnDefinition($dataType, $notNull, $defaultValue, $autoIncrement, $comment, $columnFormat, $storage);
        /**
         * @todo
         * static::columnDefinitionSerial($name);
          static::columnDefinitionChar($name);
          static::columnDefinitionVarchar($name);
          static::columnDefinitionInt($name);
          return parent::columns();
         */
        return static::$columns[$name];
    }

    /**
     * @todo
     */
    public static function referenceDefinition()
    {
        
    }

}
