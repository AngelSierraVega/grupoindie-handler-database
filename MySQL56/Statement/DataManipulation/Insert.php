<?php

/**
 * GI-DBHandler-DVLP - Insert
 *
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * @copyright (c) 2018 Angel Sierra Vega. Grupo INDIE.
 *
 * @package GIndie\DBHandler\MySQL56\Statement
 *
 * @version 00.A3
 * @since 18-08-26
 */

namespace GIndie\DBHandler\MySQL56\Statement\DataManipulation;

/**
 * INSERT [LOW_PRIORITY | DELAYED | HIGH_PRIORITY] [IGNORE]
 *   [INTO] tbl_name
 *   [PARTITION (partition_name [, partition_name] ...)]
 *   [(col_name [, col_name] ...)]
 *   {VALUES | VALUE} (value_list) [, (value_list)] ...
 *   [ON DUPLICATE KEY UPDATE assignment_list]
 * 
 * @link <https://dev.mysql.com/doc/refman/5.6/en/insert.html>
 *
 * @edit 18-10-02
 * - Upgraded version
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
