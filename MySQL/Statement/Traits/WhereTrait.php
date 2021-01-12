<?php

/**
 * GI-DBHandler-DVLP - WhereTrait
 *
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * @copyright (CC) 2020 Angel Sierra Vega. Grupo INDIE.
 * @license file://LICENSE
 *
 * @package GIndie\DBHandler\MySQL\Statement
 *
 * @version 00.A0
 * @since 18-02-15
 * @todo Resolve ExpressionSyntax
 */

namespace GIndie\DBHandler\MySQL\Statement\Traits;

use GIndie\DBHandler\MySQL56\Statement\ExpressionSyntax;

/**
 * 
 * @link <https://dev.mysql.com/doc/refman/5.6/en/select.html>

 * @edit 18-02-15
 * - Created addCondition(), renderWhereClause(), $conditions
 * @edit 18-05-03
 * - Moved file from [base_dir]\MySQL\Statement to [base_dir]\MySQL56\Statement\DataManipulation\Traits
 * - Updated namespace
 * - Updated trait name due to PSR-0 Violation
 * @edit 18-10-01
 * - Created addConditionIsNull()
 * @edit 18-10-02
 * - Upgraded version
 * @edit 18-11-02
 * - Moved from MySQL56\...
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
     * @param array $expresion
     * @param string $concatOperator
     * 
     * @return $this
     * 
     * @since 19-01-06
     */
    public function addConditionDiff($expr1, $expr2, $concatOperator = "AND")
    {
        $this->conditions[] = [$concatOperator => ExpressionSyntax::compDiff($expr1, $expr2)];
        return $this;
    }

    /**
     * 
     * @param mixed $expr1
     * @param string $concatOperator
     * @return $this
     * @since 18-10-01
     */
    public function addConditionIsNull($expr1, $concatOperator = "AND")
    {
        $this->conditions[] = [$concatOperator => ExpressionSyntax::boolIsNull($expr1)];
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
