<?php

/**
 * GI-DBHandler-DVLP - ShowColumns
 *
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * @copyright (CC) 2020 Angel Sierra Vega. Grupo INDIE.
 * @license file://LICENSE
 *
 * @package GIndie\DBHandler\MySQL57\Statement
 *
 * @version 00.A6
 * @since 18-11-02
 * @todo Upgrade DocBlock to MySQL57
 */

namespace GIndie\DBHandler\MySQL57\Statement\DataAdministration;

/**
 * 
 * @edit 18-11-02
 * - Copied code from GIndie\DBHandler\MySQL56\...
 */
class ShowColumns
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
     * @return \GIndie\DBHandler\MySQL57\Statement\DataAdministration\ShowColumns
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
