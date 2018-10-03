<?php

/**
 *
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * @copyright (c) 2018 Angel Sierra Vega. Grupo INDIE.
 *
 * @package GIndie\DBHandler\MySQL\Statement
 * 
 */

namespace GIndie\DBHandler\MySQL\Statement\Traits;

/**
 * DVLP-DBHandler - orderByTrait
 * 
 * @link <https://dev.mysql.com/doc/refman/5.6/en/select.html>
 *
 *
 * @since 18-02-15
 * @edit 18-02-15
 * - Created $orderBy, renderOrderBy(), addOrderBy()
 * @version A0
 * @edit 18-05-03
 * - Moved file from [base_dir]\MySQL\Statement to [base_dir]\MySQL56\Statement\DataManipulation\Traits
 * - Updated namespace
 * - Updated trait name due to PSR-0 Violation
 * @version 00.AA
 * @edit 18-10-02
 * - Upgraded version
 * @edit 18-11-02
 * - Moved from MySQL56\...
 */
trait OrderByTrait
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
    public function addOrderBy($expr, $asc = true)
    {
        $this->orderBy[] = $asc ? "{$expr} ASC" : "{$expr} DESC";
        return $this;
    }

    /**
     * 
     * @return string
     * 
     * @since 18-02-15
     */
    protected function renderOrderBy()
    {
        return \count($this->orderBy) == 0 ? "" : " ORDER BY " . \join(", ", $this->orderBy);
    }

    /**
     *
     * @var array 
     * @since 18-02-15
     */
    private $orderBy = [];

}
