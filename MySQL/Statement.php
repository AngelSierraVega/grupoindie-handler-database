<?php

namespace GIndie\DBHandler\MySQL;

/**
 * DVLP-DBHandler - Statement
 *
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * @copyright (c) 2018 Angel Sierra Vega. Grupo INDIE.
 *
 * @package DatabaseHandler
 *
 * @version GI-DBH.00.00 18-02-14 Empty class created.
 * @edit GI-DBH.00.01 18-02-15
 * - Created select()
 */
class Statement
{

    /**
     * 
     * @param array $selectors
     * @param array $tableReferences
     * 
     * @return \GIndie\DBHandler\MySQL\Statement\Select
     * 
     * @since GI-DBH.00.01
     */
    public static function select(array $selectors, array $tableReferences)
    {
        return new Statement\Select($selectors, $tableReferences);
    }

}
