<?php

/**
 * GI-DBHandler-DVLP - Insert
 *
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * @copyright (CC) 2020 Angel Sierra Vega. Grupo INDIE.
 * @license file://LICENSE
 *
 * @package GIndie\DBHandler\MySQL57\Statement
 *
 * @version DOING
 * @since 18-08-26
 * @todo Upgrade DocBlock
 */


namespace GIndie\DBHandler\MySQL57\Statement\DataManipulation;

/**
 * 
 * @edit 18-10-02
 * - Upgraded version
 * @edit 18-11-02
 * - Copied code from MySQL56\...
 */
class Insert extends DataManipulationStatement
{

    /**
     * 
     * @param array $selectors
     * @param array $tableReferences
     * 
     * @since 18-08-26
     */
    public function __construct(array $tableReferences, array $insertData)
    {
        $this->setTableReferences($tableReferences);
        $this->setInsertData($insertData);
    }

    /**
     * 
     * @return string
     * 
     * @since 18-08-26
     */
    public function __toString()
    {
        return "INSERT INTO " . $this->renderTableReferences() .
                $this->renderInsertData() . ";";
    }

}
