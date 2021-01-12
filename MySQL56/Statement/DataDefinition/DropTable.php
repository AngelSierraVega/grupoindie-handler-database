<?php

/**
 * GI-DBHandler-DVLP - DropTable
 *
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * @copyright (CC) 2020 Angel Sierra Vega. Grupo INDIE.
 * @license file://LICENSE
 *
 * @package GIndie\DBHandler\MySQL56\Statement
 *
 * @version 00.AA
 * @since 18-08-16
 */

namespace GIndie\DBHandler\MySQL56\Statement\DataDefinition;

/**
 *  DROP TABLE removes one or more tables. You must have the DROP privilege for 
 * each table.
 *
 * Be careful with this statement! It removes the table definition and all table 
 * data. For a partitioned table, it permanently removes the table definition, 
 * all its partitions, and all data stored in those partitions. It also removes 
 * the partitioning definition (.par) file associated with the dropped table.
 * 
 * DROP TABLE causes an implicit commit, except when used with the TEMPORARY 
 * keyword. See Section 13.3.3, “Statements That Cause an Implicit Commit”.
 * 
 * Use IF EXISTS to prevent an error from occurring for tables that do not exist. 
 * Instead of an error, a NOTE is generated for each nonexistent table; these 
 * notes can be displayed with SHOW WARNINGS. See Section 13.7.5.41, “SHOW 
 * WARNINGS Syntax”.
 * 
 * IF EXISTS can also be useful for dropping tables in unusual circumstances 
 * under which there is an .frm file but no table managed by the storage engine. 
 * (For example, if an abnormal server exit occurs after removal of the table 
 * from the storage engine but before .frm file removal.)
 * 
 * The TEMPORARY keyword has the following effects:
 * The statement drops only TEMPORARY tables.
 * The statement does not cause an implicit commit.
 * No access rights are checked. A TEMPORARY table is visible only with the 
 * session that created it, so no check is necessary.
 * 
 * Using TEMPORARY is a good way to ensure that you do not accidentally drop a 
 * non-TEMPORARY table.
 * 
 * The RESTRICT and CASCADE keywords do nothing. They are permitted to make 
 * porting easier from other database systems.
 * 
 * @link <https://dev.mysql.com/doc/refman/5.6/en/drop-table.html>
 * 
 * @edit 18-10-02
 * - Upgraded version
 */
class DropTable extends DataDefinitionStatement
{

    /**
     *
     * @var string 
     * @since 18-08-16
     */
    private $tableName;

    /**
     * 
     * @param type $tableName
     * @param array $columnDefinition
     * @since 18-08-16
     */
    public function __construct($tableName)
    {
        $this->tableName = $tableName;
    }

    /**
     *
     * @var string 
     * @since 18-08-16
     */
    private $databaseName;

    /**
     * 
     * @param string $databaseName
     * @return \GIndie\DBHandler\MySQL56\Statement\DataDefinition\DropTable
     * @since 18-08-16
     */
    public function setDatabaseName($databaseName)
    {
        $this->databaseName = $databaseName;
        return $this;
    }

    /**
     * 
     * @return string
     * @since 18-08-16
     */
    public function __toString()
    {
        $rtnStr = "DROP TABLE ";
        $rtnStr .= isset($this->databaseName) ? "`{$this->databaseName}`.`{$this->tableName}`" : "`{$this->tableName}`";
        $rtnStr .= ";";
        return $rtnStr;
    }

}
