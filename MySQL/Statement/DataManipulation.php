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
    use Traits\groupByTrait;
    use Traits\havingTrait;
    use Traits\limitTrait;
    use Traits\orderByTrait;
    use Traits\selectorTrait;
    use Traits\tableReferenceTrait;
    use Traits\whereTrait;
    
}
