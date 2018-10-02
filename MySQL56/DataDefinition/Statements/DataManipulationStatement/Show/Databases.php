<?php

/**
 * GI-DBHandler-DVLP - Databases
 *
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * @copyright (c) 2018 Angel Sierra Vega. Grupo INDIE.
 *
 * @package GIndie\DBHandler\DataDefinition\MySQL56\Statements
 *
 * @version 00.90
 * @since 18-05-20
 */

namespace GIndie\DBHandler\MySQL56\DataDefinition\Statements\DataManipulationStatement\Show;

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
 * 
 * @since 18-05-20
 * @edit 18-10-02
 * - Upgraded version
 * @todo
 * SHOW {DATABASES | SCHEMAS}
 *  [LIKE 'pattern' | WHERE expr]
 */
interface Databases
{
    //put your code here
}
