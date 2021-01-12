<?php

/**
 * GI-DBHandler-DVLP - SqlModes
 *
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * @copyright (CC) 2020 Angel Sierra Vega. Grupo INDIE.
 * @license file://LICENSE
 *
 * @package GIndie\DBHandler\MySQL57\DataDefinition
 *
 * @version 00.FA
 * @since 18-11-10
 */

namespace GIndie\DBHandler\MySQL57\DataDefinition\ServerAdministration;

/**
 * The MySQL server can operate in different SQL modes, and can apply these 
 * modes differently for different clients, depending on the value of the 
 * sql_mode system variable. DBAs can set the global SQL mode to match site 
 * server operating requirements, and each application can set its session SQL 
 * mode to its own requirements.
 * 
 * Modes affect the SQL syntax MySQL supports and the data validation checks it 
 * performs. This makes it easier to use MySQL in different environments and to 
 * use MySQL together with other database servers. 
 * 
 * To set the SQL mode at server startup, use the --sql-mode="modes" option on 
 * the command line, or sql-mode="modes" in an option file such as my.cnf (Unix 
 * operating systems) or my.ini (Windows). modes is a list of different modes 
 * separated by commas. To clear the SQL mode explicitly, set it to an empty 
 * string using --sql-mode="" on the command line, or sql-mode="" in an option 
 * file. 
 * 
 * @link <https://dev.mysql.com/doc/refman/5.7/en/sql-mode.html>
 * 
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 */
class SqlModes
{

    /**
     * Do not perform full checking of dates. Check only that the month is in 
     * the range from 1 to 12 and the day is in the range from 1 to 31. This may 
     * be useful for Web applications that obtain year, month, and day in three 
     * different fields and store exactly what the user inserted, without date 
     * validation. This mode applies to DATE and DATETIME columns. It does not 
     * apply TIMESTAMP columns, which always require a valid date.
     * 
     * With ALLOW_INVALID_DATES enabled, the server requires that month and day 
     * values be legal, and not merely in the range 1 to 12 and 1 to 31, 
     * respectively. With strict mode disabled, invalid dates such as 
     * '2004-04-31' are converted to '0000-00-00' and a warning is generated. 
     * With strict mode enabled, invalid dates generate an error. To permit such 
     * dates, enable ALLOW_INVALID_DATES.
     */
    const ALLOW_INVALID_DATES = "ALLOW_INVALID_DATES";

    /**
     * Treat " as an identifier quote character (like the ` quote character) and 
     * not as a string quote character. You can still use ` to quote identifiers 
     * with this mode enabled. With ANSI_QUOTES enabled, you cannot use double 
     * quotation marks to quote literal strings because they are interpreted as 
     * identifiers.
     * 
     * @since 18-11-10
     */
    const ANSI_QUOTES = "ANSI_QUOTES";

    /**
     * The ERROR_FOR_DIVISION_BY_ZERO mode affects handling of division by zero, 
     * which includes MOD(N,0). For data-change operations (INSERT, UPDATE), its 
     * effect also depends on whether strict SQL mode is enabled.
     * 
     * If this mode is not enabled, division by zero inserts NULL and produces 
     * no warning.
     * 
     * If this mode is enabled, division by zero inserts NULL and produces a 
     * warning.
     * 
     * If this mode and strict mode are enabled, division by zero produces an 
     * error, unless IGNORE is given as well. For INSERT IGNORE and 
     * UPDATE IGNORE, division by zero inserts NULL and produces a warning.
     * 
     * For SELECT, division by zero returns NULL. Enabling 
     * ERROR_FOR_DIVISION_BY_ZERO causes a warning to be produced as well, 
     * regardless of whether strict mode is enabled.
     * 
     * ERROR_FOR_DIVISION_BY_ZERO is deprecated. ERROR_FOR_DIVISION_BY_ZERO is 
     * not part of strict mode, but should be used in conjunction with strict 
     * mode and is enabled by default. A warning occurs if ERROR_FOR_DIVISION_BY_ZERO 
     * is enabled without also enabling strict mode or vice versa. For 
     * additional discussion, see SQL Mode Changes in MySQL 5.7.
     * 
     * Because ERROR_FOR_DIVISION_BY_ZERO is deprecated, it will be removed in a 
     * future MySQL release as a separate mode name and its effect included in 
     * the effects of strict SQL mode.
     * 
     * @since 18-11-10
     */
    const ERROR_FOR_DIVISION_BY_ZERO = "ERROR_FOR_DIVISION_BY_ZERO";

