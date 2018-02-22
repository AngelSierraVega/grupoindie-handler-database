<?php

namespace GIndie\DBHandler\MySQL;

/**
 * DVLP-DBHandler - Table
 *
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * @copyright (c) 2018 Angel Sierra Vega. Grupo INDIE.
 *
 * @package DatabaseHandler
 *
 * @version GI-DBH.00.00 18-02-14 Empty class created.
 * @edit GI-DBH.00.01 18-02-15
 * - Abstract class
 * - Class implements \GIndie\DBHandler\Interfaces\Table
 * @edit GI-DBH.00.02 18-02-22
 * - Created getAssocByAttribute(), getAssocById()
 */
abstract class Table implements \GIndie\DBHandler\Interfaces\Table
{

    /**
     * 
     * @return string
     * @since GI-DBH.00.01
     */
    public static function schemaName()
    {
        $schema = static::schema();
        return $schema::name();
    }

    /**
     * 
     * @return \GIndie\DBHandler\MySQL\Statement\Select
     * @since GI-DBH.00.01
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
     * @since GI-DBH.00.02
     */
    public static function getAssocByAttribute($attributeName, $attributeValue)
    {
        $rtnArray = null;
        $Select = static::stmSelect();
        $Select->addConditionEquals($attributeName, $attributeValue);
        $Query = \GIndie\DBHandler\MySQL::query($Select);
        switch ($Query->num_rows)
        {
            case 0:
                break;
            default:
                $rtnArray = $Query->fetch_assoc();
        }
        return $rtnArray;
    }

    /**
     * 
     * @param mixed $id
     * @return array
     * 
     * @since GI-DBH.00.02
     */
    public static function getAssocById($id)
    {
        return static::getAssocByAttribute(static::primaryKeyName(), $id);
    }

}
