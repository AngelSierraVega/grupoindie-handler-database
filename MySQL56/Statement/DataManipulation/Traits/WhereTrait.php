<?php

namespace GIndie\DBHandler\MySQL56\Statement\DataManipulation\Traits;

use GIndie\DBHandler\MySQL56\Statement\ExpressionSyntax;

/**
 * DVLP-DBHandler - whereTrait
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
 * @edit
 * - Created addCondition(), renderWhereClause(), $conditions
 * @version A0
 * @edit 18-05-03
 * - Moved file from [base_dir]\MySQL\Statement to [base_dir]\MySQL56\Statement\DataManipulation\Traits
 * - Updated namespace
 * - Updated trait name due to PSR-0 Violation
 * @version A1
 */
trait WhereTrait
{

    /**
     * 
     * @param array $expresion
     * @param string $concatOperator
     * 
     * @return $this
     * 
     * @since 18-02-15
     */
    public function addCondition($expresion, $concatOperator = "AND")
    {
        $this->conditions[] = [$concatOperator => $expresion];
        return $this;
    }

    /**
     * 
     * @param array $expresion
     * @param string $concatOperator
     * 
     * @return $this
     * 
     * @since 18-02-??
     */
    public function addConditionEquals($expr1, $expr2, $concatOperator = "AND")
    {
        $this->conditions[] = [$concatOperator => ExpressionSyntax::compEqual($expr1, $expr2)];
        return $this;
    }

    /**
     * 
     * @return string
     * 
     * @since 18-02-15
     */
    protected function renderWhereClause()
    {
        $rntStr = " WHERE";
        $index = 0;
        foreach ($this->conditions as $key => $value) {
            foreach ($value as $concatOperator => $expresion) {
                switch ($index)
                {
                    case 0:
                        $rntStr .= " " . $expresion;
                        break;
                    default:
                        $rntStr .= " " . $concatOperator . " " . $expresion;
                        break;
                }
            }
            $index++;
        }
        if ($index == 0) {
            $rntStr = "";
        }
        return $rntStr;
    }

    /**
     *
     * @var array 
     * @since 18-02-15
     */
    private $conditions = [];

}