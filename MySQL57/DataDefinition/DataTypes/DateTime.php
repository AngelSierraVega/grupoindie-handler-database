<?php

/**
 * GI-DBHandler-DVLP - DateTime
 *
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * @copyright (CC) 2020 Angel Sierra Vega. Grupo INDIE.
 * @license file://LICENSE
 *
 * @package GIndie\DBHandler\MySQL57\DataDefinition
 *
 * @version 00.B0
 * @since 18-11-02
 * @todo ? Move back methods from Column\Definition\DataTypes
 */

namespace GIndie\DBHandler\MySQL57\DataDefinition\DataTypes;

/**
 * 
 * @edit 18-11-02
 * - Copied code from GIndie\DBHandler\MySQL56\...
 */
interface DateTime
{

    /**
     * DATE A date. 
     * The supported range is '1000-01-01' to '9999-12-31'. MySQL displays DATE 
     * values in 'YYYY-MM-DD' format, but permits assignment of values to DATE 
     * columns using either strings or numbers.
     * 
     * @link <https://dev.mysql.com/doc/refman/5.7/en/date-and-time-type-overview.html>
     * 
     * @since 18-04-26 
     * @edit 18-05-01
     */
    const DATATYPE_DATE = "DATE";

    /**
     * DATETIME[(fsp)] A date and time combination. 
     * The supported range is '1000-01-01 00:00:00.000000' to 
     * '9999-12-31 23:59:59.999999'. MySQL displays DATETIME values in 
     * 'YYYY-MM-DD HH:MM:SS[.fraction]' format, but permits assignment of values 
     * to DATETIME columns using either strings or numbers.
     * 
     * An optional fsp value in the range from 0 to 6 may be given to specify 
     * fractional seconds precision. A value of 0 signifies that there is no 
     * fractional part. If omitted, the default precision is 0.
     * 
     * Automatic initialization and updating to the current date and time for 
     * DATETIME columns can be specified using DEFAULT and ON UPDATE column 
     * definition clauses, as described in Section 11.3.5, “Automatic 
     * Initialization and Updating for TIMESTAMP and DATETIME”.
     * 
     * @link <https://dev.mysql.com/doc/refman/5.7/en/date-and-time-type-overview.html>
     * 
     * @since 18-04-26 
     * @edit 18-05-01
     */
    const DATATYPE_DATETIME = "DATETIME";

    /**
     * TIMESTAMP[(fsp)] A timestamp. 
     * 
     * The range is '1970-01-01 00:00:01.000000' UTC to '2038-01-19 03:14:07.999999' 
     * UTC. TIMESTAMP values are stored as the number of seconds since the epoch 
     * ('1970-01-01 00:00:00' UTC). A TIMESTAMP cannot represent the value 
     * '1970-01-01 00:00:00' because that is equivalent to 0 seconds from the 
     * epoch and the value 0 is reserved for representing '0000-00-00 00:00:00', 
     * the “zero” TIMESTAMP value.
     * 
     * An optional fsp value in the range from 0 to 6 may be given to specify 
     * fractional seconds precision. A value of 0 signifies that there is no 
     * fractional part. If omitted, the default precision is 0.
     * 
     * The way the server handles TIMESTAMP definitions depends on the value of 
     * the explicit_defaults_for_timestamp system variable (see Section 5.1.7, 
     * “Server System Variables”).
     * 
     * If explicit_defaults_for_timestamp is enabled, there is no automatic 
     * assignment of the DEFAULT CURRENT_TIMESTAMP or ON UPDATE CURRENT_TIMESTAMP 
     * attributes to any TIMESTAMP column. They must be included explicitly in 
     * the column definition. Also, any TIMESTAMP not explicitly declared as NOT 
     * NULL permits NULL values.
     * 
     * If explicit_defaults_for_timestamp is disabled, the server handles 
     * TIMESTAMP as follows:
     * 
     * Unless specified otherwise, the first TIMESTAMP column in a table is 
     * defined to be automatically set to the date and time of the most recent 
     * modification if not explicitly assigned a value. This makes TIMESTAMP 
     * useful for recording the timestamp of an INSERT or UPDATE operation. 
     * You can also set any TIMESTAMP column to the current date and time by 
     * assigning it a NULL value, unless it has been defined with the NULL 
     * attribute to permit NULL values.
     * 
     * Automatic initialization and updating to the current date and time can be 
     * specified using DEFAULT CURRENT_TIMESTAMP and ON UPDATE CURRENT_TIMESTAMP 
     * column definition clauses. By default, the first TIMESTAMP column has 
     * these properties, as previously noted. However, any TIMESTAMP column in a 
     * table can be defined to have these properties.
     * 
     * @link <https://dev.mysql.com/doc/refman/5.7/en/date-and-time-type-overview.html>
     * 
     * @since 18-04-26 
     * @edit 18-05-01
     */
    const DATATYPE_TIMESTAMP = "TIMESTAMP";

    /**
     * TIME[(fsp)] A time. 
     * 
     * The range is '-838:59:59.000000' to '838:59:59.000000'. MySQL displays 
     * TIME values in 'HH:MM:SS[.fraction]' format, but permits assignment of 
     * values to TIME columns using either strings or numbers.
     * 
     * An optional fsp value in the range from 0 to 6 may be given to specify 
     * fractional seconds precision. A value of 0 signifies that there is no 
     * fractional part. If omitted, the default precision is 0.
     * 
     * @link <https://dev.mysql.com/doc/refman/5.7/en/date-and-time-type-overview.html>
     * 
     * @since 18-04-26 
     * @edit 18-05-01
     */
    const DATATYPE_TIME = "TIME";

    /**
     * YEAR[(4)] A year in four-digit format. 
     * 
     * MySQL displays YEAR values in YYYY format, but permits assignment of 
     * values to YEAR columns using either strings or numbers. Values display as
     * 1901 to 2155, and 0000.
     * 
     * Note: The YEAR(2) data type is deprecated and support for it is removed 
     * in MySQL 5.7.5. To convert YEAR(2) columns to YEAR(4), see 
     * Section 11.3.4, “YEAR(2) Limitations and Migrating to YEAR(4)”.
     * 
     * For additional information about YEAR display format and interpretation 
     * of input values, see Section 11.3.3, “The YEAR Type”.
     * 
     * @link <https://dev.mysql.com/doc/refman/5.7/en/date-and-time-type-overview.html>
     * 
     * @since 18-04-26 
     * @edit 18-05-01
     */
    const DATATYPE_YEAR = "YEAR";

}
