<?php

/**
 * GI-DBHandler-DVLP - Table
 *
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * @copyright (c) 2018 Angel Sierra Vega. Grupo INDIE.
 *
 * @package GIndie\DBHandler\MySQL56\Instance
 *
 * @version 00.A6
 * @since 18-04-30
 */

namespace GIndie\DBHandler\MySQL56\Instance;

use GIndie\DBHandler\MySQL\DataDefinition\Identifiers;
use GIndie\DBHandler\MySQL56\DataDefinition;

/**
 * @edit 18-07-31
 * - Implements GIndie\DBHandler\HandlerDefinition\Instance\Table
 * @edit 18-08-26
 * - Added defaultRecord()
 * @edit 18-09-02
 * - Added getPKDataType()
 * @edit 18-10-02
 * - Upgraded version
 */
abstract class Table implements Identifiers\Table, DataDefinition\Identifiers\Table
{

    /**
     * Gets the DataType object of the primary key of a given Table
     * 
     * @param type $className
     * @return \GIndie\DBHandler\MySQL56\Instance\DataType
     * @since 18-09-02
     */
    protected static function getPKDataType($className)
    {
        if (!\is_subclass_of($className, \GIndie\DBHandler\MySQL56\Instance\Table::class)) {
            \trigger_error("{$className} Is not subclass of \\GIndie\\DBHandler\\MySQL56\\Instance\\Table", \E_USER_ERROR);
        }
        $instance = $className::instance();
        $instance->columns();
        $dataType = $instance::columnDefinition($instance::PRIMARY_KEY)->getDataType();
        switch ($dataType->getDatatype())
        {
            case DataType::DATATYPE_SERIAL:
                $dataType = DataType::serializedBigint();
                break;
        }
        return $dataType;
    }

    /**
     * Sets data from an associative array
     * @param array $data
     * @since 18-08-18
     * @return \GIndie\Platform\Model\Record
     */
    public static function instance(array $data = [])
    {
//        static::configAttributes();
//        \array_key_exists(static::PRIMARY_KEY, $data) ?: $data[static::PRIMARY_KEY] = "GIP-UNDEFINED";
//        foreach (\array_keys(static::$_attribute[static::class]) as $attribute) {
//            \array_key_exists($attribute, $data) ?: $data[$attribute] = "";
//        }
        return new static($data);
    }

    /**
     * @since 18-04-30
     * @var GIndie\DBHandler\MySQL56\Instance\Database 
     * @edit 18-08-15
     * - Changed visibility
     */
    protected static $database;

    /**
     * @since 18-04-30
     * @return string
     * @edit 18-08-26
     * - Removed validation of static var
     * @todo
     * - ¿Remove method?
     */
    public static function databaseName()
    {
//        if (!isset(static::$database)) {
        $tmpName = static::databaseClassname();
        static::$database = new $tmpName();
        unset($tmpName);
//        }
        return static::$database->name();
    }

    /**
     * @since 18-04-30
     * @var array The columns of the table
     * @edit 18-08-15
     * - Changed visibility
     */
    protected static $columns = [];

    /**
     * @since 18-04-30
     * @return array
     */
    final public static function columns()
    {
        if (!isset(static::$columns[static::class])) {
            static::tableDefinition();
        }
        if (empty(static::$columns[static::class])) {
            \trigger_error("Columns not defined.", \E_USER_ERROR);
        }
        return static::$columns[static::class];
    }

    /**
     * @since 18-08-01
     */
    abstract protected static function tableDefinition();

    /**
     * 
     * @param string $name
     * @param \GIndie\DBHandler\MySQL56\DataDefinition\Identifiers\Column\Definition\DataType|null $dataType
     * 
     * @return \GIndie\DBHandler\MySQL56\Instance\ColumnDefinition
     * @since 18-04-30
     * @edit 18-08-01
     * - Updated params and functionality
     */
    public static function columnDefinition($name, \GIndie\DBHandler\MySQL56\DataDefinition\Identifiers\Column\Definition\DataType $dataType = null)
    {
        if (\is_null($dataType)) {
            if (!isset(static::$columns[static::class][$name])) {
                \trigger_error("Column '$name' not defined.", \E_USER_ERROR);
            }
        } else {
            static::$columns[static::class][$name] = new ColumnDefinition($dataType);
            //static::$columns[$name] = $dataType;
        }
        return static::$columns[static::class][$name];
    }

    /**
     * 
     * @var array|\GIndie\DBHandler\MySQL56\Instance\ReferenceDefinition The references of the dable
     * @since 18-08-20
     */
    protected static $referenceDefinition = [];

    /**
     * @return \GIndie\DBHandler\MySQL56\Instance\ReferenceDefinition
     * @since 18-08-20
     */
    public static function referenceDefinition()
    {
        if (!isset(static::$referenceDefinition[static::class])) {
            static::$referenceDefinition[static::class] = new ReferenceDefinition();
        }
        return static::$referenceDefinition[static::class];
    }

    /**
     * 
     * @return array
     * @since 18-08-26
     */
    public static function defaultRecord()
    {
        return [];
    }

}
