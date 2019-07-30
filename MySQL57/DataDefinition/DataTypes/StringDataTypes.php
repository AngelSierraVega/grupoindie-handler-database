<?php

/**
 * GI-DBHandler-DVLP - StringDataTypes
 *
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * @copyright (c) 2018 Angel Sierra Vega. Grupo INDIE.
 *
 * @package GIndie\DBHandler\MySQL57\DataDefinition
 *
 * @version 00.C7
 * @since 18-11-02
 */

namespace GIndie\DBHandler\MySQL57\DataDefinition\DataTypes;

/**
 * 
 * @edit 18-11-02
 * - Copied code from GIndie\DBHandler\MySQL56\...
 * @edit 18-11-11
 * - Moved back methods from Identifiers\Column\Definition\DataType
 * - Upgraded DocBlock
 * @edit 19-07-25
 * - Added set()
 */
interface StringDataTypes
{

    /**
     * CHAR is shorthand for CHARACTER. NATIONAL CHAR (or its equivalent short 
     * form, NCHAR) is the standard SQL way to define that a CHAR column should 
     * use some predefined character set. MySQL uses utf8 as this predefined 
     * character set. Section 10.3.7, “The National Character Set”.
     * 
     * The CHAR BYTE data type is an alias for the BINARY data type. 
     * This is a compatibility feature.
     * 
     * MySQL permits you to create a column of type CHAR(0). This is useful 
     * primarily when you have to be compliant with old applications that 
     * depend on the existence of a column but that do not actually use its 
     * value. CHAR(0) is also quite nice when you need a column that can take 
     * only two values: A column that is defined as CHAR(0) NULL occupies only 
     * one bit and can take only the values NULL and '' (the empty string).
     * 
     * @since 18-04-26 
     * @edit 18-05-01
     * @edit 18-11-11
     * - Upgraded DocBlock
     */
    const DATATYPE_CHAR = "CHAR";

    /**
     * A fixed-length string that is always right-padded with spaces to the 
     * specified length when stored. 
     * 
     * Note: Trailing spaces are removed when CHAR values are retrieved 
     * unless the PAD_CHAR_TO_FULL_LENGTH SQL mode is enabled.
     * 
     * @link <https://dev.mysql.com/doc/refman/5.7/en/string-type-overview.html>
     * 
     * @param int|null $m The column length in characters. The range of $m is 0 
     * to 255. If $m is omitted, the length is 1.
     * @param string|null $charsetName Optional character set name
     * @param string|null $collationName Optional collation name
     * 
     * @return \GIndie\DBHandler\MySQL57\Instance\DataType
     * 
     * @since 18-02-14
     * - Added from \GIndie\DBHandler\MySQL\Table\Column
     * @edit 18-04-27
     * - Defined interface
     * @edit 18-04-30
     * - Added from \GIndie\DBHandler\MySQL56\DataDefinition\DataTypes\String
     * @edit 18-11-11
     * - Upgraded DocBlock
     * - Moved from Identifiers\Column\Definition\DataType
     */
    public static function char($m = null, $charsetName = null, $collationName = null);

    /**
     * VARCHAR is shorthand for CHARACTER VARYING. NATIONAL VARCHAR is the 
     * standard SQL way to define that a VARCHAR column should use some 
     * predefined character set. MySQL uses utf8 as this predefined character 
     * set. Section 10.3.7, “The National Character Set”. NVARCHAR is shorthand 
     * for NATIONAL VARCHAR. 
     * 
     * 
     * @since 18-04-26 
     * @edit 18-05-01
     * @edit 18-11-11
     * - Upgraded DocBlock
     */
    const DATATYPE_VARCHAR = "VARCHAR";

    /**
     * A variable-length string. MySQL follows the standard SQL specification, 
     * and does not remove trailing spaces from VARCHAR values.
     * 
     * The effective maximum length of a VARCHAR is subject to the maximum row 
     * size (65,535 bytes, which is shared among all columns) and the character 
     * set used. For example, utf8 characters can require up to three bytes per 
     * character, so a VARCHAR column that uses the utf8 character set can be 
     * declared to be a maximum of 21,844 characters.
     * 
     * @link <https://dev.mysql.com/doc/refman/5.7/en/string-type-overview.html>
     * 
     * @param int $m Represents the maximum column length in characters. The 
     * range of M is 0 to 65,535. 
     * @param string|null $charsetName Optional character set name
     * @param string|null $collationName Optional collation name
     * 
     * @return \GIndie\DBHandler\MySQL57\Instance\DataType
     * 
     * 
     * @since 18-02-14
     * - Added from \GIndie\DBHandler\MySQL\Table\Column
     * @edit 18-04-27
     * - Defined interface
     * @edit 18-04-30
     * - Added from \GIndie\DBHandler\MySQL56\DataDefinition\DataTypes\String
     * @edit 18-11-11
     * - Upgraded DocBlock
     * - Moved from Identifiers\Column\Definition\DataType
     */
    public static function varchar($m, $charsetName = null, $collationName = null);

    /**
     * BINARY[(M)]
     * @since 18-04-26 
     * @edit 18-05-01
     * @edit 18-11-11
     * - Upgraded DocBlock
     */
    const DATATYPE_BINARY = "BINARY";

