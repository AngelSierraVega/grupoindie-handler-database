<?php

/**
 *
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * @copyright (c) 2018 Angel Sierra Vega. Grupo INDIE.
 *
 * @package GIndie\DBHandler\MySQL\Statement
 * @version 00.B0
 */

namespace GIndie\DBHandler\MySQL\Statement\Traits;

/**
 * DVLP-DBHandler - havingTrait
 * 
 * @link <https://dev.mysql.com/doc/refman/5.6/en/select.html>
 *
 *
 * @since 18-02-15 
 * @edit 18-02-15
 * - Created dummies renderHaving(), setHaving()
 * @edit 18-05-03
 * - Moved file from [base_dir]\MySQL\Statement to [base_dir]\MySQL56\Statement\DataManipulation\Traits
 * - Updated namespace
 * - Updated trait name due to PSR-0 Violation
 * 
 * @edit 18-05-05
 * - Return empty string on all methods.
 * @edit 18-10-02
 * - Upgraded version
 * @edit 18-11-02
 * - Moved from MySQL56\...
 * @edit 18-12-24
 * - Funciontal trait
 */
trait HavingTrait
{

    /**
     * 
     * @since 18-02-15
     * @edit 18-12-24
     * - Funciontal method
     */
    public function setHaving($expr)
    {
        $this->having[] = "{$expr}";
        return $this;
    }

    /**
     * 
     * @return string
     * @since 18-02-15
     * @edit 18-12-24
     * - Funciontal method
     */
    public function renderHaving()
    {
        return \count($this->having) == 0 ? "" : " HAVING " . \join(", ", $this->having);
    }

    /**
     *
     * @var array 
     * @since 18-12-24
     */
    private $having = [];

}
