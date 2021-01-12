<?php

namespace GIndie\DBHandler\MySQL56\DataDefinition\DataTypes;

/**
 * GI-DBHandler-DVLP - String
 * 
 * A summary of the string data types follows. For additional information about properties 
 * and storage requirements of the string types, see Section 11.4, “String Types”, and 
 * Section 11.7, “Data Type Storage Requirements”.
 * 
 * In some cases, MySQL may change a string column to a type different from that given in a 
 * CREATE TABLE or ALTER TABLE statement. See Section 13.1.17.7, “Silent Column Specification Changes”.
 * 
 * MySQL interprets length specifications in character column definitions in character units. 
 * This applies to CHAR, VARCHAR, and the TEXT types.
 * 
 * Column definitions for many string data types can include attributes that specify the character 
 * set or collation of the column. These attributes apply to the CHAR, VARCHAR, the TEXT types, ENUM, 
 * and SET data types.
 * 
 * @link <https://dev.mysql.com/doc/refman/5.6/en/string-type-overview.html>
 *
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * @copyright (CC) 2020 Angel Sierra Vega. Grupo INDIE.
 * @license file://LICENSE
 *
 * @package GIndie\DBHandler\DataDefinition\MySQL56\
 *
 * @version 00.B0
 * 
 * @since 18-04-26
 * @edit 18-04-27
 * - Added some interfaces for static methods
 * @edit 18-05-01
 * - Added prefix DATATYPE_
 * @edit 18-10-02
 * - Upgraded version
 */
interface StringDataTypes
{

    /**
     * CHAR[(M)] [CHARACTER SET charset_name] [COLLATE collation_name]
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
     * @since 18-04-26 
     * @edit 18-05-01
     */
    const DATATYPE_CHAR = "CHAR";

    /**
     * NATIONAL CHAR[(M)] [CHARACTER SET charset_name] [COLLATE collation_name]
     * NCHAR[(M)] [CHARACTER SET charset_name] [COLLATE collation_name]
     * 
     * NATIONAL CHAR (or its equivalent short form, NCHAR) is the standard SQL way to define that a 
     * CHAR column should use some predefined character set. A fixed-length string that is always 
     * right-padded with spaces to the specified length when stored. M represents the column length 
     * in characters. The range of M is 0 to 255. If M is omitted, the length is 1. 
     * 
     * @since 18-04-27 
     * @edit 18-05-01
     */
    const DATATYPE_NCHAR = "NCHAR";

    /**
     * [NATIONAL] VARCHAR(M) [CHARACTER SET charset_name] [COLLATE collation_name]
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
     * @since 18-04-26 
     * @edit 18-05-01
     */
    const DATATYPE_VARCHAR = "VARCHAR";

    /**
     * BINARY[(M)]
     * The BINARY type is similar to the CHAR type, but stores binary byte strings rather than 
     * nonbinary character strings. An optional length M represents the column length in bytes. 
     * If omitted, M defaults to 1. 
     * 
     * @since 18-04-26 
     * @edit 18-05-01
     */
    const DATATYPE_BINARY = "BINARY";

    /**
     * VARBINARY(M)
     * 
     * The VARBINARY type is similar to the VARCHAR type, but stores binary byte strings rather 
     * than nonbinary character strings. M represents the maximum column length in bytes. 
     * 
     * @since 18-04-26 
     * @edit 18-05-01
     */
    const DATATYPE_VARBINARY = "VARBINARY";

    /**
     * TINYBLOB
     * 
     * A BLOB column with a maximum length of 255 (28 − 1) bytes. Each TINYBLOB value is stored 
     * using a 1-byte length prefix that indicates the number of bytes in the value. 
     * @since 18-04-26 
     * @edit 18-05-01
     */
    const DATATYPE_TINYBLOB = "TINYBLOB";

    /**
     * TINYTEXT [CHARACTER SET charset_name] [COLLATE collation_name]
     * 
     * A TEXT column with a maximum length of 255 (28 − 1) characters. The effective maximum 
     * length is less if the value contains multibyte characters. Each TINYTEXT value is stored 
     * using a 1-byte length prefix that indicates the number of bytes in the value. 
     * 
     * @since 18-04-26 
     * @edit 18-05-01
     */
    const DATATYPE_TINYTEXT = "TINYTEXT";

