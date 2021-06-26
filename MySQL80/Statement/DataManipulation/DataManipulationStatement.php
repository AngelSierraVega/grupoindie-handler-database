<?php

/**
 * GI-DBHandler-DVLP - DataManipulationStatement
 *
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * @copyright (CC) 2020 Angel Sierra Vega. Grupo INDIE.
 * @license file://LICENSE
 *
 * @package GIndie\DBHandler\MySQL57\Statement
 *
 * @version DOING
 * @since 18-05-03
 * @todo Upgrade DocBlock
 */

namespace GIndie\DBHandler\MySQL57\Statement\DataManipulation;

use GIndie\DBHandler\MySQL\Statement\Traits;

/**
 * 
 * @edit 18-10-02
 * - Upgraded version
 * @edit 18-11-02
 * - Copied code from MySQL56\...
 */
abstract class DataManipulationStatement
{

    /**
     * Traits
     * @since 18-05-03
     * @edit 18-08-26
     * - Added Traits\InsertDataTrait
     */
    use Traits\GroupByTrait;
    use Traits\HavingTrait;
    use Traits\LimitTrait;
    use Traits\OrderByTrait;
    use Traits\SelectorTrait;
    use Traits\TableReferenceTrait;
    use Traits\WhereTrait;
    use Traits\InsertDataTrait;
}
