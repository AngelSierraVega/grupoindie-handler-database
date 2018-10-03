<?php

/**
 * GI-DBHandler-DVLP - Insert
 *
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * @copyright (c) 2018 Angel Sierra Vega. Grupo INDIE.
 *
 * @package GIndie\DBHandler\MySQL57\Statement
 *
 * @version 00.90
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
