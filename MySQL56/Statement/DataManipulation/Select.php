<?php

namespace GIndie\DBHandler\MySQL56\Statement\DataManipulation;

/**
 * DVLP-DBHandler - Select
 *
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * @copyright (CC) 2020 Angel Sierra Vega. Grupo INDIE.
 * @license file://LICENSE
 *
 * @package GIndie\DBHandler\MySQL56\Statement
 *
 * @since 18-02-14
 * @edit 18-02-14
 * - Class extends DataManipulation
 * - Created __construct(), __toString()
 * @version A0
 * @edit 18-05-03
 * - Moved file from [base_dir]\MySQL\Statement to [base_dir]\MySQL56\Statement\DataManipulation
 * - Updated namespace
 * @version 00.A3
 * @edit 18-10-02
 * - Upgraded version
 */
class Select extends DataManipulationStatement
{

    /**
     * 
     * @param array $selectors
     * @param array $tableReferences
     * 
     * @since 18-02-14
     */
    public function __construct(array $selectors, array $tableReferences)
    {
        $this->setSelectors($selectors);
        $this->setTableReferences($tableReferences);
    }

    /**
     * 
     * @return string
     * 
     * @since 18-02-14
     * @edit 18-08-26
     * - Added " FROM " updated renderTableReferences()
     */
    public function __toString()
    {
        return "SELECT" . $this->renderSelectors() . " FROM " . $this->renderTableReferences() .
                $this->renderWhereClause() . $this->renderGroupBy() . $this->renderHaving() .
                $this->renderOrderBy() . $this->renderLimit() . ";";
    }

}
