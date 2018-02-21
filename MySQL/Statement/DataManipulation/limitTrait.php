<?php

namespace GIndie\DBHandler\MySQL\Statement\DataManipulation;

/**
 * DVLP-DBHandler - limitTrait
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
 * - Created renderLimit(), setLimit(), $limit
 */
trait limitTrait
{

    /**
     * 
     * @return string
     * 
     * @since GI-DBH.00.01
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
     * @since GI-DBH.00.01
     */
    public function setLimit($rowCount, $offset = null)
    {
        $this->limit = $offset == null ? $rowCount : "{$rowCount} OFFSET {$offset}";
        return $this;
    }

    /**
     *
     * @var array 
     * @since GI-DBH.00.01
     */
    private $limit;

}
