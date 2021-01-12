<?php

/**
 * GI-DBHandler-DVLP - Table
 *
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * @copyright (CC) 2020 Angel Sierra Vega. Grupo INDIE.
 * @license file://LICENSE
 *
 * @package GIndie\DBHandler\MySQL57\Instance
 *
 * @version 00.BF
 * @since 18-10-11
 */

namespace GIndie\DBHandler\MySQL57\Instance;

use GIndie\DBHandler\MySQL\DataDefinition\Identifiers;
use GIndie\DBHandler\MySQL57\DataDefinition;
use GIndie\DBHandler\MySQL57\Statement;

/**
 * @edit 18-07-31
 * - Implements GIndie\DBHandler\HandlerDefinition\Instance\Table
 * @edit 18-08-26
 * - Added defaultRecord()
 * @edit 18-09-02
 * - Added getPKDataType()
 * @edit 18-10-02
 * - Upgraded version
 * @edit 18-11-02
 * - Copied code from \GIndie\DBHandler\MySQL56\...
 * @edit 18-11-15
 * - Created sttmtSelect(), getTableReference(), groupBy()
 * @edit 19-01-08
  - Created getFormattedReference()
 * @edit 19-02-13
 * - Debuged getPKDataType()
 * @edit 19-12-29
 * - Minor revitions
 * @todo validate created methods
 */
abstract class Table implements Identifiers\Table, DataDefinition\Identifiers\Table
{

    /**
     * 
     * @param array $selectors
     * @param array $conditions
     * @param array $params
     * @return type
     * @since 18-11-16
     * @todo Handle conditions
     * @edit 18-12-24
     * - Handle params
     */
    public static function fetchAssoc(array $selectors = ["*"], array $conditions = [], array $params = [])
    {
        $select = static::sttmtSelect($selectors);
        foreach ($conditions as $condition) {
            switch (true) {
                case \is_array($condition):
                    $expr1 = \array_keys($condition)[0];
                    $expr2 = \array_values($condition)[0];
                    $select->addConditionEquals($expr1, $expr2);
                    break;
                default:
//                    var_dump($condition."");
                    $select->addCondition($condition);
                    break;
            }
        }
        foreach ($params as $type => $expr) {
            switch (true) {
                case $type === "GROUP BY":
                    $select->addGroupBy($expr);
                    break;
                case $type === "ORDER BY":
                    $select->addOrderBy($expr, null);
                    break;
                case $type === "HAVING":
                    $select->setHaving($expr);
                    break;
                case $type === "LIMIT":
                    $select->setLimit($expr);
                    break;
                default:
                    $select->appendText($expr);
//                    \trigger_error("@todo", \E_USER_ERROR);
                    break;
            }
        }
//        var_dump($select . "");
//        print_r($select . "");
        $result = \GIndie\DBHandler\MySQL57::query($select);
        if ($result == false) {

            \trigger_error(\GIndie\DBHandler\MySQL57::getConnection()->error . " query " . $select,
                \E_USER_ERROR);
        }
        $rtnArray = [];
        while ($row = $result->fetch_assoc()) {
            $rtnArray[$row[static::PRIMARY_KEY]] = $row;
        }
        unset($select);
        unset($result);
        return $rtnArray;
    }

    /**
     * 
     * @return \GIndie\DBHandler\MySQL57\Statement\DataManipulation\Select
     * @since 18-11-15
     */
    public static function sttmtSelect($selectors = ["*"])
    {
//        Statement\DataManipulation::
        return Statement\DataManipulation::select($selectors, static::getTableReference());
    }

    /**
     * 
     * @return array
     * @since 18-11-15
     */
    public static function getTableReference()
    {
        return [static::databaseName() => static::name()];
    }

    /**
     * 
     * @return string
     * @since 19-01-08
     */
    public static function getFormattedReference()
    {
        return "`" . static::databaseName() . "`.`" . static::name() . "`";
    }

    /**
     * 
     * @return type
     * @since 18-11-15
     */
    public static function groupBy()
    {
        return null;
    }

    /**
     * Alias for columnDefinition()
     * 
     * @param string $name
     * @param \GIndie\DBHandler\MySQL57\DataDefinition\Identifiers\Column\Definition\DataType $dataType
     * @return \GIndie\DBHandler\MySQL57\Instance\ColumnDefinition
     * @since 18-11-03
     */
    public static function clmnDfntn($name, \GIndie\DBHandler\MySQL57\DataDefinition\Identifiers\Column\Definition\DataType $dataType = null)
    {
        return static::columnDefinition($name, $dataType);
    }

