<?php

/**
 * GI-DBHandler-DVLP - Delete
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
 * @edit 18-08-29
 * - Functional class
 * @edit 18-10-02
 * - Upgraded version
 * @edit 18-11-02
 * - Copied code from MySQL56\...
 */
class Delete extends DataManipulationStatement
{

    /**
     * 
     * @param array $selectors
     * @param array $tableReferences
     * 
     * @since 18-08-29
     */
    public function __construct(array $tableReferences)
    {
        $this->setTableReferences($tableReferences);
    }

    /**
     * 
     * @return string
     * 
     * @since 18-08-29
     */
    public function __toString()
    {
        return "DELETE FROM " . $this->renderTableReferences() .
                $this->renderWhereClause() . ";";
    }

}
