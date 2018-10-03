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
 * DVLP-DBHandler - limitTrait
 * 
 * @link <https://dev.mysql.com/doc/refman/5.6/en/select.html>
 *
 * @since 18-02-15
 * @edit 18-02-15
 * - Created renderLimit(), setLimit(), $limit
 * @version A0
 * @edit 18-05-03
 * - Moved file from [base_dir]\MySQL\Statement to [base_dir]\MySQL56\Statement\DataManipulation\Traits
 * - Updated namespace
 * - Updated trait name for PSR-0 Violation
 * @version 00.AA
 * @edit 18-10-02
 * - Upgraded version
 * @edit 18-11-02
 * - Moved from MySQL56\...
 */
trait LimitTrait
{

    /**
     * 
     * @return string
     * 
     * @since 18-02-15
     */
    protected function renderLimit()
    {
        return !isset($this->limit) ? "" : " LIMIT " . $this->limit;
    }

    /**
     * 
     * @param int $selectors
     * @param null|int $offset
     * 
     * @return $this
     * 
     * @since 18-02-15
     */
    public function setLimit($rowCount, $offset = null)
    {
        $this->limit = $offset == null ? $rowCount : "{$rowCount} OFFSET {$offset}";
        return $this;
    }

    /**
     *
     * @var array 
     * @since 18-02-15
     */
    private $limit;

}
