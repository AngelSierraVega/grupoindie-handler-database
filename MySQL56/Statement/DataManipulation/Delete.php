<?php

/**
 * GI-DBHandler-DVLP - Delete
 *
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * @copyright (c) 2018 Angel Sierra Vega. Grupo INDIE.
 *
 * @package GIndie\DBHandler\MySQL56\Statement
 *
 * @version 00.A0
 * @since 18-08-26
 */

namespace GIndie\DBHandler\MySQL56\Statement\DataManipulation;

/**
 * DELETE [LOW_PRIORITY] [QUICK] [IGNORE] FROM tbl_name
 *   [PARTITION (partition_name [, partition_name] ...)]
 *   [WHERE where_condition]
 *   [ORDER BY ...]
 *   [LIMIT row_count]
 * 
 * @link <https://dev.mysql.com/doc/refman/5.6/en/delete.html> *
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * @edit 18-08-29
 * - Functional class
 * @edit 18-10-02
 * - Upgraded version
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
