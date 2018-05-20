<?php

namespace GIndie\DBHandler\MySQL56\Statement;

use GIndie\DBHandler\MySQL\Statement\DataManipulation AS Traits;

/**
 * DVLP-DBHandler - DataManipulation
 *
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * @copyright (c) 2018 Angel Sierra Vega. Grupo INDIE.
 *
 * @package GIndie\DBHandler\MySQL56\Statement
 *
 * @since 18-02-15
 * @edit 18-02-15
 * - Defined traits
 * @version A0
 * @edit 18-05-03
 * - Factory class
 * - Created select()
 * - Moved traits to [current]\DataManipulation\DataManipulationStatement
 * @version 0A.10
 */
class DataManipulation
{

    /**
     * 
     * @param array $selectors
     * @param array $tableReferences
     * 
     * @return \GIndie\DBHandler\MySQL56\Statement\DataManipulation\Select
     * 
     * @since 18-02-15
     * @edit 18-05-03
     * - Copied method from [base_dir]\MySQL\Statement to [base_dir]\MySQL56\Statement
     */
    public static function select(array $selectors, array $tableReferences)
    {
        return new DataManipulation\Select($selectors, $tableReferences);
    }

}
