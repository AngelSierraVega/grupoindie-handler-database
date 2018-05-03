<?php

namespace GIndie\DBHandler\MySQL56\Statement;

/**
 * DVLP-DBHandler - ExpressionSyntax
 * 
 * @link <https://dev.mysql.com/doc/refman/5.7/en/expressions.html>
 *
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * @copyright (c) 2018 Angel Sierra Vega. Grupo INDIE.
 *
 * @package DatabaseHandler
 * @subpackage MySQL56
 *
 * @since 18-02-15
 * @edit 
 * - Added comparison methods
 * - Added expresion methods
 * @version 00
 * @edit 18-02-17
 * - Updated compEqual()
 * @version A0
 * @edit 18-05-03
 * - Moved file from [base_dir]\MySQL\Statement to [base_dir]\MySQL56\Statement
 * - Updated namespace
 * @version A1
 * @todo Implement expresions
 * expr || expr
 * expr XOR expr
 * expr && expr
 * NOT expr
 * ! expr
 * boolean_primary IS [NOT] {TRUE | FALSE | UNKNOWN}
 *  boolean_primary
 * - comparison_operator: <>
 * 
 */
class ExpressionSyntax
{

    /**
     * 
     * expresion: expr OR expr
     * 
     * @param mixed $expr
     * @param mided $expr2
     * 
     * @return string
     * 
     * @since 18-02-15
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
     * @since 18-02-15
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
     * @since 18-02-15
     * @edit 18-02-17
     * - Handle string case on $expr2
     */
    public static function compEqual($expr, $expr2)
    {
        switch (\is_string($expr2))
        {
            case true:
                $expr2 = "'{$expr2}'";
        }
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
     * @since 18-02-15
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
     * @since 18-02-15
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
     * @since 18-02-15
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
     * @since 18-02-15
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
     * @since 18-02-15
     */
    public static function compDiff($expr, $expr2)
    {
        return "{$expr} != {$expr2}";
    }

}
