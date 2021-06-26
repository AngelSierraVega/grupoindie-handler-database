<?php

/**
 * GI-DBHandler-DVLP - Show
 *
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * @copyright (CC) 2020 Angel Sierra Vega. Grupo INDIE.
 * @license file://LICENSE
 *
 * @package GIndie\DBHandler\MySQL57\Statement
 *
 * @version DOING
 * @since 18-05-20
 * @todo Upgrade DocBlock
 */

namespace GIndie\DBHandler\MySQL57\Statement\DataManipulation;

use GIndie\DBHandler\MySQL57\DataDefinition\Statements;

/**
 * 
 * @edit 18-10-02
 * - Upgraded version
 * @edit 18-11-02
 * - Copied code from MySQL56\...
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
