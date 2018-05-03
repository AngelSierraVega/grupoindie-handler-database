<?php

namespace GIndie\DBHandler\MySQL56\Statement\DataManipulation\Traits;

/**
 * DVLP-DBHandler - havingTrait
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
 * - Created dummies renderHaving(), setHaving()
 * @version 00
 * @edit 18-05-03
 * - Moved file from [base_dir]\MySQL\Statement to [base_dir]\MySQL56\Statement\DataManipulation\Traits
 * - Updated namespace
 * - Updated trait name due to PSR-0 Violation
 * @version 00.01
 * @edit 18-05-05
 * - Return empty string on all methods.
 * @version 00.02
 */
trait HavingTrait
{

    /**
     * 
     * @since 18-02-15
     * @todo
     */
    public function setHaving()
    {
        return "";
    }

    /**
     * 
     * @return string
     * @since 18-02-15
     */
    public function renderHaving()
    {
        return "";
    }

}