    /**
     * The precedence of the NOT operator is such that expressions such as NOT a 
     * BETWEEN b AND c are parsed as NOT (a BETWEEN b AND c). In some older 
     * versions of MySQL, the expression was parsed as (NOT a) BETWEEN b AND c. 
     * The old higher-precedence behavior can be obtained by enabling the 
     * HIGH_NOT_PRECEDENCE SQL mode.
     * 
     * mysql> SET sql_mode = '';
     * mysql> SELECT NOT 1 BETWEEN -5 AND 5;
     *  -> 0
     * mysql> SET sql_mode = 'HIGH_NOT_PRECEDENCE';
     * mysql> SELECT NOT 1 BETWEEN -5 AND 5;
     *  -> 1
     * 
     * @since 18-11-10
     */
    const HIGH_NOT_PRECEDENCE = "HIGH_NOT_PRECEDENCE";

    /**
     * Permit spaces between a function name and the ( character. This causes 
     * built-in function names to be treated as reserved words. As a result, 
     * identifiers that are the same as function names must be quoted as 
     * described in Section 9.2, “Schema Object Names”. For example, because 
     * there is a COUNT() function, the use of count as a table name in the 
     * following statement causes an error:
     * 
     * mysql> CREATE TABLE count (i INT);
     * ERROR 1064 (42000): You have an error in your SQL syntax
     * 
     * The table name should be quoted:
     * 
     * mysql> CREATE TABLE `count` (i INT);
     * Query OK, 0 rows affected (0.00 sec)
     * 
     * The IGNORE_SPACE SQL mode applies to built-in functions, not to 
     * user-defined functions or stored functions. It is always permissible to 
     * have spaces after a UDF or stored function name, regardless of whether 
     * IGNORE_SPACE is enabled.
     * 
     * For further discussion of IGNORE_SPACE, see Section 9.2.4, “Function Name 
     * Parsing and Resolution”.
     * 
     * @since 18-11-10
     */
    const IGNORE_SPACE = "IGNORE_SPACE";

    /**
     * 
     * Prevent the GRANT statement from automatically creating new user accounts 
     * if it would otherwise do so, unless authentication information is 
     * specified. The statement must specify a nonempty password using 
     * IDENTIFIED BY or an authentication plugin using IDENTIFIED WITH.
     * 
     * It is preferable to create MySQL accounts with CREATE USER rather than 
     * GRANT. NO_AUTO_CREATE_USER is deprecated and the default SQL mode 
     * includes NO_AUTO_CREATE_USER. Assignments to sql_mode that change the 
     * NO_AUTO_CREATE_USER mode state produce a warning, except assignments that 
     * set sql_mode to DEFAULT. NO_AUTO_CREATE_USER will be removed in a future 
     * MySQL release, at which point its effect will be enabled at all times 
     * (GRANT will not create accounts).
     * 
     * Previously, before NO_AUTO_CREATE_USER was deprecated, one reason not to 
     * enable it was that it was not replication safe. Now it can be enabled and 
     * replication-safe user management performed with CREATE USER IF NOT EXISTS, 
     * DROP USER IF EXISTS, and ALTER USER IF EXISTS rather than GRANT. These 
     * statements enable safe replication when slaves may have different grants 
     * than those on the master. See Section 13.7.1.2, “CREATE USER Syntax”, 
     * Section 13.7.1.3, “DROP USER Syntax”, and Section 13.7.1.1, 
     * “ALTER USER Syntax”.
     * 
     * @since 18-11-10
     */
    const NO_AUTO_CREATE_USER = "NO_AUTO_CREATE_USER";

    /**
     * NO_AUTO_VALUE_ON_ZERO affects handling of AUTO_INCREMENT columns. 
     * Normally, you generate the next sequence number for the column by
     * inserting either NULL or 0 into it. NO_AUTO_VALUE_ON_ZERO suppresses 
     * this behavior for 0 so that only NULL generates the next sequence number.
     * 
     * This mode can be useful if 0 has been stored in a table's AUTO_INCREMENT 
     * column. (Storing 0 is not a recommended practice, by the way.) For 
     * example, if you dump the table with mysqldump and then reload it, MySQL 
     * normally generates new sequence numbers when it encounters the 0 values, 
     * resulting in a table with contents different from the one that was dumped. 
     * Enabling NO_AUTO_VALUE_ON_ZERO before reloading the dump file solves this 
     * problem. For this reason, mysqldump automatically includes in its output 
     * a statement that enables NO_AUTO_VALUE_ON_ZERO.
     * 
     * @since 18-11-10
     */
    const NO_AUTO_VALUE_ON_ZERO = "NO_AUTO_VALUE_ON_ZERO";

