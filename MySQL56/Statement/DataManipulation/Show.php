<?php

/**
 * GI-DBHandler-DVLP - Show
 *
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * @copyright (CC) 2020 Angel Sierra Vega. Grupo INDIE.
 * @license file://LICENSE
 *
 * @package GIndie\DBHandler\MySQL56\Statement
 *
 * @version 00.AA
 * @since 18-05-20
 */

namespace GIndie\DBHandler\MySQL56\Statement\DataManipulation;

use GIndie\DBHandler\MySQL56\DataDefinition\Statements;

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
 * @edit 18-10-02
 * - Upgraded version
 */
class Show extends DataManipulationStatement
        implements Statements\DataManipulationStatement\Show
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
     * @since 18-05-20
     * @edit 18-11-02
     * - Use constant
     */
    public static function databases()
    {
        return new Show(static::DATABASES);
    }

    /**
     * 
     * @param array $selectors
     * @param array $tableReferences
     * 
     * @since 18-05-20
     * @edit 18-11-02
     * - Changed method visibility
     */
    private function __construct($showType)
    {
        $this->showType = $showType;
    }

    /**
     * 
     * @return string
     * 
     * @since 18-05-20
     */
    public function __toString()
    {
        return "SHOW " . $this->showType . $this->renderWhereClause() . ";";
    }

}
