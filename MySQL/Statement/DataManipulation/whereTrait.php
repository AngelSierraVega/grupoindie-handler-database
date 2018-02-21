<?php

namespace GIndie\DBHandler\MySQL\Statement\DataManipulation;

use GIndie\DBHandler\MySQL\Statement\ExpressionSyntax;

/**
 * DVLP-DBHandler - whereTrait
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
 * - Created addCondition(), renderWhereClause(), $conditions
 */
trait whereTrait
{

    /**
     * 
     * @param array $expresion
     * @param string $concatOperator
     * 
     * @return $this
     * 
     * @since GI-DBH.00.01
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
     * @since GI-DBH.00.02
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
     * @since GI-DBH.00.01
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
     * @since GI-DBH.00.01
     */
    private $conditions = [];

}
