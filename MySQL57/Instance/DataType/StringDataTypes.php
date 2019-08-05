<?php

/**
 * GI-DBHandler-DVLP - StringDataTypes
 *
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * @copyright (c) 2018 Angel Sierra Vega. Grupo INDIE.
 *
 * @package GIndie\DBHandler\MySQL57\Instance
 *
 * @version 00.AD
 * @since 18-11-11
 */

namespace GIndie\DBHandler\MySQL57\Instance\DataType;

use GIndie\DBHandler\MySQL57\DataDefinition;

/**
 *
 * @edit 18-11-11
 * - Moved methods from Instance\DataType
 * @edit 19-07-25
 * - Added set()
 */
abstract class StringDataTypes extends NumericDataTypes implements DataDefinition\DataTypes\StringDataTypes
{

    /**
     * {@inheritdoc}
     * 
     * @since 18-08-02
     */
    public static function blob($m = null)
    {
        $rtnData = new \GIndie\DBHandler\MySQL57\Instance\DataType(static::DATATYPE_BLOB);
        $rtnData->setM($m);
        return $rtnData;
    }

    /**
     * {@inheritdoc}
     * 
     * @since 18-11-11
     */
    public static function binary($m = null)
    {
        $rtnData = new \GIndie\DBHandler\MySQL57\Instance\DataType(static::DATATYPE_BINARY);
        $rtnData->setM($m);
        return $rtnData;
    }

    /**
     * {@inheritdoc}
     * @since 18-08-01
     * @edit 18-11-11
     */
    public static function char($m = null, $charsetName = null, $collationName = null)
    {
        $rtnData = new \GIndie\DBHandler\MySQL57\Instance\DataType(static::DATATYPE_CHAR);
        $rtnData->setM($m);
        $rtnData->setCharacterSet($charsetName);
        $rtnData->setCollation($collationName);
        return $rtnData;
    }

    /**
     * 
     * {@inheritdoc}
     * 
     * @since 18-08-01
     */
    public static function varchar($m, $charsetName = null, $collationName = null)
    {
        $rtnData = new \GIndie\DBHandler\MySQL57\Instance\DataType(static::DATATYPE_VARCHAR);
        $rtnData->setM($m);
        $rtnData->setCharacterSet($charsetName);
        $rtnData->setCollation($collationName);
        return $rtnData;
    }

    /**
     * {@inheritdoc}
     * 
     * @since 18-08-01
     * @edit 18-11-11
     */
    public static function tinytext($charsetName = null, $collationName = null)
    {
        $rtnData = new \GIndie\DBHandler\MySQL57\Instance\DataType(static::DATATYPE_TINYTEXT);
        $rtnData->setCharacterSet($charsetName);
        $rtnData->setCollation($collationName);
        return $rtnData;
    }

    /**
     * {@inheritdoc}
     * 
     * @since 18-08-01
     */
    public static function text($m = null, $charsetName = null, $collationName = null)
    {
        $rtnData = new \GIndie\DBHandler\MySQL57\Instance\DataType(static::DATATYPE_TEXT);
        $rtnData->setM($m);
        $rtnData->setCharacterSet($charsetName);
        $rtnData->setCollation($collationName);
        return $rtnData;
    }

    /**
     * {@inheritdoc}
     * @since 19-08-05
     */
    public static function mediumtext($charsetName = null, $collationName = null)
    {
        $rtnData = new \GIndie\DBHandler\MySQL57\Instance\DataType(static::DATATYPE_MEDIUMTEXT);
        $rtnData->setCharacterSet($charsetName);
        $rtnData->setCollation($collationName);
        return $rtnData;
    }

    /**
     * 
     * {@inheritdoc}
     * 
     * @since 18-08-01
     */
    public static function enum(array $values, $charsetName = null, $collationName = null)
    {
        $rtnData = new \GIndie\DBHandler\MySQL57\Instance\DataType(static::DATATYPE_ENUM);
        $rtnData->setValues($values);
        return $rtnData;
    }

    /**
     * {@inheritdoc}
     * @since 19-07-25
     */
    public static function set(array $values, $charsetName = null, $collationName = null)
    {
        $rtnData = new \GIndie\DBHandler\MySQL57\Instance\DataType(static::DATATYPE_SET);
        $rtnData->setValues($values);
        return $rtnData;
    }

}
