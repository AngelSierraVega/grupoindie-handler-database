<?php

namespace GIndie\DBHandler\MySQL;

/**
 * DVLP-DBHandler - Table
 *
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * @copyright (c) 2018 Angel Sierra Vega. Grupo INDIE.
 *
 * @package GIndie\DBHandler\Deprecated
 *
 * @since 18-02-14
 * @version 00
 * @edit 18-02-15
 * - Abstract class
 * - Class implements \GIndie\DBHandler\Interfaces\Table
 * @edit 18-02-22
 * - Created getAssocByAttribute(), getAssocById()
 * @version A0
 * @deprecated since 18-05-02
 * @edit 18-05-02
 * - Moved file from [base_dir]\MySQL to [base_dir]\Deprecated\MySQL
 * @version 0A.10
 * @edit 18-05-05
 * - Error handling on getAssocByAttribute()
 * @version 0A.10
 */
abstract class Table implements \GIndie\DBHandler\Interfaces\Table
{

    /**
     * 
     * @return string
     * @since 18-02-15
     * @deprecated since 18-05-02
     */
    public static function schemaName()
    {
        $schema = static::schema();
        return $schema::name();
    }

    /**
     * 
     * @return \GIndie\DBHandler\MySQL\Statement\Select
     * @since 18-02-15
     * @deprecated since 18-05-02
     */
    public static function stmSelect()
    {
        return Statement::select(["*"], [static::schemaName() => static::name()]);
    }

    /**
     * 
     * @param string $attributeName
     * @param mixed $attributeValue
     * @return array
     * 
     * @since 18-02-22
     * @deprecated since 18-05-02
     * @edit 18-05-05
     * - Simple error handling
     */
    public static function getAssocByAttribute($attributeName, $attributeValue)
    {
        $rtnArray = null;
        $Select = static::stmSelect();
        $Select->addConditionEquals($attributeName, $attributeValue);
        $Query = \GIndie\DBHandler\MySQL::query($Select);
        if ($Query) {
            switch ($Query->num_rows)
            {
                case 0:
                    break;
                default:
                    $rtnArray = $Query->fetch_assoc();
            }
        }else{
            \trigger_error(\GIndie\DBHandler\MySQL::getConnection()->error, \E_USER_ERROR);
        }
        return $rtnArray;
    }

    /**
     * 
     * @param mixed $id
     * @return array
     * 
     * @since 18-02-22
     * @deprecated since 18-05-02
     */
    public static function getAssocById($id)
    {
        return static::getAssocByAttribute(static::primaryKeyName(), $id);
    }

}