    /**
     * The BINARY type is similar to the CHAR type, but stores binary byte 
     * strings rather than nonbinary character strings. 
     * 
     * @link <https://dev.mysql.com/doc/refman/5.7/en/string-type-overview.html>
     * 
     * @param int|null $m An optional length M represents the column length in 
     * bytes. If omitted, M defaults to 1.
     * 
     * @return \GIndie\DBHandler\MySQL57\Instance\DataType
     * 
     * @since 18-11-11
     */
    public static function binary($m = null);

    /**
     * VARBINARY(M)
     * The VARBINARY type is similar to the VARCHAR type, but stores binary byte strings rather than nonbinary character strings. M represents the maximum column length in bytes. 
     * @since 18-04-26 
     * @edit 18-05-01
     * @edit 18-11-11
     * - Upgraded DocBlock
     */
    const DATATYPE_VARBINARY = "VARBINARY";

    /**
     * TINYBLOB
     * A BLOB column with a maximum length of 255 (28 − 1) bytes. Each TINYBLOB value is stored using a 1-byte length prefix that indicates the number of bytes in the value. 
     * @since 18-04-26 
     * @edit 18-05-01
     * @edit 18-11-11
     * - Upgraded DocBlock
     */
    const DATATYPE_TINYBLOB = "TINYBLOB";

    /**
     * TINYTEXT [CHARACTER SET charset_name] [COLLATE collation_name]
     * 
     * @since 18-04-26 
     * @edit 18-05-01
     * @edit 18-11-11
     * - Upgraded DocBlock
     */
    const DATATYPE_TINYTEXT = "TINYTEXT";

    /**
     * A TEXT column with a maximum length of 255 (28 − 1) characters. The 
     * effective maximum length is less if the value contains multibyte 
     * characters. Each TINYTEXT value is stored using a 1-byte length prefix 
     * that indicates the number of bytes in the value.
     * 
     * @link <https://dev.mysql.com/doc/refman/5.7/en/string-type-overview.html>
     * 
     * @param string|null $charsetName Optional character set name
     * @param string|null $collationName Optional collation name
     * 
     * @return \GIndie\DBHandler\MySQL57\Instance\DataType
     * 
     * @since 18-02-14
     * - Added from \GIndie\DBHandler\MySQL\Table\Column
     * @edit 18-04-27
     * - Defined interface
     * @edit 18-04-30
     * - Added from \GIndie\DBHandler\MySQL56\DataDefinition\DataTypes\String
     * @edit 18-11-11
     * - Upgraded DocBlock
     * - Moved from Identifiers\Column\Definition\DataType
     */
    public static function tinytext($charsetName = null, $collationName = null);

    /**
     * BLOB[(M)]
     * 
     * @since 18-04-26 
     * @edit 18-05-01
     * @edit 18-11-11
     * - Upgraded DocBlock
     */
    const DATATYPE_BLOB = "BLOB";

    /**
     * A BLOB column with a maximum length of 65,535 (216 − 1) bytes. Each BLOB 
     * value is stored using a 2-byte length prefix that indicates the number of 
     * bytes in the value.
     * 
     * @link <https://dev.mysql.com/doc/refman/5.7/en/string-type-overview.html>
     * 
     * @param int|null $m An optional length M can be given for this type. 
     * If this is done, MySQL creates the column as the smallest BLOB type large 
     * enough to hold values M bytes long. 
     * 
     * @return \GIndie\DBHandler\MySQL57\Instance\DataType
     * 
     * @since 18-11-11
     */
    public static function blob($m = null);

    /**
     * TEXT[(M)] [CHARACTER SET charset_name] [COLLATE collation_name]
     * 
     * @since 18-04-26 
     * @edit 18-05-01
     * @edit 18-11-11
     * - Upgraded DocBlock
     */
    const DATATYPE_TEXT = "TEXT";

    /**
     * A TEXT column with a maximum length of 65,535 (216 − 1) characters. The 
     * effective maximum length is less if the value contains multibyte 
     * characters. Each TEXT value is stored using a 2-byte length prefix that 
     * indicates the number of bytes in the value.
     * 
     * @link <https://dev.mysql.com/doc/refman/5.7/en/string-type-overview.html>
     * 
     * @param int|null $m An optional length M can be given for this type. If 
     * this is done, MySQL creates the column as the smallest TEXT type large 
     * enough to hold values M characters long.
     * @param string|null $charsetName Optional character set name
     * @param string|null $collationName Optional collation name
     * 
     * @return \GIndie\DBHandler\MySQL57\Instance\DataType
     * 
     * @since 18-02-14
     * - Added from \GIndie\DBHandler\MySQL\Table\Column
     * @edit 18-04-27
     * - Defined interface
     * @edit 18-04-30
     * - Added from \GIndie\DBHandler\MySQL56\DataDefinition\DataTypes\string
     * @edit 18-08-15
     * - Default null value for $m
     * @edit 18-11-11
     * - Upgraded DocBlock
     * - Moved from Identifiers\Column\Definition\DataType
     */
    public static function text($m = null, $charsetName = null, $collationName = null);

