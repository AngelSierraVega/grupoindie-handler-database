<?php

namespace GIndie\DBHandler\MySQL\Statement;

use GIndie\DBHandler\MySQL\Statement\DataManipulation AS Traits;

/**
 * DVLP-DBHandler - DataManipulation
 *
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * @copyright (c) 2018 Angel Sierra Vega. Grupo INDIE.
 *
 * @package DatabaseHandler
 *
 * @version GI-DBH.00.00 18-02-15 Empty class created.
 * @edit GI-DBH.00.01
 * - Abstract class
 * - Defined traits
 */
class DataManipulation
{

    /**
     * Traits
     * @since GI-DBH.00.01
     */
    use \GIndie\DBHandler\MySQL\Statement\DataManipulation\groupByTrait;
    use \GIndie\DBHandler\MySQL\Statement\DataManipulation\havingTrait;
    use \GIndie\DBHandler\MySQL\Statement\DataManipulation\limitTrait;
    use \GIndie\DBHandler\MySQL\Statement\DataManipulation\orderByTrait;
    use \GIndie\DBHandler\MySQL\Statement\DataManipulation\selectorTrait;
    use \GIndie\DBHandler\MySQL\Statement\DataManipulation\tableReferenceTrait;
    use \GIndie\DBHandler\MySQL\Statement\DataManipulation\whereTrait;
    
    public function test();
}