    /**
     * BLOB[(M)]
     * 
     * A BLOB column with a maximum length of 65,535 (216 − 1) bytes. Each BLOB value is stored 
     * using a 2-byte length prefix that indicates the number of bytes in the value.
     * 
     * An optional length M can be given for this type. If this is done, MySQL creates the column 
     * as the smallest BLOB type large enough to hold values M bytes long. 
     * 
     * @since 18-04-26 
     * @edit 18-05-01
     */
    const DATATYPE_BLOB = "BLOB";

    /**
     * TEXT[(M)] [CHARACTER SET charset_name] [COLLATE collation_name]
     * 
     * A TEXT column with a maximum length of 65,535 (216 − 1) characters. The effective maximum 
     * length is less if the value contains multibyte characters. Each TEXT value is stored using 
     * a 2-byte length prefix that indicates the number of bytes in the value.
     * 
     * An optional length M can be given for this type. If this is done, MySQL creates the column 
     * as the smallest TEXT type large enough to hold values M characters long. 
     * 
     * @since 18-04-26 
     * @edit 18-05-01
     */
    const DATATYPE_TEXT = "TEXT";

    /**
     * MEDIUMBLOB
     * 
     * A BLOB column with a maximum length of 16,777,215 (224 − 1) bytes. Each MEDIUMBLOB value is 
     * stored using a 3-byte length prefix that indicates the number of bytes in the value. 
     * 
     * @since 18-04-26 
     * @edit 18-05-01
     */
    const DATATYPE_MEDIUMBLOB = "MEDIUMBLOB";

    /**
     * MEDIUMTEXT [CHARACTER SET charset_name] [COLLATE collation_name]
     * 
     * A TEXT column with a maximum length of 16,777,215 (224 − 1) characters. The effective 
     * maximum length is less if the value contains multibyte characters. Each MEDIUMTEXT value 
     * is stored using a 3-byte length prefix that indicates the number of bytes in the value. 
     * 
     * @since 18-04-26 
     * @edit 18-05-01
     */
    const DATATYPE_MEDIUMTEXT = "MEDIUMTEXT";

    /**
     * LONGBLOB
     * 
     * A BLOB column with a maximum length of 4,294,967,295 or 4GB (232 − 1) bytes. The effective 
     * maximum length of LONGBLOB columns depends on the configured maximum packet size in the 
     * client/server protocol and available memory. Each LONGBLOB value is stored using a 4-byte 
     * length prefix that indicates the number of bytes in the value. 
     * 
     * @since 18-04-26 
     * @edit 18-05-01
     */
    const DATATYPE_LONGBLOB = "LONGBLOB";

    /**
     * LONGTEXT [CHARACTER SET charset_name] [COLLATE collation_name]
     * 
     * A TEXT column with a maximum length of 4,294,967,295 or 4GB (232 − 1) characters. 
     * The effective maximum length is less if the value contains multibyte characters. The 
     * effective maximum length of LONGTEXT columns also depends on the configured maximum packet 
     * size in the client/server protocol and available memory. Each LONGTEXT value is stored using 
     * a 4-byte length prefix that indicates the number of bytes in the value. 
     * 
     * @since 18-04-26 
     * @edit 18-05-01
     */
    const DATATYPE_LONGTEXT = "LONGTEXT";

    /**
     * ENUM('value1','value2',...) [CHARACTER SET charset_name] [COLLATE collation_name]
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
     * @since 18-04-26 
     * @edit 18-05-01
     */
    const DATATYPE_ENUM = "ENUM";

    /**
     * SET('value1','value2',...) [CHARACTER SET charset_name] [COLLATE collation_name]
     * 
     * A set. A string object that can have zero or more values, each of which must be chosen from 
     * the list of values 'value1', 'value2', ... SET values are represented internally as integers.
     * 
     * A SET column can have a maximum of 64 distinct members. A table can have no more than 255 unique 
     * element list definitions among its ENUM and SET columns considered as a group. For more 
     * information on this limit, see Section C.10.5, “Limits Imposed by .frm File Structure”. 
     * 
     * @since 18-04-26 
     * @edit 18-05-01
     */
    const DATATYPE_SET = "SET";

}
