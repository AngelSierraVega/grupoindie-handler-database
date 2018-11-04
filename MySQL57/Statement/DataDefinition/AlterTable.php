<?php

/**
 * GI-DBHandler-DVLP - AlterTable
 *
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * @copyright (c) 2018 Angel Sierra Vega. Grupo INDIE.
 *
 * @package GIndie\DBHandler\MySQL57\Statement
 *
 * @version 00.3A
 * @since 18-11-16
 */

namespace GIndie\DBHandler\MySQL57\Statement\DataDefinition;

/**
 * Description of AlterTable
 *
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
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
     */
    public function __toString()
    {
        $rtnStr = "ALTER TABLE ";
        $rtnStr .= isset($this->databaseName) ? "`{$this->databaseName}`.`{$this->tableName}` " : "`{$this->tableName}` ";
        $rtnStr .= "ADD COLUMN " . \join(",", $this->addColumn);
//        $rtnStr .= \count($this->referenceDefinition) > 0 ? "," . \join(",",
//                                                                        $this->referenceDefinition) : "";
//        $rtnStr .= ") ";
        $rtnStr .= ";";
        return $rtnStr;
    }

}
