<?php

namespace GIndie\DBHandler\MySQL56\Statement\DataManipulation;

/**
 * DVLP-DBHandler - Select
 *
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * @copyright (c) 2018 Angel Sierra Vega. Grupo INDIE.
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
 * @version 0A.10
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
     */
    public function __toString()
    {
        return "SELECT" . $this->renderSelectors() . $this->renderTableReferences() .
                $this->renderWhereClause() . $this->renderGroupBy() . $this->renderHaving() .
                $this->renderOrderBy() . $this->renderLimit() . ";";
    }

}
