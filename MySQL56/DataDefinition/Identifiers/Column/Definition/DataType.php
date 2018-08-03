<?php

namespace GIndie\DBHandler\MySQL56\DataDefinition\Identifiers\Column\Definition;

/**
 * data_type represents the data type in a column definition. spatial_type represents
 * a spatial data type. The data type syntax shown is representative only. For a full 
 * description of the syntax available for specifying column data types, as well as 
 * information about the properties of each type, see Chapter 11, Data Types, and 
 * Section 11.5, “Spatial Data Types”.
 * 
 * @link <https://dev.mysql.com/doc/refman/5.6/en/create-table.html#create-table-types-attributes>
 * 
 * Some attributes do not apply to all data types. AUTO_INCREMENT applies only to 
 * integer and floating-point types. DEFAULT does not apply to the BLOB or TEXT types.
 * 
 * Character data types (CHAR, VARCHAR, TEXT) can include CHARACTER SET and COLLATE 
 * attributes to specify the character set and collation for the column. For details, 
 * see Chapter 10, Character Sets, Collations, Unicode. CHARSET is a synonym for 
 * CHARACTER SET.
 * Example: CREATE TABLE t (c CHAR(20) CHARACTER SET utf8 COLLATE utf8_bin);
 * 
 * MySQL 5.6 interprets length specifications in character column definitions in 
 * characters. Lengths for BINARY and VARBINARY are in bytes.
 * 
 * For CHAR, VARCHAR, BINARY, and VARBINARY columns, indexes can be created that use 
 * only the leading part of column values, using col_name(length) syntax to specify an 
 * index prefix length. BLOB and TEXT columns also can be indexed, but a prefix length 
 * must be given. Prefix lengths are given in characters for nonbinary string types and 
 * in bytes for binary string types. That is, index entries consist of the first length 
 * characters of each column value for CHAR, VARCHAR, and TEXT columns, and the first 
 * length bytes of each column value for BINARY, VARBINARY, and BLOB columns. Indexing 
 * only a prefix of column values like this can make the index file much smaller. For 
 * additional information about index prefixes, see Section 13.1.13, “CREATE INDEX 
 * Syntax”.
 * 
 * Only the InnoDB and MyISAM storage engines support indexing on BLOB and TEXT columns. 
 * For example: CREATE TABLE test (blob_col BLOB, INDEX(blob_col(10)));
 *
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * @copyright (c) 2018 Angel Sierra Vega. Grupo INDIE.
 *
 * @package GIndie\DBHandler\DataDefinition\MySQL56\
 *
 * @version 0A.F4
 * @since 18-04-30
 * @todo 
 * - setter and getter for D
 */