    /**
     * 
     * @param string $name
     * @param \GIndie\DBHandler\MySQL57\DataDefinition\Identifiers\Column\Definition\DataType|null $dataType
     * 
     * @return \GIndie\DBHandler\MySQL57\Instance\ColumnDefinition
     * @since 18-10-11
     * @todo Upgrade type of parameter $dataType
     */
    public static function columnDefinition($name, \GIndie\DBHandler\MySQL57\DataDefinition\Identifiers\Column\Definition\DataType $dataType = null)
    {
        if (\is_null($dataType)) {
            if (!isset(static::$columns[static::class][$name])) {
                \trigger_error("Column '$name' not defined.", \E_USER_ERROR);
            }
        } elseif (\is_bool($dataType) && ($dataType === false)) {
            static::$columns[static::class][$name] = null;
        } else {
            static::$columns[static::class][$name] = new ColumnDefinition($dataType);
        }
        return static::$columns[static::class][$name];
    }

    /**
     * Gets the DataType object of the primary key of a given Table
     * 
     * @param string|null $className
     * @return \GIndie\DBHandler\MySQL57\Instance\DataType
     * @since 18-09-02
     * @edit 18-11-19
     * - Default $className = null
     * @edit 19-02-13
     * - Undeprecated method.
     * @edit 19-12-22
     * - Changed visibility from protected to public
     * @todo Deprecate attribute $className
     */
    public static function getPKDataType($className = null)
    {
        if (!\is_null($className)) {
            if (!\is_subclass_of($className, \GIndie\DBHandler\MySQL57\Instance\Table::class)) {
                \trigger_error("{$className} Is not subclass of \\GIndie\\DBHandler\\MySQL57\\Instance\\Table",
                    \E_USER_ERROR);
            }
            $instance = $className::instance();
            /**
             * @todo quitar error de uso PRIMARY_KEY
             */
            $dataType = $instance::columnDefinition($instance::PRIMARY_KEY)->getDataType();
        } else {
            $instance = static::instance();
            $dataType = static::columnDefinition(static::referenceDefinition()->getPrimaryKeyName())->getDataType();
        }
        switch ($dataType->getDatatype()) {
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
     * @edit 19-12-26
     * - Called columns() on creating instance
     */
    public static function instance(array $data = [])
    {
        static::columns();
//        static::configAttributes();
//        \array_key_exists(static::PRIMARY_KEY, $data) ?: $data[static::PRIMARY_KEY] = "GIP-UNDEFINED";
//        foreach (\array_keys(static::$_attribute[static::class]) as $attribute) {
//            \array_key_exists($attribute, $data) ?: $data[$attribute] = "";
//        }
        return new static($data);
    }

    /**
     * @since 18-04-30
     * @var GIndie\DBHandler\MySQL57\Instance\Database 
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
     * @edit 19-06-30
     * - Added classname on trigger_error
     * @return array|\GIndie\DBHandler\MySQL57\Instance\ColumnDefinition
     */
    final public static function columns()
    {
        if (!isset(static::$columns[static::class])) {
            static::tableDefinition();
        }
        if (empty(static::$columns[static::class])) {
            \trigger_error("Columns not defined for " . static::class, \E_USER_ERROR);
        }
        return static::$columns[static::class];
    }

    /**
     * @since 18-08-01
     */
    abstract protected static function tableDefinition();

    /**
     * 
     * @var array|\GIndie\DBHandler\MySQL57\Instance\ReferenceDefinition The references of the dable
     * @since 18-08-20
     */
    protected static $referenceDefinition = [];

    /**
     * Alias for referenceDefinition()
     * 
     * @return \GIndie\DBHandler\MySQL57\Instance\ReferenceDefinition
     * @since 18-11-03
     */
    public static function rfrncDfntn()
    {
        return static::referenceDefinition();
    }

    /**
     * @return \GIndie\DBHandler\MySQL57\Instance\ReferenceDefinition
     * @since 18-08-20
     * @edit 18-12-03
     * - Execute tableDefinition() if undefined
     */
    public static function referenceDefinition()
    {
        if (!isset(static::$columns[static::class])) {
            static::tableDefinition();
        }
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
