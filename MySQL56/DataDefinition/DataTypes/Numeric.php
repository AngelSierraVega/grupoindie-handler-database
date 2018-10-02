<?php

namespace GIndie\DBHandler\MySQL56\DataDefinition\DataTypes;

/**
 * GI-DBHandler-DVLP - Numeric
 * 
 * If you specify ZEROFILL for a numeric column, MySQL automatically adds the UNSIGNED 
 * attribute to the column.
 * 
 * Numeric data types that permit the UNSIGNED attribute also permit SIGNED. However, these 
 * data types are signed by default, so the SIGNED attribute has no effect.
 * 
 * Warning
 * When you use subtraction between integer values where one is of type UNSIGNED, the result 
 * is unsigned unless the NO_UNSIGNED_SUBTRACTION SQL mode is enabled. [See Section 12.10, 
 * “Cast Functions and Operators”.]
 *  
 * @link <https://dev.mysql.com/doc/refman/5.6/en/numeric-type-overview.html>
 *
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * @copyright (c) 2018 Angel Sierra Vega. Grupo INDIE.
 *
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
interface Numeric
{

    /**
     * BIT[(M)]
     * 
     * A bit-value type. M indicates the number of bits per value, from 1 to 64. 
     * The default is 1 if M is omitted.
     * 
     * @since 18-04-26 
     * @edit 18-05-01
     */
    const DATATYPE_BIT = "BIT";

    /**
     * TINYINT[(M)] [UNSIGNED] [ZEROFILL]
     * 
     * A very small integer. The signed range is -128 to 127. The unsigned range is 0 to 255.
     * 
     * @since 18-04-26 
     * @edit 18-05-01
     */
    const DATATYPE_TINYINT = "TINYINT";

    /**
     * BOOL, BOOLEAN
     * 
     * These types are synonyms for TINYINT(1). A value of zero is considered false. 
     * Nonzero values are considered true.
     * 
     * @since 18-04-26 
     * @edit 18-05-01
     */
    const DATATYPE_BOOL = "BOOL";

    /**
     * BOOL, BOOLEAN
     * 
     * These types are synonyms for TINYINT(1). A value of zero is considered false. 
     * Nonzero values are considered true.
     * 
     * @since 18-04-26 
     * @edit 18-05-01
     */
    const DATATYPE_BOOLEAN = "BOOLEAN";

    /**
     * SMALLINT[(M)] [UNSIGNED] [ZEROFILL]
     * 
     * A small integer. The signed range is -32768 to 32767. The unsigned range is 0 to 65535.
     * 
     * @since 18-04-26 
     * @edit 18-05-01
     */
    const DATATYPE_SMALLINT = "SMALLINT";

    /**
     * MEDIUMINT[(M)] [UNSIGNED] [ZEROFILL]
     * 
     * A medium-sized integer. The signed range is -8388608 to 8388607. 
     * The unsigned range is 0 to 16777215.
     * 
     * @since 18-04-26 
     * @edit 18-05-01
     */
    const DATATYPE_MEDIUMINT = "MEDIUMINT";

    /**
     * INT[(M)] [UNSIGNED] [ZEROFILL]
     * 
     * A normal-size integer. The signed range is -2147483648 to 2147483647. 
     * The unsigned range is 0 to 4294967295.
     * 
     * SERIAL is an alias for BIGINT UNSIGNED NOT NULL AUTO_INCREMENT UNIQUE.
     * SERIAL DEFAULT VALUE in the definition of an integer column is an alias for 
     * NOT NULL AUTO_INCREMENT UNIQUE.
     * 
     * @since 18-04-26 
     * @edit 18-05-01
     */
    const DATATYPE_INT = "INT";

    /**
     * INTEGER[(M)] [UNSIGNED] [ZEROFILL]
     * 
     * This type is a synonym for INT.
     * 
     * @since 18-04-26 
     * @edit 18-05-01
     */
    const DATATYPE_INTEGER = "INTEGER";

    /**
     * BIGINT[(M)] [UNSIGNED] [ZEROFILL]
     * 
     * A large integer. The signed range is -9223372036854775808 to 9223372036854775807. 
     * The unsigned range is 0 to 18446744073709551615.
     * 
     * @since 18-04-26 
     * @edit 18-05-01
     */
    const DATATYPE_BIGINT = "BIGINT";

    /**
     * SERIAL is an alias for BIGINT UNSIGNED NOT NULL AUTO_INCREMENT UNIQUE.
     * 
     * Some things you should be aware of with respect to BIGINT columns:
     * All arithmetic is done using signed BIGINT or DOUBLE values, so you should not use 
     * unsigned big integers larger than 9223372036854775807 (63 bits) except with bit functions! 
     * If you do that, some of the last digits in the result may be wrong because of rounding 
     * errors when converting a BIGINT value to a DOUBLE.
     * 
     * MySQL can handle BIGINT in the following cases:
     *  - When using integers to store large unsigned values in a BIGINT column.
     *  - In MIN(col_name) or MAX(col_name), where col_name refers to a BIGINT column.
     *  - When using operators (+, -, *, and so on) where both operands are integers.
     * 
     * You can always store an exact integer value in a BIGINT column by storing it using a string. 
     * In this case, MySQL performs a string-to-number conversion that involves no intermediate 
     * double-precision representation.
     * 
     * The -, +, and * operators use BIGINT arithmetic when both operands are integer values. This means that if you multiply two big integers (or results from functions that return integers), you may get unexpected results when the result is larger than 9223372036854775807.

     * @since 18-04-26 
     * @edit 18-05-01
     */
    const DATATYPE_SERIAL = "SERIAL";

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
     * @since 18-04-26 
     * @edit 18-05-01
     */
    const DATATYPE_DECIMAL = "DECIMAL";

    /**
     * DEC[(M[,D])] [UNSIGNED] [ZEROFILL], 
     * NUMERIC[(M[,D])] [UNSIGNED] [ZEROFILL], 
     * FIXED[(M[,D])] [UNSIGNED] [ZEROFILL]
     * 
     * These types are synonyms for DECIMAL. The FIXED synonym is available for compatibility 
     * with other database systems.
     * 
     * @since 18-04-26 
     * @edit 18-05-01
     */
    const DATATYPE_DEC = "DEC";

    /**
     * DEC[(M[,D])] [UNSIGNED] [ZEROFILL], 
     * NUMERIC[(M[,D])] [UNSIGNED] [ZEROFILL], 
     * FIXED[(M[,D])] [UNSIGNED] [ZEROFILL]
     * 
     * These types are synonyms for DECIMAL. The FIXED synonym is available for compatibility 
     * with other database systems.
     * 
     * @since 18-04-26 
     * @edit 18-05-01
     */
    const DATATYPE_NUMERIC = "NUMERIC";

    /**
     * DEC[(M[,D])] [UNSIGNED] [ZEROFILL], 
     * NUMERIC[(M[,D])] [UNSIGNED] [ZEROFILL], 
     * FIXED[(M[,D])] [UNSIGNED] [ZEROFILL]
     * 
     * These types are synonyms for DECIMAL. The FIXED synonym is available for compatibility 
     * with other database systems.
     * 
     * @since 18-04-26 
     * @edit 18-05-01
     */
    const DATATYPE_FIXED = "FIXED";

    /**
     * FLOAT[(M,D)] [UNSIGNED] [ZEROFILL]
     * 
     * A small (single-precision) floating-point number. Permissible values are
     * -3.402823466E+38 to -1.175494351E-38, 0, and 1.175494351E-38 to 3.402823466E+38. These 
     * are the theoretical limits, based on the IEEE standard. The actual range might be slightly 
     * smaller depending on your hardware or operating system.
     * 
     * M is the total number of digits and D is the number of digits following the decimal point.
     * If M and D are omitted, values are stored to the limits permitted by the hardware. A 
     * single-precision floating-point number is accurate to approximately 7 decimal places.
     * 
     * UNSIGNED, if specified, disallows negative values.
     * 
     * Using FLOAT might give you some unexpected problems because all calculations in MySQL are done 
     * with double precision. See Section B.5.4.7, “Solving Problems with No Matching Rows”.
     * 
     * FLOAT(p) [UNSIGNED] [ZEROFILL]
     * 
     * A floating-point number. p represents the precision in bits, but MySQL uses this value only 
     * to determine whether to use FLOAT or DOUBLE for the resulting data type. If p is from 0 to 24, 
     * the data type becomes FLOAT with no M or D values. If p is from 25 to 53, the data type becomes 
     * DOUBLE with no M or D values. The range of the resulting column is the same as for the 
     * single-precision FLOAT or double-precision DOUBLE data types described earlier in this section.
     * 
     * FLOAT(p) syntax is provided for ODBC compatibility.
     * 
     * @since 18-04-26 
     * @edit 18-05-01
     */
    const DATATYPE_FLOAT = "FLOAT";

    /**
     * DOUBLE[(M,D)] [UNSIGNED] [ZEROFILL]
     * 
     * A normal-size (double-precision) floating-point number. Permissible values are 
     * -1.7976931348623157E+308 to -2.2250738585072014E-308, 0, and 2.2250738585072014E-308 to
     * 1.7976931348623157E+308. These are the theoretical limits, based on the IEEE standard. 
     * The actual range might be slightly smaller depending on your hardware or operating system.
     * 
     * M is the total number of digits and D is the number of digits following the decimal point. 
     * If M and D are omitted, values are stored to the limits permitted by the hardware. A 
     * double-precision floating-point number is accurate to approximately 15 decimal places.
     * 
     * UNSIGNED, if specified, disallows negative values.
     * 
     * @since 18-04-26 
     * @edit 18-05-01
     */
    const DATATYPE_DOUBLE = "DOUBLE";

    /**
     * DOUBLE PRECISION[(M,D)] [UNSIGNED] [ZEROFILL], 
     * REAL[(M,D)] [UNSIGNED] [ZEROFILL]
     * 
     * These types are synonyms for DOUBLE. Exception: If the REAL_AS_FLOAT SQL mode is enabled, 
     * REAL is a synonym for FLOAT rather than DOUBLE.
     * 
     * @since 18-04-26 
     * @edit 18-05-01
     */
    const DATATYPE_DOUBLE_PRECISION = "DOUBLE_PRECISION";

    /**
     * DOUBLE PRECISION[(M,D)] [UNSIGNED] [ZEROFILL], 
     * REAL[(M,D)] [UNSIGNED] [ZEROFILL]
     * 
     * These types are synonyms for DOUBLE. Exception: If the REAL_AS_FLOAT SQL mode is enabled, 
     * REAL is a synonym for FLOAT rather than DOUBLE.
     * 
     * @since 18-04-26 
     * @edit 18-05-01
     */
    const DATATYPE_REAL = "REAL";

}
