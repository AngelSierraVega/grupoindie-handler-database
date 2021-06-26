<?php

/**
 * GI-DBHandler-DVLP - Select
 *
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * @copyright (CC) 2020 Angel Sierra Vega. Grupo INDIE.
 * @license file://LICENSE
 *
 * @package GIndie\DBHandler\MySQL57\Statement
 *
 * @version DOING
 * @since 18-02-14
 * @todo Upgrade DocBlock
 * @todo select must not require table references
 */

namespace GIndie\DBHandler\MySQL57\Statement\DataManipulation;

/**
 * 
 * @edit 18-02-14
 * - Class extends DataManipulation
 * - Created __construct(), __toString()
 * @edit 18-05-03
 * - Moved file from [base_dir]\MySQL\Statement to [base_dir]\MySQL56\Statement\DataManipulation
 * - Updated namespace
 * @edit 18-10-02
 * - Upgraded version
 * @edit 18-11-02
 * - Copied code from MySQL56\...
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
     * @var string Temporal appended text
     * @since 18-12-25
     * @todo Deprecate
     */
    private $appendedText = "";

    /**
     * 
     * @param string $text
     * @return \GIndie\DBHandler\MySQL57\Statement\DataManipulation\Select
     * @since 18-12-25
     */
    public function appendText($text)
    {
        $this->appendedText .= " " . $text;
        return $this;
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
            $this->renderOrderBy() . $this->renderLimit() . $this->appendedText . ";";
    }

}
