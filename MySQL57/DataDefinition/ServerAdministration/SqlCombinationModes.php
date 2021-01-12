<?php

/**
 * GI-DBHandler-DVLP - SqlCombinationModes
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
 * The following special modes are provided as shorthand for combinations of 
 * mode values.
 *
 * @link <https://dev.mysql.com/doc/refman/5.7/en/sql-mode.html>
 */
class SqlCombinationModes
{

    /**
     * Equivalent to REAL_AS_FLOAT, PIPES_AS_CONCAT, ANSI_QUOTES, IGNORE_SPACE, 
     * and (as of MySQL 5.7.5) ONLY_FULL_GROUP_BY.
     * 
     * ANSI mode also causes the server to return an error for queries where a 
     * set function S with an outer reference S(outer_ref) cannot be aggregated 
     * in the outer query against which the outer reference has been resolved. 
     * This is such a query:
     * 
     * SELECT * FROM t1 WHERE t1.a IN (SELECT MAX(t1.b) FROM t2 WHERE ...);
     * 
     * Here, MAX(t1.b) cannot aggregated in the outer query because it appears 
     * in the WHERE clause of that query. Standard SQL requires an error in this 
     * situation. If ANSI mode is not enabled, the server treats S(outer_ref) in 
     * such queries the same way that it would interpret S(const).
     * 
     * See Section 1.8, “MySQL Standards Compliance”.
     * 
     * @since 18-11-10
     */
    const ANSI = "ANSI";

    /**
     * Equivalent to PIPES_AS_CONCAT, ANSI_QUOTES, IGNORE_SPACE, NO_KEY_OPTIONS, 
     * NO_TABLE_OPTIONS, NO_FIELD_OPTIONS.
     * 
     * Note: As of MySQL 5.7.22, DB2 is deprecated. It will be removed in a 
     * future version of MySQL.
     * 
     * @since 18-11-10
     */
    const DB2 = "DB2";

    /**
     * Equivalent to PIPES_AS_CONCAT, ANSI_QUOTES, IGNORE_SPACE, NO_KEY_OPTIONS,
     * NO_TABLE_OPTIONS, NO_FIELD_OPTIONS, NO_AUTO_CREATE_USER.
     * 
     * Note: As of MySQL 5.7.22, MAXDB is deprecated. It will be removed in a 
     * future version of MySQL.
     * 
     * @since 18-11-10
     */
    const MAXDB = "MAXDB";

    /**
     * Equivalent to PIPES_AS_CONCAT, ANSI_QUOTES, IGNORE_SPACE, NO_KEY_OPTIONS, 
     * NO_TABLE_OPTIONS, NO_FIELD_OPTIONS.
     * 
     * Note: As of MySQL 5.7.22, MSSQL is deprecated. It will be removed in a 
     * future version of MySQL.
     * 
     * @since 18-11-10
     */
    const MSSQL = "MSSQL";

    /**
     * Equivalent to MYSQL323, HIGH_NOT_PRECEDENCE. This means 
     * HIGH_NOT_PRECEDENCE plus some SHOW CREATE TABLE behaviors specific to 
     * MYSQL323:
     * 
     * TIMESTAMP column display does not include DEFAULT or ON UPDATE attributes.
     * 
     *  String column display does not include character set and collation 
     * attributes. For CHAR and VARCHAR columns, if the collation is binary, 
     * BINARY is appended to the column type.
     * 
     * The ENGINE=engine_name table option displays as TYPE=engine_name.
     * 
     * For MEMORY tables, the storage engine is displayed as HEAP. 
     * 
     * Note: As of MySQL 5.7.22, MYSQL323 is deprecated. It will be removed in a 
     * future version of MySQL.
     * 
     * @since 18-11-10
     */
    const MYSQL323 = "MYSQL323";

    /**
     * Equivalent to MYSQL40, HIGH_NOT_PRECEDENCE. This means 
     * HIGH_NOT_PRECEDENCE plus some behaviors specific to MYSQL40. These are 
     * the same as for MYSQL323, except that SHOW CREATE TABLE does not display 
     * HEAP as the storage engine for MEMORY tables.
     * 
     * Note: As of MySQL 5.7.22, MYSQL40 is deprecated. It will be removed in a 
     * future version of MySQL.
     * 
     * @since 18-11-10
     */
    const MYSQL40 = "MYSQL40";

    /**
     * Equivalent to PIPES_AS_CONCAT, ANSI_QUOTES, IGNORE_SPACE, NO_KEY_OPTIONS,
     * NO_TABLE_OPTIONS, NO_FIELD_OPTIONS, NO_AUTO_CREATE_USER.
     * 
     * Note: As of MySQL 5.7.22, ORACLE is deprecated. It will be removed in a 
     * future version of MySQL.
     * 
     * @since 18-11-10
     */
    const ORACLE = "ORACLE";

    /**
     * Equivalent to PIPES_AS_CONCAT, ANSI_QUOTES, IGNORE_SPACE, NO_KEY_OPTIONS, 
     * NO_TABLE_OPTIONS, NO_FIELD_OPTIONS.
     * 
     * Note: As of MySQL 5.7.22, POSTGRESQL is deprecated. It will be removed in 
     * a future version of MySQL.
     * 
     * @since 18-11-10
     */
    const POSTGRESQL = "POSTGRESQL";

    /**
     * Before MySQL 5.7.4, and in MySQL 5.7.8 and later, TRADITIONAL is 
     * equivalent to STRICT_TRANS_TABLES, STRICT_ALL_TABLES, NO_ZERO_IN_DATE, 
     * NO_ZERO_DATE, ERROR_FOR_DIVISION_BY_ZERO, NO_AUTO_CREATE_USER, and 
     * NO_ENGINE_SUBSTITUTION.
     * 
     * From MySQL 5.7.4 though 5.7.7, TRADITIONAL is equivalent to 
     * STRICT_TRANS_TABLES, STRICT_ALL_TABLES, NO_AUTO_CREATE_USER, and 
     * NO_ENGINE_SUBSTITUTION. The NO_ZERO_IN_DATE, NO_ZERO_DATE, 
     * and ERROR_FOR_DIVISION_BY_ZERO modes are not named because in those 
     * versions their effects are included in the effects of strict SQL mode 
     * (STRICT_ALL_TABLES or STRICT_TRANS_TABLES). Thus, the effects of 
     * TRADITIONAL are the same in all MySQL 5.7 versions (and the same as in
     * MySQL 5.6). For additional discussion, see SQL Mode Changes in MySQL 5.7. 
     * 
     * @since 18-11-10
     */
    const TRADITIONAL = "TRADITIONAL";

}