    /**
     * Disable the use of the backslash character (\) as an escape character 
     * within strings. With this mode enabled, backslash becomes an ordinary 
     * character like any other.
     * 
     * @since 18-11-10
     */
    const NO_BACKSLASH_ESCAPES = "NO_BACKSLASH_ESCAPES";

    /**
     * When creating a table, ignore all INDEX DIRECTORY and DATA DIRECTORY 
     * directives. This option is useful on slave replication servers.
     * 
     * @since 18-11-10
     */
    const NO_DIR_IN_CREATE = "NO_DIR_IN_CREATE";

    /**
     * Control automatic substitution of the default storage engine when a 
     * statement such as CREATE TABLE or ALTER TABLE specifies a storage engine 
     * that is disabled or not compiled in.
     * 
     * By default, NO_ENGINE_SUBSTITUTION is enabled.
     * 
     * Because storage engines can be pluggable at runtime, unavailable engines 
     * are treated the same way:
     * 
     * With NO_ENGINE_SUBSTITUTION disabled, for CREATE TABLE the default engine 
     * is used and a warning occurs if the desired engine is unavailable. For 
     * ALTER TABLE, a warning occurs and the table is not altered.
     * 
     * With NO_ENGINE_SUBSTITUTION enabled, an error occurs and the table is not 
     * created or altered if the desired engine is unavailable.
     * 
     * @since 18-11-10
     */
    const NO_ENGINE_SUBSTITUTION = "NO_ENGINE_SUBSTITUTION";

    /**
     * Do not print MySQL-specific column options in the output of 
     * SHOW CREATE TABLE. This mode is used by mysqldump in portability mode.
     * 
     * Note: As of MySQL 5.7.22, NO_FIELD_OPTIONS is deprecated. It will be 
     * removed in a future version of MySQL.
     * 
     * @since 18-11-10
     */
    const NO_FIELD_OPTIONS = "NO_FIELD_OPTIONS";

    /**
     * Do not print MySQL-specific index options in the output of 
     * SHOW CREATE TABLE. This mode is used by mysqldump in portability mode.
     * 
     * Note: As of MySQL 5.7.22, NO_KEY_OPTIONS is deprecated. It will be removed 
     * in a future version of MySQL.
     * 
     * @since 18-11-10
     */
    const NO_KEY_OPTIONS = "NO_KEY_OPTIONS";

    /**
     * Do not print MySQL-specific table options (such as ENGINE) in the output 
     * of SHOW CREATE TABLE. This mode is used by mysqldump in portability mode.
     * 
     * Note: As of MySQL 5.7.22, NO_TABLE_OPTIONS is deprecated. It will be 
     * removed in a future version of MySQL.
     * 
     * @since 18-11-10
     */
    const NO_TABLE_OPTIONS = "NO_TABLE_OPTIONS";

    /**
     * 
     * Subtraction between integer values, where one is of type UNSIGNED, 
     * produces an unsigned result by default. If the result would otherwise 
     * have been negative, an error results:
     * 
     * mysql> SET sql_mode = '';
     * Query OK, 0 rows affected (0.00 sec)
     * 
     * mysql> SELECT CAST(0 AS UNSIGNED) - 1;
     * ERROR 1690 (22003): BIGINT UNSIGNED value is out of range in '(cast(0 as 
     * unsigned) - 1)'
     * 
     * If the NO_UNSIGNED_SUBTRACTION SQL mode is enabled, the result is 
     * negative:
     * 
     * mysql> SET sql_mode = 'NO_UNSIGNED_SUBTRACTION';
     * mysql> SELECT CAST(0 AS UNSIGNED) - 1;
     * +-------------------------+
     * | CAST(0 AS UNSIGNED) - 1 |
     * +-------------------------+
     * |                      -1 |
     * +-------------------------+
     * 
     * If the result of such an operation is used to update an UNSIGNED integer 
     * column, the result is clipped to the maximum value for the column type, 
     * or clipped to 0 if NO_UNSIGNED_SUBTRACTION is enabled. With strict SQL 
     * mode enabled, an error occurs and the column remains unchanged.
     * 
     * When NO_UNSIGNED_SUBTRACTION is enabled, the subtraction result is signed, 
     * even if any operand is unsigned. For example, compare the type of column 
     * c2 in table t1 with that of column c2 in table t2:
     * 
     * mysql> SET sql_mode='';
     * mysql> CREATE TABLE test (c1 BIGINT UNSIGNED NOT NULL);
     * mysql> CREATE TABLE t1 SELECT c1 - 1 AS c2 FROM test;
     * mysql> DESCRIBE t1;
     * +-------+---------------------+------+-----+---------+-------+
     * | Field | Type                | Null | Key | Default | Extra |
     * +-------+---------------------+------+-----+---------+-------+
     * | c2    | bigint(21) unsigned | NO   |     | 0       |       |
     * +-------+---------------------+------+-----+---------+-------+
     * 
     * mysql> SET sql_mode='NO_UNSIGNED_SUBTRACTION';
     * mysql> CREATE TABLE t2 SELECT c1 - 1 AS c2 FROM test;
     * mysql> DESCRIBE t2;
     * +-------+------------+------+-----+---------+-------+
     * | Field | Type       | Null | Key | Default | Extra |
     * +-------+------------+------+-----+---------+-------+
     * | c2    | bigint(21) | NO   |     | 0       |       |
     * +-------+------------+------+-----+---------+-------+
     * 
     * This means that BIGINT UNSIGNED is not 100% usable in all contexts. See 
     * Section 12.10, “Cast Functions and Operators”.
     * 
     * @since 18-11-10
     */
    const NO_UNSIGNED_SUBTRACTION = "NO_UNSIGNED_SUBTRACTION";

