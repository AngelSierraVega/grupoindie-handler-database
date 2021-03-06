<?php

/**
 *
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * @copyright (CC) 2020 Angel Sierra Vega. Grupo INDIE.
 * @license file://LICENSE
 *
 * @package GIndie\DBHandler\MySQL\Statement
 * 
 */

namespace GIndie\DBHandler\MySQL\Statement\Traits;

/**
 * DVLP-DBHandler - groupByTrait
 * 
 * @link <https://dev.mysql.com/doc/refman/5.6/en/select.html>
 *
 *
 * @since 18-02-15
 * @edit 18-02-15
 * - Created addGroupBy(), renderGroupBy(), $groups
 * @version A0
 * @edit 18-05-03
 * - Moved file from [base_dir]\MySQL\Statement to [base_dir]\MySQL56\Statement\DataManipulation\Traits
 * - Updated namespace
 * - Updated trait name due to PSR-0 Violation
 * @version 00.A8
 * @edit 18-10-02
 * - Upgraded version
 * @edit 18-11-02
 * - Moved from MySQL56\...
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
