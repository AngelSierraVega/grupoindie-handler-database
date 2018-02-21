<?php

namespace GIndie\DBHandler\MySQL\Statement\DataManipulation;

/**
 * DVLP-DBHandler - groupByTrait
 * 
 * @link <https://dev.mysql.com/doc/refman/5.7/en/select.html>
 *
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * @copyright (c) 2018 Angel Sierra Vega. Grupo INDIE.
 *
 * @package DatabaseHandler
 *
 * @version GI-DBH.00.00 18-02-15 Empty trait created.
 * @edit GI-DBH.00.01
 * - Created addGroupBy(), renderGroupBy(), $groups
 */
trait groupByTrait
{

    /**
     * 
     * @param mixed $expr
     * @param boolean $asc
     * 
     * @return $this
     * 
     * @since GI-DBH.00.01
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
     * @since GI-DBH.00.01
     */
    protected function renderGroupBy()
    {
        return \count($this->groups) == 0 ? "" : " GROUP BY " . \join(", ", $this->groups);
    }

    /**
     *
     * @var array 
     * @since GI-DBH.00.01
     */
    private $groups = [];

}
