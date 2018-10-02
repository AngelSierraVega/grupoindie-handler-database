<?php

/**
 * GI-DBHandler-DVLP - ShowColumns
 *
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * @copyright (c) 2018 Angel Sierra Vega. Grupo INDIE.
 *
 * @package GIndie\DBHandler\MySQL56\Statement
 *
 * @version 00.AA
 * @since 18-08-16
 */

namespace GIndie\DBHandler\MySQL56\Statement\DataAdministration;

/**
 * SHOW COLUMNS displays information about the columns in a given table. It also 
 * works for views. SHOW COLUMNS displays information only for those columns for 
 * which you have some privilege. 
 * 
 * The optional FULL keyword causes the output to include the column collation 
 * and comments, as well as the privileges you have for each column.
 * 
 * The LIKE clause, if present, indicates which column names to match. The WHERE 
 * clause can be given to select rows using more general conditions, as discussed 
 * in Section 21.34, “Extensions to SHOW Statements”.
 * 
 * The data types may differ from what you expect them to be based on a CREATE 
 * TABLE statement because MySQL sometimes changes data types when you create or 
 * alter a table. The conditions under which this occurs are described in 
 * Section 13.1.17.7, “Silent Column Specification Changes”.
 * 
 * SHOW COLUMNS displays the following values for each table column:
 * Field
 *     The column name.
 *     Type
 *     The column data type.
 *     Collation
 *     The collation for nonbinary string columns, or NULL for other columns. 
 * This value is displayed only if you use the FULL keyword.
 *     Null
 *     The column nullability. The value is YES if NULL values can be stored in 
 * the column, NO if not.
 * 
 *     Key
 *     Whether the column is indexed:
 *         If Key is empty, the column either is not indexed or is indexed only 
 * as a secondary column in a multiple-column, nonunique index.
 *         If Key is PRI, the column is a PRIMARY KEY or is one of the columns 
 * in a multiple-column PRIMARY KEY.
 *         If Key is UNI, the column is the first column of a UNIQUE index. (A 
 * UNIQUE index permits multiple NULL values, but you can tell whether the 
 * column permits NULL by checking the Null field.)
 *         If Key is MUL, the column is the first column of a nonunique index in 
 * which multiple occurrences of a given value are permitted within the column. 
 * 
 *     If more than one of the Key values applies to a given column of a table, 
 * Key displays the one with the highest priority, in the order PRI, UNI, MUL.
 * 
 *     A UNIQUE index may be displayed as PRI if it cannot contain NULL values and 
 * there is no PRIMARY KEY in the table. A UNIQUE index may display as MUL if 
 * several columns form a composite UNIQUE index; although the combination of 
 * the columns is unique, each column can still hold multiple occurrences of
 *  a given value.
 * 
 *     Default
 *     The default value for the column. This is NULL if the column has an 
 * explicit default of NULL, or if the column definition includes no DEFAULT clause.
 * 
 *     Extra
 *     Any additional information that is available about a given column. 
 * The value is nonempty in these cases: auto_increment for columns that have 
 * the AUTO_INCREMENT attribute; on update CURRENT_TIMESTAMP for TIMESTAMP or 
 * DATETIME columns that have the ON UPDATE CURRENT_TIMESTAMP attribute.
 * 
 *     Privileges
 *     The privileges you have for the column. This value is displayed only if 
 * you use the FULL keyword.
 * 
 *     Comment
 * 
 *     Any comment included in the column definition. This value is displayed 
 * only if you use the FULL keyword. 
 * 
 *  Table column information is also available from the INFORMATION_SCHEMA 
 * COLUMNS table. See Section 21.5, “The INFORMATION_SCHEMA COLUMNS Table”.
 * 
 * You can list a table's columns with the mysqlshow db_name tbl_name command.
 * 
 * The DESCRIBE statement provides information similar to SHOW COLUMNS. See 
 * Section 13.8.1, “DESCRIBE Syntax”.
 * 
 * The SHOW CREATE TABLE, SHOW TABLE STATUS, and SHOW INDEX statements also 
 * provide information about tables. See Section 13.7.5, “SHOW Syntax”. 
 * 
 * @edit 18-10-02
 * - Upgraded version
 *
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 */
class ShowColumns extends DataAdministrationStatement
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
        $rtnStr = "SHOW FULL COLUMNS FROM ";
        $rtnStr .= isset($this->databaseName) ? "`{$this->databaseName}`.`{$this->tableName}`" : "`{$this->tableName}`";
        $rtnStr .= ";";
        return $rtnStr;
    }
}
