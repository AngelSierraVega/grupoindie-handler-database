<?php

/**
 * GI-HNDLR-DB - ShowIndex
 *
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * @copyright (c) 2021 Angel Sierra Vega. Grupo INDIE.
 * @license file://LICENSE
 *
 * @package GIndie\DBHandler\MySQL57\Statement
 *
 * @version 00.A0
 * @since 21-06-28
 */

namespace GIndie\DBHandler\MySQL57\Statement\DataAdministration;

/**
 * SHOW INDEX returns table index information. The format resembles that of the 
 * SQLStatistics call in ODBC. This statement requires some privilege for any 
 * column in the table.
 * 
 * @link <https://dev.mysql.com/doc/refman/5.7/en/show-index.html>
 *
 */
class ShowIndex {
    /**
     *
     * @var string 
     * @since 21-06-28
     */
    private $tableName;

    /**
     * SHOW INDEX returns table index information. The format resembles that of
     * the SQLStatistics call in ODBC. This statement requires some privilege 
     * for any column in the table.
     * 
     * @param string $tableName
     * @since 21-06-28
     */
    public function __construct($tableName)
    {
        $this->tableName = $tableName;
    }

    /**
     *
     * @var string 
     * @since 21-06-28
     */
    private $databaseName;

    /**
     * 
     * @param string $databaseName
     * @return \GIndie\DBHandler\MySQL57\Statement\DataAdministration\ShowIndex
     * @since 21-06-28
     */
    public function setDatabaseName($databaseName)
    {
        $this->databaseName = $databaseName;
        return $this;
    }

    /**
     * 
     * @return string
     * @since 21-06-28
     */
    public function __toString()
    {
        $rtnStr = "SHOW INDEX FROM ";
        $rtnStr .= isset($this->databaseName) ? "`{$this->databaseName}`.`{$this->tableName}`" : "`{$this->tableName}`";
        $rtnStr .= ";";
        return $rtnStr;
    }
}
