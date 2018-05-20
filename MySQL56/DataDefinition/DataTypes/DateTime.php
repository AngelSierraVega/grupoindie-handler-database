<?php

namespace GIndie\DBHandler\MySQL56\DataDefinition\DataTypes;

/**
 * A summary of the temporal data types follows. For additional information about properties 
 * and storage requirements of the temporal types, see Section 11.3, “Date and Time Types”, 
 * and Section 11.7, “Data Type Storage Requirements”. For descriptions of functions that operate 
 * on temporal values, see Section 12.7, “Date and Time Functions”. 
 * 
 * @link <https://dev.mysql.com/doc/refman/5.6/en/date-and-time-type-overview.html>
 *
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * @copyright (c) 2018 Angel Sierra Vega. Grupo INDIE.
 *
 * @package GIndie\DBHandler\DataDefinition\MySQL56\
 *
 * @version 0B.00
 * 
 * @since 18-04-26
 * @edit 18-05-01
 * - Added prefix DATATYPE_
 */
interface DateTime
{

    /**
     * DATE
     * 
     * A date. The supported range is '1000-01-01' to '9999-12-31'. MySQL displays DATE values 
     * in 'YYYY-MM-DD' format, but permits assignment of values to DATE columns using either strings 
     * or numbers. 
     * 
     * @since 18-04-26 
     * @edit 18-05-01
     */
    const DATATYPE_DATE = "DATE";

    /**
     * DATETIME[(fsp)]
     * 
     * A date and time combination. The supported range is '1000-01-01 00:00:00.000000' 
     * to '9999-12-31 23:59:59.999999'. MySQL displays DATETIME values in 
     * 'YYYY-MM-DD HH:MM:SS[.fraction]' format, but permits assignment of values to DATETIME columns
     *  using either strings or numbers.
     * 
     * As of MySQL 5.6.4, an optional fsp value in the range from 0 to 6 may be given to specify 
     * fractional seconds precision. A value of 0 signifies that there is no fractional part. If omitted,
     *  the default precision is 0.
     * 
     * As of MySQL 5.6.5, automatic initialization and updating to the current date and time for 
     * DATETIME columns can be specified using DEFAULT and ON UPDATE column definition clauses, 
     * as described in Section 11.3.5, “Automatic Initialization and Updating for TIMESTAMP and DATETIME”.
     *  
     * @since 18-04-26 
     * @edit 18-05-01
     */
    const DATATYPE_DATETIME = "DATETIME";

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
     * @since 18-04-26 
     * @edit 18-05-01
     */
    const DATATYPE_TIMESTAMP = "TIMESTAMP";

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
     * @since 18-04-26 
     * @edit 18-05-01
     */
    const DATATYPE_TIME = "TIME";

    /**
     * YEAR[(2|4)]
     * 
     * A year in two-digit or four-digit format. The default is four-digit format. YEAR(2) or YEAR(4) 
     * differ in display format, but have the same range of values. In four-digit format, values display 
     * as 1901 to 2155, and 0000. In two-digit format, values display as 70 to 69, representing years 
     * from 1970 to 2069. MySQL displays YEAR values in YYYY or YY format, but permits assignment of 
     * values to YEAR columns using either strings or numbers. 
     * 
     * @since 18-04-26 
     * @edit 18-05-01
     */
    const DATATYPE_YEAR = "YEAR";

}