    /**
     * The NO_ZERO_DATE mode affects whether the server permits '0000-00-00' as 
     * a valid date. Its effect also depends on whether strict SQL mode is 
     * enabled.
     * 
     * If this mode is not enabled, '0000-00-00' is permitted and inserts 
     * produce no warning.
     * 
     * If this mode is enabled, '0000-00-00' is permitted and inserts produce a 
     * warning.
     * 
     * If this mode and strict mode are enabled, '0000-00-00' is not permitted 
     * and inserts produce an error, unless IGNORE is given as well. For 
     * INSERT IGNORE and UPDATE IGNORE, '0000-00-00' is permitted and inserts 
     * produce a warning.
     * 
     * NO_ZERO_DATE is deprecated. NO_ZERO_DATE is not part of strict mode, but 
     * should be used in conjunction with strict mode and is enabled by default. 
     * A warning occurs if NO_ZERO_DATE is enabled without also enabling strict 
     * mode or vice versa. For additional discussion, see SQL Mode Changes in 
     * MySQL 5.7.
     * 
     * Because NO_ZERO_DATE is deprecated, it will be removed in a future MySQL 
     * release as a separate mode name and its effect included in the effects of 
     * strict SQL mode.
     * 
     * @since 18-11-10
     */
    const NO_ZERO_DATE = "NO_ZERO_DATE";

    /**
     * The NO_ZERO_IN_DATE mode affects whether the server permits dates in 
     * which the year part is nonzero but the month or day part is 0. (This mode 
     * affects dates such as '2010-00-01' or '2010-01-00', but not '0000-00-00'.
     * To control whether the server permits '0000-00-00', use the NO_ZERO_DATE 
     * mode.) The effect of NO_ZERO_IN_DATE also depends on whether strict SQL 
     * mode is enabled.
     * 
     * If this mode is not enabled, dates with zero parts are permitted and 
     * inserts produce no warning.
     * 
     * If this mode is enabled, dates with zero parts are inserted as 
     * '0000-00-00' and produce a warning.
     * 
     * If this mode and strict mode are enabled, dates with zero parts are not 
     * permitted and inserts produce an error, unless IGNORE is given as well. 
     * For INSERT IGNORE and UPDATE IGNORE, dates with zero parts are inserted 
     * as '0000-00-00' and produce a warning.
     * 
     * NO_ZERO_IN_DATE is deprecated. NO_ZERO_IN_DATE is not part of strict mode, 
     * but should be used in conjunction with strict mode and is enabled by 
     * default. A warning occurs if NO_ZERO_IN_DATE is enabled without also 
     * enabling strict mode or vice versa. For additional discussion, see SQL 
     * Mode Changes in MySQL 5.7.
     * 
     * Because NO_ZERO_IN_DATE is deprecated, it will be removed in a future 
     * MySQL release as a separate mode name and its effect included in the 
     * effects of strict SQL mode.
     * 
     * @since 18-11-10
     */
    const NO_ZERO_IN_DATE = "NO_ZERO_IN_DATE";

