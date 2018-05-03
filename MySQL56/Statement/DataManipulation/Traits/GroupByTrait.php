<?php

namespace GIndie\DBHandler\MySQL56\Statement\DataManipulation\Traits;

/**
 * DVLP-DBHandler - groupByTrait
 * 
 * @link <https://dev.mysql.com/doc/refman/5.6/en/select.html>
 *
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * @copyright (c) 2018 Angel Sierra Vega. Grupo INDIE.
 *
 * @package DatabaseHandler
 * @subpackage MySQL56
 *
 * @since 18-02-15
 * @edit 18-02-15
 * - Created addGroupBy(), renderGroupBy(), $groups
 * @version A0
 * @edit 18-05-03
 * - Moved file from [base_dir]\MySQL\Statement to [base_dir]\MySQL56\Statement\DataManipulation\Traits
 * - Updated namespace
 * - Updated trait name due to PSR-0 Violation
 * @version A1
 */
trait GroupByTrait
{

    /**
     * 
     * @param mixed $expr
     * @param boolean $asc
     * 
     * @return $this
     * 
     * @since 18-02-15
     */
    public function addGroupBy($expr, $asc = true)
    {
        $this->groups[] = $asc ? "{$expr} ASC" : "{$expr} DESC";
        return $this;
    }

    /**
     * 
     * @return string
     * 
     * @since 18-02-15
     */
    protected function renderGroupBy()
    {
        return \count($this->groups) == 0 ? "" : " GROUP BY " . \join(", ", $this->groups);
    }

    /**
     *
     * @var array 
     * @since 18-02-15
     */
    private $groups = [];

}
