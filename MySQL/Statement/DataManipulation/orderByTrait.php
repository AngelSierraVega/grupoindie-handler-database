<?php

namespace GIndie\DBHandler\MySQL\Statement\DataManipulation;

/**
 * DVLP-DBHandler - orderByTrait
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
 * - Created $orderBy, renderOrderBy(), addOrderBy()
 */
trait orderByTrait
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
    public function addOrderBy($expr, $asc = true)
    {
        $this->orderBy[] = $asc ? "{$expr} ASC" : "{$expr} DESC";
        return $this;
    }

    /**
     * 
     * @return string
     * 
     * @since GI-DBH.00.01
     */
    protected function renderOrderBy()
    {
        return \count($this->orderBy) == 0 ? "" : " ORDER BY " . \join(", ", $this->orderBy);
    }

    /**
     *
     * @var array 
     * @since GI-DBH.00.01
     */
    private $orderBy = [];

}
