<?php

namespace GIndie\DBHandler\MySQL\Statement;

/**
 * DVLP-DBHandler - ExpressionSyntax
 * 
 * @link <https://dev.mysql.com/doc/refman/5.7/en/expressions.html>
 *
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * @copyright (c) 2018 Angel Sierra Vega. Grupo INDIE.
 *
 * @package DatabaseHandler
 *
 * @version GI-DBH.00.00 18-02-15 Empty class created.
 * @edit GI-DBH.00.01
 * - Added comparison methods
 * - Added expresion methods
 */
class ExpressionSyntax
{
    /**
     * @todo
     * expr || expr
     * expr XOR expr
     * 
     * expr && expr
     * NOT expr
     * ! expr
     * boolean_primary IS [NOT] {TRUE | FALSE | UNKNOWN}
     *  boolean_primary
     */

    /**
     * 
     * expresion: expr OR expr
     * 
     * @param mixed $expr
     * @param mided $expr2
     * 
     * @return string
     * 
     * @since GI-DBH.00.01
     */
    public static function exprOR($expr, $expr2)
    {
        return "{$expr} OR {$expr2}";
    }

    /**
     * 
     * expresion: expr AND expr
     * 
     * @param mixed $expr
     * @param mided $expr2
     * 
     * @return string
     * 
     * @since GI-DBH.00.01
     */
    public static function exprAND($expr, $expr2)
    {
        return "{$expr} AND {$expr2}";
    }

    /**
     * 
     * comparison_operator: =
     * 
     * @param mixed $expr
     * @param mided $expr2
     * 
     * @return string
     * 
     * @since GI-DBH.00.01
     */
    public static function compEqual($expr, $expr2)
    {
        return "{$expr} = {$expr2}";
    }

    /**
     * 
     * comparison_operator: >=
     * 
     * @param mixed $expr
     * @param mided $expr2
     * 
     * @return string
     * 
     * @since GI-DBH.00.01
     */
    public static function compEqualOrMayor($expr, $expr2)
    {
        return "{$expr} >= {$expr2}";
    }

    /**
     * 
     * comparison_operator: >
     * 
     * @param mixed $expr
     * @param mided $expr2
     * 
     * @return string
     * 
     * @since GI-DBH.00.01
     */
    public static function compMayor($expr, $expr2)
    {
        return "{$expr} > {$expr2}";
    }

    /**
     * 
     * comparison_operator: <=
     * 
     * @param mixed $expr
     * @param mided $expr2
     * 
     * @return string
     * 
     * @since GI-DBH.00.01
     */
    public static function compEqualOrMinor($expr, $expr2)
    {
        return "{$expr} <= {$expr2}";
    }

    /**
     * 
     * comparison_operator: <
     * 
     * @param mixed $expr
     * @param mided $expr2
     * 
     * @return string
     * 
     * @since GI-DBH.00.01
     */
    public static function compMinor($expr, $expr2)
    {
        return "{$expr} < {$expr2}";
    }

    /**
     * 
     * comparison_operator: !=
     * 
     * @param mixed $expr
     * @param mided $expr2
     * 
     * @return string
     * 
     * @since GI-DBH.00.01
     */
    public static function compDiff($expr, $expr2)
    {
        return "{$expr} != {$expr2}";
    }

    /**
     * @todo
     * - comparison_operator: <>
     */
}
