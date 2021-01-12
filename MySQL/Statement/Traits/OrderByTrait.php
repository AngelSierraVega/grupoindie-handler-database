<?php

/**
 *
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * @copyright (CC) 2020 Angel Sierra Vega. Grupo INDIE.
 * @license file://LICENSE
 *
 * @package GIndie\DBHandler\MySQL\Statement
 * @version 00.B0
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
 * @edit 18-05-03
 * - Moved file from [base_dir]\MySQL\Statement to [base_dir]\MySQL56\Statement\DataManipulation\Traits
 * - Updated namespace
 * - Updated trait name due to PSR-0 Violation
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
     * @param boolean|null $asc
     * 
     * @return $this
     * 
     * @since 18-02-15
     * @edit 18-12-24
     * - Handle null $asc value
     */
    public function addOrderBy($expr, $asc = true)
    {
        $tmpOrder;
        switch (true)
        {
            case \is_null($asc):
                $tmpOrder = "";
                break;
            case $asc:
                $tmpOrder = " ASC";
                break;
            default:
                $tmpOrder = " DESC";
                break;
        }
        $this->orderBy[] = "{$expr}{$tmpOrder}";
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
