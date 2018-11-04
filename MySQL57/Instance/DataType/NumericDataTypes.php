<?php

/**
 * GI-DBHandler-DVLP - NumericDataTypes
 *
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * @copyright (c) 2018 Angel Sierra Vega. Grupo INDIE.
 *
 * @package GIndie\DBHandler\MySQL57\Instance
 *
 * @version 00.9A
 * @since 18-11-11
 */

namespace GIndie\DBHandler\MySQL57\Instance\DataType;

use GIndie\DBHandler\MySQL57\DataDefinition;

/**
 *
 * @edit 18-11-11
 * - Moved methods from Instance\DataType
 */
abstract class NumericDataTypes extends DateTimeDataTypes
        implements DataDefinition\DataTypes\Numeric
{

    /**
     * 
     * @param null|boolean $m
     * @param null|boolean $unsigned
     * @param null|boolean $zerofill
     * @return \GIndie\DBHandler\MySQL57\Instance\DataType
     * @since 18-07-31
     * @edit 18-08-15
     * - use setUnsigned
     */
    public static function integer($m = null, $unsigned = false, $zerofill = false)
    {
        $rntColumn = new \GIndie\DBHandler\MySQL57\Instance\DataType(static::DATATYPE_INT);
        $rntColumn->setM($m);
        $rntColumn->setUnsigned($unsigned);
        $rntColumn->setZerofill($zerofill);
        return $rntColumn;
    }

    /**
     * @param int $m
     * @param boolean $unsigned
     * @param boolean $zerofill 
     * 
     * @return \GIndie\DBHandler\MySQL57\Instance\DataType
     * @since 18-08-01
     * @edit 18-08-16
     * - Upgraded use of setUnsigned()
     */
    public static function tinyint($m, $unsigned = false, $zerofill = false)
    {
        $rtnData = new \GIndie\DBHandler\MySQL57\Instance\DataType(static::DATATYPE_TINYINT);
        $rtnData->setM($m);
        $rtnData->setUnsigned($unsigned);
        $rtnData->setZerofill($zerofill);
        return $rtnData;
    }

    /**
     * 
     * @return \GIndie\DBHandler\MySQL57\Instance\DataType
     * @since 18-08-01
     */
    public static function serial()
    {
        $rtnData = new \GIndie\DBHandler\MySQL57\Instance\DataType(static::DATATYPE_SERIAL);
        return $rtnData;
    }

    /**
     * 
     * @param int $m
     * @param int $d
     * @param boolean $unsigned
     * @param boolean $zerofill
     * 
     * @return \GIndie\DBHandler\MySQL57\Instance\DataType
     * @since 18-08-01
     * @edit 18-09-02
     * - Added params $unsigned, $zerofill
     */
    public static function decimal($m = 10, $d = 0, $unsigned = false, $zerofill = false)
    {
        $rtnData = new \GIndie\DBHandler\MySQL57\Instance\DataType(static::DATATYPE_DECIMAL);
        $rtnData->setM($m)->setD($d);
        $rtnData->setUnsigned($unsigned);
        $rtnData->setZerofill($zerofill);
        return $rtnData;
    }

    /**
     * @since 18-08-26
     */
    public static function bigint($m, $unsigned = false, $zerofill = false)
    {
        $rntColumn = new \GIndie\DBHandler\MySQL57\Instance\DataType(static::DATATYPE_BIGINT);
        $rntColumn->setM($m);
        $rntColumn->setUnsigned($unsigned);
        $rntColumn->setZerofill($zerofill);
        return $rntColumn;
    }

    /**
     * Alias for BIGINT(20) UNSIGNED
     * @return \GIndie\DBHandler\MySQL57\Instance\DataType
     * @since 18-08-26
     */
    public static function serializedBigint()
    {
        $rtnData = static::bigint(20, true);
        return $rtnData;
    }

}