interface DataType
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
    public static function blob($m=null);

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
     * @since 18-02-14
     * - Added from \GIndie\DBHandler\MySQL\Table\Column
     * @edit 18-04-27
     * - Defined interface
     * @edit 18-04-30
     * - Added from \GIndie\DBHandler\MySQL56\DataDefinition\DataTypes\Numeric
     */
    public static function tinyint($m, $unsigned = false, $zerofill = false);
    
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
     * @since 18-08-02
     */
    public static function timestamp($fsp = null);

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
     * @param null|int $m
     * @param boolean $unsigned
     * @param boolean $zerofill 
     * 
     * @since 18-02-14
     * - Added from \GIndie\DBHandler\MySQL\Table\Column
     * @edit 18-04-27
     * - Defined interface
     * @edit 18-04-30
     * - Added from \GIndie\DBHandler\MySQL56\DataDefinition\DataTypes\Numeric
     */
    public static function integer($m = null, $unsigned = false, $zerofill = false);

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
     * @since 18-02-14
     * - Added from \GIndie\DBHandler\MySQL\Table\Column
     * @edit 18-04-27
     * - Defined interface
     * @edit 18-04-30
     * - Added from \GIndie\DBHandler\MySQL56\DataDefinition\DataTypes\Numeric
     */
    public static function serial();

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
     * @since 18-04-26
     * - Added from \GIndie\DBHandler\MySQL\Table\Column
     * @edit 18-04-30
     * - Added from \GIndie\DBHandler\MySQL56\DataDefinition\DataTypes\DateTime
     * @edit 18-08-01
     * - Added default null
     */
    public static function datetime($fsp = null);

    /**
     * DATE
     * 
     * @link <https://dev.mysql.com/doc/refman/5.6/en/date-and-time-type-overview.html>
     * 
     * A date. The supported range is '1000-01-01' to '9999-12-31'. MySQL displays DATE values 
     * in 'YYYY-MM-DD' format, but permits assignment of values to DATE columns using either strings 
     * or numbers. 
     * 
     * @since 18-04-26
     * - Added from \GIndie\DBHandler\MySQL\Table\Column
     * @edit 18-04-30
     * - Added from \GIndie\DBHandler\MySQL56\DataDefinition\DataTypes\DateTime
     */
    public static function date();

    /**
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
     * @since 18-02-14
     * - Added from \GIndie\DBHandler\MySQL\Table\Column
     * @edit 18-04-27
     * - Defined interface
     * @edit 18-04-30
     * - Added from \GIndie\DBHandler\MySQL56\DataDefinition\DataTypes\String
     */
    public static function char($m, $charsetName = null, $collationName = null);

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
     * @since 18-02-14
     * - Added from \GIndie\DBHandler\MySQL\Table\Column
     * @edit 18-04-27
     * - Defined interface
     * @edit 18-04-30
     * - Added from \GIndie\DBHandler\MySQL56\DataDefinition\DataTypes\String
     */
    public static function varchar($m, $charsetName = null, $collationName = null);

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
     * @since 18-02-14
     * - Added from \GIndie\DBHandler\MySQL\Table\Column
     * @edit 18-04-27
     * - Defined interface
     * @edit 18-04-30
     * - Added from \GIndie\DBHandler\MySQL56\DataDefinition\DataTypes\String
     */
    public static function tinytext($m, $charsetName = null, $collationName = null);

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
     * @param int|null $m
     * @param string|null $charsetName
     * @param string|null $collationName
     * 
     * @since 18-02-14
     * - Added from \GIndie\DBHandler\MySQL\Table\Column
     * @edit 18-04-27
     * - Defined interface
     * @edit 18-04-30
     * - Added from \GIndie\DBHandler\MySQL56\DataDefinition\DataTypes\string
     * @edit 18-08-15
     * - Default null value for $m
     */
    public static function text($m = null, $charsetName = null, $collationName = null);

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
     * @since 18-02-14
     * - Added from \GIndie\DBHandler\MySQL\Table\Column
     * @edit 18-04-27
     * - Defined interface
     * @edit 18-04-30
     * - Added from \GIndie\DBHandler\MySQL56\DataDefinition\DataTypes\string
     */
    public static function enum(array $values, $charsetName = null, $collationName = null);

    /**
     * @since 18-04-30
     * @return string
     */
    public function getDatatype();

    /**
     * @since 18-04-30
     * @return int
     */
    public function getM();

    /**
     * 
     * @since 18-04-30
     * @return boolean
     */
    public function getUnsigned();

    /**
     * 
     * @since 18-04-30
     * @return boolean
     */
    public function getZerofill();

    /**
     * An optional fsp value in the range from 0 to 6 may be given to 
     * specify fractional seconds precision. A value of 0 signifies that there is no 
     * fractional part. If omitted, the default precision is 0.
     * 
     * @since 18-04-30
     * 
     * @return string
     */
    public function getFSP();

    /**
     * 
     * @since 18-04-30
     * @return string
     */
    public function getCharsetName();

    /**
     * 
     * @since 18-04-30
     * @return string
     */
    public function getCollationName();

    /**
     * 
     * @since 18-04-30
     * @return array
     */
    public function getValues();

    /**
     * @since 18-04-30
     * @param int $m
     */
    public function setM($m);

    /**
     * @since 18-04-30
     * @param type $unsigned
     */
    public function setUnsigned($unsigned);

    /**
     * @since 18-04-30
     * @param boolean $zerofill
     */
    public function setZerofill($zerofill);

    /**
     * As of MySQL 5.6.4, an optional fsp value in the range from 0 to 6 may be given to 
     * specify fractional seconds precision. A value of 0 signifies that there is no 
     * fractional part. If omitted, the default precision is 0.
     * 
     * @since 18-04-30
     * @param int $fsp
     */
    public function setFSP($fsp);

    /**
     * @since 18-04-30
     * @param string $charsetName
     */
    public function setCharacterSet($charsetName);

    /**
     * 
     * @param string $collationName
     */
    public function setCollation($collationName);

    /**
     * 
     * @param array $values
     */
    public function setValues(array $values);

    /**
     * 
     * @param int $d
     * @since 18-08-01
     */
    public function setD($d);
}
