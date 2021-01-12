<?php

/**
 * GI-DBHandler-DVLP - CreateTable
 *
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * @copyright (CC) 2020 Angel Sierra Vega. Grupo INDIE.
 * @license file://LICENSE
 *
 * @package GIndie\DBHandler\MySQL57\Statement
 *
 * @version 00.97
 * @since 18-08-15
 * @todo Upgrade DocBlock to MySQL57
 */

namespace GIndie\DBHandler\MySQL57\Statement\DataDefinition;

/**
 * 
 * @edit 18-08-27
 * - Updated addColumnDefinition()
 * @edit 18-10-02
 * - Upgraded version
 * @edit 18-11-02
 * - Copied code from GIndie\DBHandler\MySQL56\...
 */
class CreateTable extends DataDefinitionStatement
{

    /**
     *
     * @var string 
     * @since 18-08-15
     */
    private $tableName;

    /**
     * 
     * @param type $tableName
     * @param array $columnDefinition
     * @since 18-08-15
     */
    public function __construct($tableName)
    {
        $this->tableName = $tableName;
    }

    /**
     *
     * @var array 
     * @since 18-08-15
     */
    private $columnDefinition = [];

    /**
     * 
     * @param string $columnDefinition
     * @since 18-08-15
     * @return \GIndie\DBHandler\MySQL56\Statement\DataDefinition\CreateTable
     * @edit 18-08-27
     * - Simple column definition
     */
    public function addColumnDefinition($columnDefinition)
    {
        $this->columnDefinition[] = $columnDefinition;
//        $this->columnDefinition[] = "`{$columnDefinition}`";
        return $this;
    }

    /**
     *
     * @var string 
     * @since 18-08-15
     */
    private $databaseName;

    /**
     * 
     * @param string $databaseName
     * @return \GIndie\DBHandler\MySQL56\Statement\DataDefinition\CreateTable
     * @since 18-08-15
     */
    public function setDatabaseName($databaseName)
    {
        $this->databaseName = $databaseName;
        return $this;
    }

    /**
     *
     * @var array 
     * 
     * @since 18-08-20
     */
    private $referenceDefinition = [];

    /**
     * 
     * @param array $referenceDefinition
     * @return \GIndie\DBHandler\MySQL56\Statement\DataDefinition\CreateTable
     */
    public function setReferenceDefinition(array $referenceDefinition)
    {
        $this->referenceDefinition = $referenceDefinition;
        return $this;
    }

    /**
     * 
     * @return string
     * @since 18-08-15
     * @edit 18-11-11
     * - Remove [IF NOT EXISTS] 
     * @todo Charset and collate from database
     */
    public function __toString()
    {
        $rtnStr = "CREATE TABLE ";
        $rtnStr .= isset($this->databaseName) ? "`{$this->databaseName}`.`{$this->tableName}` " : "`{$this->tableName}` ";
        $rtnStr .= "(" . \join(",", $this->columnDefinition);
        $rtnStr .= \count($this->referenceDefinition) > 0 ? "," . \join(",", $this->referenceDefinition) : "";
        $rtnStr .= ") ";
        $rtnStr .= "ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 DEFAULT COLLATE=utf8mb4_unicode_ci;";
        return $rtnStr;
    }

}