    /**
     * MEDIUMBLOB
     * A BLOB column with a maximum length of 16,777,215 (224 − 1) bytes. Each MEDIUMBLOB value is stored using a 3-byte length prefix that indicates the number of bytes in the value. 
     * @since 18-04-26 
     * @edit 18-05-01
     * @edit 18-11-11
     * - Upgraded DocBlock
     */
    const DATATYPE_MEDIUMBLOB = "MEDIUMBLOB";

    /**
     * MEDIUMTEXT [CHARACTER SET charset_name] [COLLATE collation_name]
     * A TEXT column with a maximum length of 16,777,215 (224 − 1) characters. The effective maximum length is less if the value contains multibyte characters. Each MEDIUMTEXT value is stored using a 3-byte length prefix that indicates the number of bytes in the value. 
     * @since 18-04-26 
     * @edit 18-05-01
     * @edit 18-11-11
     * - Upgraded DocBlock
     */
    const DATATYPE_MEDIUMTEXT = "MEDIUMTEXT";

    /**
     * LONGBLOB
     * A BLOB column with a maximum length of 4,294,967,295 or 4GB (232 − 1) bytes. The effective maximum length of LONGBLOB columns depends on the configured maximum packet size in the client/server protocol and available memory. Each LONGBLOB value is stored using a 4-byte length prefix that indicates the number of bytes in the value. 
     * @since 18-04-26 
     * @edit 18-05-01
     * @edit 18-11-11
     * - Upgraded DocBlock
     */
    const DATATYPE_LONGBLOB = "LONGBLOB";

    /**
     * LONGTEXT [CHARACTER SET charset_name] [COLLATE collation_name]
     * A TEXT column with a maximum length of 4,294,967,295 or 4GB (232 − 1) characters. The effective maximum length is less if the value contains multibyte characters. The effective maximum length of LONGTEXT columns also depends on the configured maximum packet size in the client/server protocol and available memory. Each LONGTEXT value is stored using a 4-byte length prefix that indicates the number of bytes in the value. 
     * @since 18-04-26 
     * @edit 18-05-01
     * @edit 18-11-11
     * - Upgraded DocBlock
     */
    const DATATYPE_LONGTEXT = "LONGTEXT";

    /**
     * ENUM('value1','value2',...) [CHARACTER SET charset_name] [COLLATE collation_name]
     * 
     * @since 18-04-26 
     * @edit 18-05-01
     * @edit 18-11-11
     * - Upgraded DocBlock
     */
    const DATATYPE_ENUM = "ENUM";

    /**
     * An enumeration. A string object that can have only one value, chosen 
     * from the list of values 'value1', 'value2', ..., NULL or the special '' 
     * error value. ENUM values are represented internally as integers.
     * 
     * @link <https://dev.mysql.com/doc/refman/5.7/en/string-type-overview.html> 
     * 
     * @param array $values An ENUM column can have a maximum of 65,535 distinct 
     * elements. (The practical limit is less than 3000.) A table can have no 
     * more than 255 unique element list definitions among its ENUM and SET 
     * columns considered as a group.
     * @param string|null $charsetName Optional character set name
     * @param string|null $collationName Optional collation name
     * 
     * @return \GIndie\DBHandler\MySQL57\Instance\DataType
     * 
     * @since 18-02-14
     * - Added from \GIndie\DBHandler\MySQL\Table\Column
     * @edit 18-04-27
     * - Defined interface
     * @edit 18-04-30
     * - Added from \GIndie\DBHandler\MySQL56\DataDefinition\DataTypes\string
     * @edit 18-11-11
     * - Upgraded DocBlock
     * - Moved from Identifiers\Column\Definition\DataType
     */
    public static function enum(array $values, $charsetName = null, $collationName = null);

    /**
     * SET('value1','value2',...) [CHARACTER SET charset_name] [COLLATE collation_name]
     * A set. A string object that can have zero or more values, each of which must be chosen from the list of values 'value1', 'value2', ... SET values are represented internally as integers.
     * A SET column can have a maximum of 64 distinct members. A table can have no more than 255 unique element list definitions among its ENUM and SET columns considered as a group.
     * @since 18-04-26 
     * @edit 18-05-01
     * @edit 18-11-11
     * - Upgraded DocBlock
     */
    const DATATYPE_SET = "SET";
    
    /**
     * A set. A string object that can have zero or more values, each of which 
     * must be chosen from the list of values 'value1', 'value2', ... SETvalues 
     * are represented internally as integers. 
     * 
     * @link <https://dev.mysql.com/doc/refman/5.7/en/string-type-overview.html> 
     * 
     * @param array $values A SET column can have amaximum of 64 distinct 
     * members. A table can have no morethan 255 unique element list definitions 
     * among its ENUM and SET columns considered as agroup.
     * @param string|null $charsetName Optional character set name
     * @param string|null $collationName Optional collation name
     * 
     * @return \GIndie\DBHandler\MySQL57\Instance\DataType
     * 
     * @since 19-07-25
     */
    public static function set(array $values, $charsetName = null, $collationName = null);

}
