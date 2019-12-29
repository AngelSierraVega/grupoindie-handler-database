<?php

/**
 * GI-DBHandler-DVLP - NumericDataTypes
 *
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * @copyright (c) 2018 Angel Sierra Vega. Grupo INDIE.
 *
 * @package GIndie\DBHandler\MySQL57\Instance
 *
 * @version 00.9D
 * @since 18-11-11
 * @todo upgrade docblock
 */

namespace GIndie\DBHandler\MySQL57\Instance\DataType;

use GIndie\DBHandler\MySQL57\DataDefinition;

/**
 *
 * @edit 18-11-11
 * - Moved methods from Instance\DataType
 * @edit 19-08-05
 * - Added docblock for integer()
 * - Created smallint(), float()
 */
abstract class NumericDataTypes extends DateTimeDataTypes implements DataDefinition\DataTypes\Numeric
{

    /**
     * INTEGER[(M)] [UNSIGNED] [ZEROFILL] ALIAS FOR INT[(M)] [UNSIGNED] [ZEROFILL]
     * 
     * A normal-size integer. The signed range is -2147483648 to 2147483647. 
     * 
     * The unsigned range is 0 to 4294967295.
     * 
     * SERIAL is an alias for BIGINT UNSIGNED NOT NULL AUTO_INCREMENT UNIQUE.
     * SERIAL DEFAULT VALUE in the definition of an integer column is an alias for 
     * NOT NULL AUTO_INCREMENT UNIQUE.
     * 
     * @link <https://dev.mysql.com/doc/refman/5.7/en/numeric-type-overview.html>
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
     * SMALLINT[(M)][UNSIGNED] [ZEROFILL] 
     * 
     * A small integer. The signed range is -32768 to 32767. The unsigned range 
     * is 0 to 65535.
     * 
     * @link <https://dev.mysql.com/doc/refman/5.7/en/numeric-type-overview.html>
     * 
     * @param null|boolean $m
     * @param null|boolean $unsigned
     * @param null|boolean $zerofill
     * @return \GIndie\DBHandler\MySQL57\Instance\DataType
     * @since 19-08-05
     */
    public static function smallint($m = null, $unsigned = false, $zerofill = false)
    {
        $rntColumn = new \GIndie\DBHandler\MySQL57\Instance\DataType(static::DATATYPE_SMALLINT);
        $rntColumn->setM($m);
        $rntColumn->setUnsigned($unsigned);
        $rntColumn->setZerofill($zerofill);
        return $rntColumn;
    }

    /**
     * TINYINT[(M)] [UNSIGNED] [ZEROFILL]
     *
     * A very small integer. The signed range is -128 to 127. The unsigned range is 0 to 255.
     * 
     * @link <https://dev.mysql.com/doc/refman/5.7/en/numeric-type-syntax.html>
     * 
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
     * SERIAL is an alias for BIGINT UNSIGNED NOT NULL AUTO_INCREMENT UNIQUE. 
     * 
     * @link <https://dev.mysql.com/doc/refman/5.7/en/numeric-type-syntax.html>
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
     * FLOAT[(M,D)][UNSIGNED] [ZEROFILL]
     * 
     * A small (single-precision) floating-point number. Permissible values are 
     * -3.402823466E+38to -1.175494351E-38, 0, and 1.175494351E-38 to 
     * 3.402823466E+38. These are the theoretical limits, based on the IEEE 
     * standard. The actual range might be slightly smaller depending on your 
     * hardware or operating system.
     * 
     * M is the total number of digits and D is the number of digits following 
     * the decimal point. If Mand D are omitted, values are stored to the limits 
     * permitted by the hardware. A single-precision floating-point number is 
     * accurate to approximately 7 decimal places.
     * 
     * FLOAT(M,D)is a nonstandard MySQL extension.
     * 
     * Using FLOAT might give yousome unexpected problems because all 
     * calculations in MySQLare done with double precision.
     * 
     * 
     * @param int $m M is the total number of digits
     * @param int $d D is the number of digits following the decimal point
     * @param boolean $unsigned UNSIGNED, if specified, disallows negative values.
     * @param boolean $zerofill
     * 
     * @return \GIndie\DBHandler\MySQL57\Instance\DataType
     * @since 19-08-05
     */
    public static function float($m = null, $d = null, $unsigned = false, $zerofill = false)
    {
        $rtnData = new \GIndie\DBHandler\MySQL57\Instance\DataType(static::DATATYPE_FLOAT);
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
