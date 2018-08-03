<?php

/**
 * GI-DBHandler-DVLP - DataType
 *
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * @copyright (c) 2018 Angel Sierra Vega. Grupo INDIE.
 *
 * @package GIndie\DBHandler\MySQL56\Instance
 *
 * @version 0A.A0
 * @since 18-04-30
 */

namespace GIndie\DBHandler\MySQL56\Instance;

use GIndie\DBHandler\MySQL56\DataDefinition\DataTypes;
use GIndie\DBHandler\MySQL56\DataDefinition\Identifiers\Column;

/**
 * 
 * @edit 18-07-31
 * - Added params $datatype, $unzigned, $m, $zerofill
 * - Added integer(), __construct(), setM(), getM(), setUnzigned(), getUnzigned()
 * - Added settZerofill(), getZerofill()
 * @edit 18-08-01
 * - Renamed class from ColumnType to DataType
 * @edit 18-08-02
 * - Added blob()
 * @edit 18-08-16
 * - Updated methods.
 */
class DataType implements DataTypes\Numeric, DataTypes\DateTime, DataTypes\StringDataTypes,
        Column\Definition\DataType
{

    /**
     * BLOB[(M)]
     * 
     * A BLOB column with a maximum length of 65,535 (216 − 1) bytes. Each BLOB value is stored 
     * using a 2-byte length prefix that indicates the number of bytes in the value.
     * 
     * An optional length M can be given for this type. If this is done, MySQL creates the column 
     * as the smallest BLOB type large enough to hold values M bytes long. 
     * 
     * @param int|null $m
     * @since 18-08-02
     */
    public static function blob($m = null)
    {
        $rtnData = new DataType(static::DATATYPE_BLOB);
        $rtnData->setM($m);
        return $rtnData;
    }

    /**
     * TIMESTAMP[(fsp)]
     * 
     * A timestamp. The range is '1970-01-01 00:00:01.000000' UTC to '2038-01-19 03:14:07.999999' UTC. 
     * TIMESTAMP values are stored as the number of seconds since the epoch ('1970-01-01 00:00:00' UTC). 
     * A TIMESTAMP cannot represent the value '1970-01-01 00:00:00' because that is equivalent 
     * to 0 seconds from the epoch and the value 0 is reserved for representing '0000-00-00 00:00:00', 
     * the “zero” TIMESTAMP value.
     * 
     * As of MySQL 5.6.4, an optional fsp value in the range from 0 to 6 may be given to specify 
     * fractional seconds precision. A value of 0 signifies that there is no fractional part. 
     * If omitted, the default precision is 0. 
     * 
     * @param null|int $fsp
     * @return \GIndie\DBHandler\MySQL56\Instance\DataType
     * 
     * @since 18-08-02
     */
    public static function timestamp($fsp = null)
    {
        $rtnData = new DataType(static::DATATYPE_TIMESTAMP);
        $rtnData->setFSP($fsp);
        return $rtnData;
    }

    /**
     * DECIMAL[(M[,D])] [UNSIGNED] [ZEROFILL]
     * A packed “exact” fixed-point number. M is the total number of digits (the precision) 
     * and D is the number of digits after the decimal point (the scale). The decimal point 
     * and (for negative numbers) the - sign are not counted in M. If D is 0, values have no 
     * decimal point or fractional part. The maximum number of digits (M) for DECIMAL is 65. 
     * The maximum number of supported decimals (D) is 30. If D is omitted, the default is 0. 
     * If M is omitted, the default is 10.
     * 
     * UNSIGNED, if specified, disallows negative values.
     * 
     * All basic calculations (+, -, *, /) with DECIMAL columns are done with a precision of 65 digits.
     * 
     * @param int $m
     * @param int $d
     * 
     * @return \GIndie\DBHandler\MySQL56\Instance\DataType
     * @since 18-08-01
     */
    public static function decimal($m = 10, $d = 0)
    {
        $rtnData = new DataType(static::DATATYPE_DECIMAL);
        $rtnData->setM($m)->setD($d);
        return $rtnData;
    }

    /**
     * 
     * CHAR[(M)] [CHARACTER SET charset_name] [COLLATE collation_name]
     * 
     * @link <https://dev.mysql.com/doc/refman/5.6/en/string-type-overview.html>
     * 
     * A fixed-length string that is always right-padded with spaces to the specified length 
     * when stored. M represents the column length in characters. The range of M is 0 to 255. 
     * If M is omitted, the length is 1. 
     * 
     * CHAR is shorthand for CHARACTER. NATIONAL CHAR (or its equivalent short form, NCHAR) 
     * is the standard SQL way to define that a CHAR column should use some predefined character 
     * set. MySQL uses utf8 as this predefined character set. Section 10.3.7, “The National 
     * Character Set”.
     * 
     * The CHAR BYTE data type is an alias for the BINARY data type. This is a compatibility feature.
     * 
     * MySQL permits you to create a column of type CHAR(0). This is useful primarily when you have 
     * to be compliant with old applications that depend on the existence of a column but that do not 
     * actually use its value. CHAR(0) is also quite nice when you need a column that can take only 
     * two values: A column that is defined as CHAR(0) NULL occupies only one bit and can take only 
     * the values NULL and '' (the empty string). 
     * 
     * @param int $m
     * @param string|null $charsetName
     * @param string|null $collationName
     * 
     * @return \GIndie\DBHandler\MySQL56\Instance\DataType
     * @since 18-08-01
     */
    public static function char($m, $charsetName = null, $collationName = null)
    {
        $rtnData = new DataType(static::DATATYPE_CHAR);
        $rtnData->setM($m);
        $rtnData->setCharacterSet($charsetName);
        $rtnData->setCollation($collationName);
        return $rtnData;
    }

    /**
     * DATE
     * 
     * @link <https://dev.mysql.com/doc/refman/5.6/en/date-and-time-type-overview.html>
     * 
     * A date. The supported range is '1000-01-01' to '9999-12-31'. MySQL displays DATE values 
     * in 'YYYY-MM-DD' format, but permits assignment of values to DATE columns using either strings 
     * or numbers. 
     * 
     * @return \GIndie\DBHandler\MySQL56\Instance\DataType
     * @since 18-08-01
     */
    public static function date()
    {
        $rtnData = new DataType(static::DATATYPE_DATE);
        return $rtnData;
    }

    /**
     * DATETIME[(fsp)]
     * 
     * @link <https://dev.mysql.com/doc/refman/5.6/en/date-and-time-type-overview.html>
     * 
     * A date and time combination. The supported range is '1000-01-01 00:00:00.000000' 
     * to '9999-12-31 23:59:59.999999'. MySQL displays DATETIME values in 
     * 'YYYY-MM-DD HH:MM:SS[.fraction]' format, but permits assignment of values to 
     * DATETIME columns using either strings or numbers.
     * 
     * As of MySQL 5.6.5, automatic initialization and updating to the current date and 
     * time for DATETIME columns can be specified using DEFAULT and ON UPDATE column 
     * definition clauses, as described in Section 11.3.5, “Automatic Initialization and 
     * Updating for TIMESTAMP and DATETIME”.
     * 
     * @param null|string $fsp As of MySQL 5.6.4, an optional fsp value in the range from 0 to 6 may be given to 
     * specify fractional seconds precision. A value of 0 signifies that there is no 
     * fractional part. If omitted, the default precision is 0.
     * 
     * @return \GIndie\DBHandler\MySQL56\Instance\DataType
     * @since 18-08-01
     */
    public static function datetime($fsp = null)
    {
        $rtnData = new DataType(static::DATATYPE_DATETIME);
        $rtnData->setFSP($fsp);
        return $rtnData;
    }

    /**
     * TIME[(fsp)]
     * 
     * A time. The range is '-838:59:59.000000' to '838:59:59.000000'. MySQL displays TIME values 
     * in 'HH:MM:SS[.fraction]' format, but permits assignment of values to TIME columns using 
     * either strings or numbers.
     * 
     * As of MySQL 5.6.4, an optional fsp value in the range from 0 to 6 may be given to specify 
     * fractional seconds precision. A value of 0 signifies that there is no fractional part. 
     * If omitted, the default precision is 0. 
     * 
     * @return \GIndie\DBHandler\MySQL56\Instance\DataType
     * @since 18-08-01
     */
    public static function time($fsp = null)
    {
        $rtnData = new DataType(static::DATATYPE_TIME);
        $rtnData->setFSP($fsp);
        return $rtnData;
    }

    /**
     * ENUM('value1','value2',...) [CHARACTER SET charset_name] [COLLATE collation_name]
     * 
     * @link <https://dev.mysql.com/doc/refman/5.6/en/string-type-overview.html>
     * 
     * An enumeration. A string object that can have only one value, chosen from the list of 
     * values 'value1', 'value2', ..., NULL or the special '' error value. ENUM values are represented 
     * internally as integers.
     * 
     * An ENUM column can have a maximum of 65,535 distinct elements. (The practical limit is less than 
     * 3000.) A table can have no more than 255 unique element list definitions among its ENUM and 
     * SET columns considered as a group. For more information on these limits, see Section C.10.5, 
     * “Limits Imposed by .frm File Structure”. 
     * 
     * @param array $values
     * @param null|string $charsetName
     * @param null|string $collationName
     * 
     * @return \GIndie\DBHandler\MySQL56\Instance\DataType
     * @since 18-08-01
     */
    public static function enum(array $values, $charsetName = null, $collationName = null)
    {
        $rtnData = new DataType(static::DATATYPE_ENUM);
        return $rtnData;
    }

    /**
     * SERIAL is an alias for BIGINT UNSIGNED NOT NULL AUTO_INCREMENT UNIQUE.
     * 
     * @link <https://dev.mysql.com/doc/refman/5.6/en/numeric-type-overview.html>
     * 
     * Some things you should be aware of with respect to BIGINT columns:
     * All arithmetic is done using signed BIGINT or DOUBLE values, so you should not use 
     * unsigned big integers larger than 9223372036854775807 (63 bits) except with bit functions! 
     * If you do that, some of the last digits in the result may be wrong because of rounding 
     * errors when converting a BIGINT value to a DOUBLE.
     * 
     * @return \GIndie\DBHandler\MySQL56\Instance\DataType
     * @since 18-08-01
     */
    public static function serial()
    {
        $rtnData = new DataType(static::DATATYPE_SERIAL);
        return $rtnData;
    }

    /**
     * TEXT[(M)] [CHARACTER SET charset_name] [COLLATE collation_name]
     * 
     * @link <https://dev.mysql.com/doc/refman/5.6/en/string-type-overview.html>
     * 
     * A TEXT column with a maximum length of 65,535 (216 − 1) characters. The effective maximum 
     * length is less if the value contains multibyte characters. Each TEXT value is stored using 
     * a 2-byte length prefix that indicates the number of bytes in the value.
     * 
     * An optional length M can be given for this type. If this is done, MySQL creates the column 
     * as the smallest TEXT type large enough to hold values M characters long. 
     * 
     * @param int $m
     * @param string|null $charsetName
     * @param string|null $collationName
     * 
     * @return \GIndie\DBHandler\MySQL56\Instance\DataType
     * @since 18-08-01
     */
    public static function text($m = null, $charsetName = null, $collationName = null)
    {
        $rtnData = new DataType(static::DATATYPE_TEXT);
        $rtnData->setM($m);
        $rtnData->setCharacterSet($charsetName);
        $rtnData->setCollation($collationName);
        return $rtnData;
    }

    /**
     * TINYINT[(M)] [UNSIGNED] [ZEROFILL]
     * 
     * @link <https://dev.mysql.com/doc/refman/5.6/en/numeric-type-overview.html>
     * 
     * A very small integer. The signed range is -128 to 127. The unsigned range is 0 to 255.
     * 
     * @param int $m
     * @param boolean $unsigned
     * @param boolean $zerofill 
     * 
     * @return \GIndie\DBHandler\MySQL56\Instance\DataType
     * @since 18-08-01
     * @edit 18-08-16
     * - Upgraded use of setUnsigned()
     */
    public static function tinyint($m, $unsigned = false, $zerofill = false)
    {
        $rtnData = new DataType(static::DATATYPE_TINYINT);
        $rtnData->setM($m);
        $rtnData->setUnsigned($unsigned);
        $rtnData->setZerofill($zerofill);
        return $rtnData;
    }

    /**
     * TINYTEXT [CHARACTER SET charset_name] [COLLATE collation_name]
     * 
     * @link <https://dev.mysql.com/doc/refman/5.6/en/string-type-overview.html>
     * 
     * A TEXT column with a maximum length of 255 (28 − 1) characters. The effective maximum 
     * length is less if the value contains multibyte characters. Each TINYTEXT value is stored 
     * using a 1-byte length prefix that indicates the number of bytes in the value. 
     * 
     * @param int $m
     * @param string|null $charsetName
     * @param string|null $collationName
     * 
     * @return \GIndie\DBHandler\MySQL56\Instance\DataType
     * @since 18-08-01
     */
    public static function tinytext($m, $charsetName = null, $collationName = null)
    {
        $rtnData = new DataType(static::DATATYPE_TINYTEXT);
        $rtnData->setM($m);
        $rtnData->setCharacterSet($charsetName);
        $rtnData->setCollation($collationName);
        return $rtnData;
    }

    /**
     * [NATIONAL] VARCHAR(M) [CHARACTER SET charset_name] [COLLATE collation_name]
     * 
     * @link <https://dev.mysql.com/doc/refman/5.6/en/string-type-overview.html>
     * 
     * A variable-length string. M represents the maximum column length in characters. 
     * The range of M is 0 to 65,535. The effective maximum length of a VARCHAR is subject to 
     * the maximum row size (65,535 bytes, which is shared among all columns) and the character 
     * set used. For example, utf8 characters can require up to three bytes per character, so a 
     * VARCHAR column that uses the utf8 character set can be declared to be a maximum of 21,844 
     * characters. See Section C.10.4, “Limits on Table Column Count and Row Size”.
     * 
     * MySQL stores VARCHAR values as a 1-byte or 2-byte length prefix plus data. The length prefix 
     * indicates the number of bytes in the value. A VARCHAR column uses one length byte if values 
     * require no more than 255 bytes, two length bytes if values may require more than 255 bytes. 
     * 
     * VARCHAR is shorthand for CHARACTER VARYING. NATIONAL VARCHAR is the standard SQL way to define 
     * that a VARCHAR column should use some predefined character set. MySQL uses utf8 as this 
     * predefined character set. Section 10.3.7, “The National Character Set”. NVARCHAR is shorthand 
     * for NATIONAL VARCHAR. 
     * 
     * @param int $m
     * @param string|null $charsetName
     * @param string|null $collationName
     * 
     * @return \GIndie\DBHandler\MySQL56\Instance\DataType
     * @since 18-08-01
     */
    public static function varchar($m, $charsetName = null, $collationName = null)
    {
        $rtnData = new DataType(static::DATATYPE_VARCHAR);
        $rtnData->setM($m);
        $rtnData->setCharacterSet($charsetName);
        $rtnData->setCollation($collationName);
        return $rtnData;
    }

    /**
     * INTEGER[(M)] [UNSIGNED] [ZEROFILL] ALIAS FOR INT[(M)] [UNSIGNED] [ZEROFILL]
     * 
     * @link <https://dev.mysql.com/doc/refman/5.6/en/numeric-type-overview.html>
     * 
     * A normal-size integer. The signed range is -2147483648 to 2147483647. 
     * 
     * The unsigned range is 0 to 4294967295.
     * 
     * SERIAL is an alias for BIGINT UNSIGNED NOT NULL AUTO_INCREMENT UNIQUE.
     * SERIAL DEFAULT VALUE in the definition of an integer column is an alias for 
     * NOT NULL AUTO_INCREMENT UNIQUE.
     * 
     * @param null|boolean $m
     * @param null|boolean $unsigned
     * @param null|boolean $zerofill
     * @return \GIndie\DBHandler\MySQL56\Instance\DataType
     * @since 18-07-31
     * @edit 18-08-15
     * - use setUnsigned
     */
    public static function integer($m = null, $unsigned = false, $zerofill = false)
    {
        $rntColumn = new DataType(static::DATATYPE_INT);
        $rntColumn->setM($m);
        $rntColumn->setUnsigned($unsigned);
        $rntColumn->setZerofill($zerofill);
        return $rntColumn;
    }

    /**
     *
     * @var string 
     * @since 18-07-31
     */
    private $datatype;

    /**
     * 
     * @param string $datatype
     * @since 18-07-31
     */
    public function __construct($datatype)
    {
        $this->datatype = $datatype;
    }

    /**
     * 
     * @return string
     * @since 18-08-01
     */
    public function getDatatype()
    {
        return $this->datatype;
    }

    /**
     *
     * @var null|boolean 
     * @since 18-07-31
     */
    private $m;

    /**
     * 
     * @param int $m
     * @return \GIndie\DBHandler\MySQL56\Instance\DataType
     * @since 18-07-31
     * @edit 18-08-16
     * - Use of explicit $m
     */
    public function setM($m)
    {
        $this->m = $m;
        return $this;
    }

    /**
     * 
     * @return null|boolean 
     * @since 18-07-31
     */
    public function getM()
    {
        return $this->m;
    }

    /**
     *
     * @var null|int 
     * @since 18-07-31
     */
    private $d;

    /**
     * 
     * @param int $d
     * @return \GIndie\DBHandler\MySQL56\Instance\DataType
     * @since 18-07-31
     * @edit 18-08-16
     * - Use of explicit $d
     */
    public function setD($d)
    {
        $this->d = $d;
        return $this;
    }

    /**
     * 
     * @return null|boolean 
     * @since 18-07-31
     */
    public function getD()
    {
        return $this->d;
    }

    /**
     *
     * @var null|boolean 
     * @since 18-07-31
     */
    private $unsigned;

    /**
     * 
     * @param boolean $unsigned
     * @return \GIndie\DBHandler\MySQL56\Instance\DataType
     * @since 18-07-31
     * @edit 18-08-16
     * - Use of explicit $unsigned
     */
    public function setUnsigned($unsigned)
    {
        $this->unsigned = $unsigned;
//        switch (true)
//        {
//            case \is_null($unsigned):
//                unset();
//                break;
//            case \is_bool($unsigned):
//                $this->unsigned = $unsigned;
//                break;
//        }
        return $this;
    }

    /**
     * 
     * @return null|boolean 
     * @since 18-07-31
     */
    public function getUnsigned()
    {
        return $this->unsigned;
    }

    /**
     *
     * @var null|boolean 
     * @since 18-07-31
     */
    private $zerofill;

    /**
     * 
     * @param null|boolean $zerofill
     * @return GIndie\DBHandler\MySQL56\Instance\DataType
     * @since 18-07-31
     * @edit 18-08-16
     * - Use of explicit $zerofill
     */
    public function setZerofill($zerofill)
    {
        $this->zerofill = $zerofill;
//        switch (true)
//        {
//            case \is_null($zerofill):
//                unset($this->zerofill);
//                break;
//            case \is_bool($zerofill):
//                $this->zerofill = $zerofill;
//                break;
//        }
        return $this;
    }

    /**
     * 
     * @return null|boolean 
     * @since 18-07-31
     */
    public function getZerofill()
    {
        return $this->zerofill;
    }

    /**
     *
     * @var string 
     * @since 18-08-01
     */
    private $charsetName;

    /**
     * 
     * @return string
     * @since 18-08-01
     */
    public function getCharsetName()
    {
        return $this->charsetName;
    }

    /**
     * 
     * @param string $charsetName
     * @return \GIndie\DBHandler\MySQL56\Instance\DataType
     */
    public function setCharacterSet($charsetName)
    {
        $this->charsetName = $charsetName;
        return $this;
    }

    /**
     *
     * @var string 
     * @since 18-08-01
     */
    private $collationName;

    /**
     * 
     * @return string
     * @since 18-08-01
     */
    public function getCollationName()
    {
        return $this->collationName;
    }

    /**
     * 
     * @param string $collationName
     * @since 18-08-01
     * @return \GIndie\DBHandler\MySQL56\Instance\DataType
     */
    public function setCollation($collationName)
    {
        $this->collationName = $collationName;
        return $this;
    }

    /**
     *
     * @var int 
     * @since 18-08-01
     */
    private $FSP;

    /**
     * 
     * @return int
     * @since 18-08-01
     */
    public function getFSP()
    {
        return $this->FSP;
    }

    /**
     * 
     * @param int $fsp
     * @return \GIndie\DBHandler\MySQL56\Instance\DataType
     * @since 18-08-01
     * @todo 
     * - From 0 to 6 or null
     */
    public function setFSP($fsp)
    {
        $this->FSP = $fsp;
        return $this;
    }

    /**
     *
     * @var array 
     * @since 18-08-01
     */
    private $values;

    /**
     * 
     * @return array
     * @since 18-08-01
     */
    public function getValues()
    {
        return $this->values;
    }

    /**
     * 
     * @param array $values
     * @return \GIndie\DBHandler\MySQL56\Instance\DataType
     * @since 18-08-01
     */
    public function setValues(array $values)
    {
        $this->values = $values;
        return $this;
    }

}
