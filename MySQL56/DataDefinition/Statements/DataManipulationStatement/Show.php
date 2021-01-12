<?php

/**
 * GI-DBHandler-DVLP - Show
 *
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * @copyright (CC) 2020 Angel Sierra Vega. Grupo INDIE.
 * @license file://LICENSE
 *
 * @package GIndie\DBHandler\DataDefinition\MySQL56\Statements
 *
 * @version 00.30
 * @since 18-05-20
 */

namespace GIndie\DBHandler\MySQL56\DataDefinition\Statements\DataManipulationStatement;

/**
 * <b>SHOW statements</b> provide information about databases, tables, columns, or 
 * status information about the server.
 * 
 * If the syntax for a given SHOW statement includes a LIKE 'pattern' part, 
 * 'pattern' is a string that can contain the SQL % and _ wildcard characters. 
 * The pattern is useful for restricting statement output to matching values.
 * 
 * Several <b>SHOW statements</b> also accept a <b>WHERE clause</b> that provides more 
 * flexibility in specifying which rows to display. See Section 21.33, 
 * “Extensions to SHOW Statements”.
 * 
 * PHP API treats the result returned from a <b>SHOW statement</b> as it would a result
 * set from a <b>SELECT statement</b>
 * 
 * @link <https://dev.mysql.com/doc/refman/5.6/en/show.html>
 * 
 * @edit 18-10-02
 * - Upgraded version
 * 
 * @todo
 * SHOW AUTHORS
 * SHOW {BINARY | MASTER} LOGS
 * SHOW BINLOG EVENTS [IN 'log_name'] [FROM pos] [LIMIT [offset,] row_count]
 * SHOW CHARACTER SET [like_or_where]
 * SHOW COLLATION [like_or_where]
 * SHOW [FULL] COLUMNS FROM tbl_name [FROM db_name] [like_or_where]
 * SHOW CONTRIBUTORS
 * SHOW CREATE DATABASE db_name
 * SHOW CREATE EVENT event_name
 * SHOW CREATE FUNCTION func_name
 * SHOW CREATE PROCEDURE proc_name
 * SHOW CREATE TABLE tbl_name
 * SHOW CREATE TRIGGER trigger_name
 * SHOW CREATE VIEW view_name
 * SHOW ENGINE engine_name {STATUS | MUTEX}
 * SHOW [STORAGE] ENGINES
 * SHOW ERRORS [LIMIT [offset,] row_count]
 * SHOW EVENTS
 * SHOW FUNCTION CODE func_name
 * SHOW FUNCTION STATUS [like_or_where]
 * SHOW GRANTS FOR user
 * SHOW INDEX FROM tbl_name [FROM db_name]
 * SHOW MASTER STATUS
 * SHOW OPEN TABLES [FROM db_name] [like_or_where]
 * SHOW PLUGINS
 * SHOW PROCEDURE CODE proc_name
 * SHOW PROCEDURE STATUS [like_or_where]
 * SHOW PRIVILEGES
 * SHOW [FULL] PROCESSLIST
 * SHOW PROFILE [types] [FOR QUERY n] [OFFSET n] [LIMIT n]
 * SHOW PROFILES
 * SHOW RELAYLOG EVENTS [IN 'log_name'] [FROM pos] [LIMIT [offset,] row_count]
 * SHOW SLAVE HOSTS
 * SHOW SLAVE STATUS
 * SHOW [GLOBAL | SESSION] STATUS [like_or_where]
 * SHOW TABLE STATUS [FROM db_name] [like_or_where]
 * SHOW [FULL] TABLES [FROM db_name] [like_or_where]
 * SHOW TRIGGERS [FROM db_name] [like_or_where]
 * SHOW [GLOBAL | SESSION] VARIABLES [like_or_where]
 * SHOW WARNINGS [LIMIT [offset,] row_count]
 * like_or_where:
 * LIKE 'pattern'
 * | WHERE expr
 */
interface Show extends Show\Databases
{

    /**
     * SHOW DATABASES lists the databases on the MySQL server host. SHOW SCHEMAS is 
     * a synonym for SHOW DATABASES. The LIKE clause, if present, indicates which 
     * database names to match. The WHERE clause can be given to select rows using 
     * more general conditions, as discussed in Section 21.33, “Extensions to SHOW 
     * Statements”.
     * 
     * You see only those databases for which you have some kind of privilege, 
     * unless you have the global SHOW DATABASES privilege. You can also get this 
     * list using the mysqlshow command.
     * 
     * If the server was started with the --skip-show-database option, you cannot 
     * use this statement at all unless you have the SHOW DATABASES privilege.
     * 
     * MySQL implements databases as directories in the data directory, so this 
     * statement simply lists directories in that location. However, the output may 
     * include names of directories that do not correspond to actual databases. 
     * 
     * @link <https://dev.mysql.com/doc/refman/5.6/en/show-databases.html>
     * @since 18-05-20
     */
    public static function databases();
}
