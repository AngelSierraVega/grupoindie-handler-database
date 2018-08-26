<?php

namespace GIndie\DBHandler\MySQL56\Statement\DataManipulation;

/**
 * GI-DBHandler-DVLP - DataManipulationStatement
 * 
 * @link <https://dev.mysql.com/doc/refman/5.6/en/sql-syntax-data-manipulation.html>
 *
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * @copyright (c) 2018 Angel Sierra Vega. Grupo INDIE.
 *
 * @package GIndie\DBHandler\MySQL56\Statement
 *
 * @since 18-05-03
 * - Abstract class
 * - Added traits
 * @version 0A.30
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