    /**
     * Reject queries for which the select list, HAVING condition, or ORDER BY 
     * list refer to nonaggregated columns that are neither named in the 
     * GROUP BY clause nor are functionally dependent on (uniquely determined by) 
     * GROUP BY columns.
     * 
     * As of MySQL 5.7.5, the default SQL mode includes ONLY_FULL_GROUP_BY. 
     * (Before 5.7.5, MySQL does not detect functional dependency and 
     * ONLY_FULL_GROUP_BY is not enabled by default. For a description of 
     * pre-5.7.5 behavior, see the MySQL 5.6 Reference Manual.)
     * 
     * A MySQL extension to standard SQL permits references in the HAVING clause 
     * to aliased expressions in the select list. Before MySQL 5.7.5, enabling 
     * ONLY_FULL_GROUP_BY disables this extension, thus requiring the HAVING 
     * clause to be written using unaliased expressions. As of MySQL 5.7.5, this 
     * restriction is lifted so that the HAVING clause can refer to aliases 
     * regardless of whether ONLY_FULL_GROUP_BY is enabled.
     * 
     * For additional discussion and examples, see Section 12.19.3, “MySQL 
     * Handling of GROUP BY”.
     * 
     * @since 18-11-10
     */
    const ONLY_FULL_GROUP_BY = "ONLY_FULL_GROUP_BY";

    /**
     * By default, trailing spaces are trimmed from CHAR column values on 
     * retrieval. If PAD_CHAR_TO_FULL_LENGTH is enabled, trimming does not occur 
     * and retrieved CHAR values are padded to their full length. This mode does 
     * not apply to VARCHAR columns, for which trailing spaces are retained on 
     * retrieval.
     * 
     * mysql> CREATE TABLE t1 (c1 CHAR(10));
     * Query OK, 0 rows affected (0.37 sec)
     * 
     * mysql> INSERT INTO t1 (c1) VALUES('xy');
     * Query OK, 1 row affected (0.01 sec)
     * 
     * mysql> SET sql_mode = '';
     * Query OK, 0 rows affected (0.00 sec)
     * 
     * mysql> SELECT c1, CHAR_LENGTH(c1) FROM t1;
     * +------+-----------------+
     * | c1   | CHAR_LENGTH(c1) |
     * +------+-----------------+
     * | xy   |               2 |
     * +------+-----------------+
     * 1 row in set (0.00 sec)
     * 
     * mysql> SET sql_mode = 'PAD_CHAR_TO_FULL_LENGTH';
     * Query OK, 0 rows affected (0.00 sec)
     * 
     * mysql> SELECT c1, CHAR_LENGTH(c1) FROM t1;
     * +------------+-----------------+
     * | c1         | CHAR_LENGTH(c1) |
     * +------------+-----------------+
     * | xy         |              10 |
     * +------------+-----------------+
     * 1 row in set (0.00 sec)
     */
    const PAD_CHAR_TO_FULL_LENGTH = "PAD_CHAR_TO_FULL_LENGTH";

    /**
     * Treat || as a string concatenation operator (same as CONCAT()) rather 
     * than as a synonym for OR.
     * 
     * @since 18-11-10
     */
    const PIPES_AS_CONCAT = "PIPES_AS_CONCAT";

    /**
     * Treat REAL as a synonym for FLOAT. By default, MySQL treats REAL as a 
     * synonym for DOUBLE.
     * 
     * @since 18-11-10
     */
    const REAL_AS_FLOAT = "REAL_AS_FLOAT";

    /**
     * Enable strict SQL mode for all storage engines. Invalid data values are 
     * rejected. For details, see Strict SQL Mode.
     * 
     * From MySQL 5.7.4 through 5.7.7, STRICT_ALL_TABLES includes the effect of 
     * the ERROR_FOR_DIVISION_BY_ZERO, NO_ZERO_DATE, and NO_ZERO_IN_DATE modes. 
     * For additional discussion, see SQL Mode Changes in MySQL 5.7.
     * 
     * @since 18-11-10
     */
    const STRICT_ALL_TABLES = "STRICT_ALL_TABLES";

    /**
     * Enable strict SQL mode for transactional storage engines, and when 
     * possible for nontransactional storage engines. For details, see Strict 
     * SQL Mode.
     * 
     * From MySQL 5.7.4 through 5.7.7, STRICT_TRANS_TABLES includes the effect 
     * of the ERROR_FOR_DIVISION_BY_ZERO, NO_ZERO_DATE, and NO_ZERO_IN_DATE 
     * modes. For additional discussion, see SQL Mode Changes in MySQL 5.7.
     * 
     * @since 18-11-10
     */
    const STRICT_TRANS_TABLES = "STRICT_TRANS_TABLES";

}
