<?php

/**
 * GI-DBHandler-DVLP - ExpressionSyntax
 *
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * @copyright (CC) 2020 Angel Sierra Vega. Grupo INDIE.
 * @license file://LICENSE
 *
 * @package GIndie\DBHandler\MySQL56\Statement
 *
 * @version 00.AA
 * @since 18-02-15
 */

namespace GIndie\DBHandler\MySQL56\Statement;

/**
 * @link <https://dev.mysql.com/doc/refman/5.7/en/expressions.html>
 * 
 * @edit 18-02-15
 * - Added comparison methods
 * - Added expresion methods
 * @edit 18-02-17
 * - Updated compEqual()
 * @edit 18-05-03
 * - Moved file from [base_dir]\MySQL\Statement to [base_dir]\MySQL56\Statement
 * - Updated namespace
 * @edit 18-10-01
 * - Added boolean_primary IS NULL
 * @edit 18-10-02
 * - Upgraded version
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
 * boolean_primary:
 *  - boolean_primary IS NOT NULL
 *  - boolean_primary <=> predicate
 *  - boolean_primary comparison_operator predicate
 *  - boolean_primary comparison_operator {ALL | ANY} (subquery)
 *  - predicate
 * 
 */
class ExpressionSyntax
{

    /**
     * 
     * @param mixed $expr
     * @return string
     * @since 18-10-01
     */
    public static function boolIsNull($expr)
    {
        return "{$expr} IS NULL";
    }

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
     * @edit 18-08-30
     * - Handle NULL clase on $expr2
     */
    public static function compEqual($expr, $expr2)
    {
        switch (true)
        {
            case (\is_null($expr2) === true):
                $expr2 = "NULL";
                break;
            case (\is_string($expr2) === true):
                $expr2 = "'{$expr2}'";
                break;
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
     * @edit 19-06-01
     * - Handle string on $expr2
     */
    public static function compDiff($expr, $expr2)
    {
        switch (true)
        {
            case (\is_string($expr2) === true):
                $expr2 = "'{$expr2}'";
                break;
        }
        return "{$expr} != {$expr2}";
    }

}
