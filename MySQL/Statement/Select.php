<?php

namespace GIndie\DBHandler\MySQL\Statement;

/**
 * DVLP-DBHandler - Select
 *
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * @copyright (c) 2018 Angel Sierra Vega. Grupo INDIE.
 *
 * @package DatabaseHandler
 *
 * @version GI-DBH.00.00 18-02-14 Empty class created.
 * @edit GI-DBH.00.01
 * - Class extends DataManipulation
 * - Created __construct(), __toString()
 */
class Select extends DataManipulation
{

    /**
     * 
     * @param array $selectors
     * @param array $tableReferences
     * 
     * @since GI-DBH.00.01
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
     * @since GI-DBH.00.01
     */
    public function __toString()
    {
        return "SELECT" . $this->renderSelectors() . $this->renderTableReferences() .
                $this->renderWhereClause() . $this->renderGroupBy() . $this->renderHaving() .
                $this->renderOrderBy() . $this->renderLimit() . ";";
    }

}
