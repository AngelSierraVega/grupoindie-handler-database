<?php

/**
 * GI-DBHandler-DVLP - AlterTable
 *
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * @copyright (c) 2018 Angel Sierra Vega. Grupo INDIE.
 *
 * @package GIndie\DBHandler\MySQL57\Statement
 *
 * @version 00.50
 * @since 18-11-16
 */

namespace GIndie\DBHandler\MySQL57\Statement\DataDefinition;

/**
 * Description of AlterTable
 *
 * @edit 19-01-29
 * - Added modifyColumn
 */
class AlterTable extends DataDefinitionStatement
{

    /**
     *
     * @var string 
     * @since 18-11-16
     */
    private $tableName;

    /**
     * 
     * @param type $tableName
     * @param array $columnDefinition
     * @since 18-11-16
     */
    public function __construct($tableName)
    {
        $this->tableName = $tableName;
    }

    /**
     *
     * @var array 
     * @since 18-11-16
     */
    private $addColumn = [];

    /**
     * 
     * @param string $columnDefinition
     * 
     * @return \GIndie\DBHandler\MySQL56\Statement\DataDefinition\AlterTable
     * 
     * @since 18-11-16
     */
    public function addColumn($columnDefinition)
    {
        $this->addColumn[] = $columnDefinition;
        return $this;
    }

    /**
     *
     * @var array 
     * @since 19-01-29
     */
    private $modifyColumn = [];

    /**
     * 
     * @param string $columnName
     * @param mixed $columnDefinition
     * 
     * @return \GIndie\DBHandler\MySQL56\Statement\DataDefinition\AlterTable
     * @since 19-01-29
     */
    public function modifyColumn($columnName, $columnDefinition)
    {
        $this->modifyColumn[] = $columnName . " " . $columnDefinition;
        return $this;
    }

    /**
     *
     * @var string 
     * @since 18-11-16
     */
    private $databaseName;

    /**
     * 
     * @param string $databaseName
     * @return \GIndie\DBHandler\MySQL56\Statement\DataDefinition\CreateTable
     * @since 18-11-16
     */
    public function setDatabaseName($databaseName)
    {
        $this->databaseName = $databaseName;
        return $this;
    }

    /**
     * 
     * @return string
     * @since 18-11-16
     * @edit 19-01-29
     * - Handle modifyColumn
     */
    public function __toString()
    {
        $rtnStr = "ALTER TABLE ";
        $rtnStr .= isset($this->databaseName) ? "`{$this->databaseName}`.`{$this->tableName}` " : "`{$this->tableName}` ";
        $rtnStr .= \count($this->addColumn) > 0 ? "ADD COLUMN " . \join(",", $this->addColumn) : "";
        $rtnStr .= \count($this->modifyColumn) > 0 ? "MODIFY " . \join(",", $this->modifyColumn): "";
        $rtnStr .= ";";
        return $rtnStr;
    }

}
