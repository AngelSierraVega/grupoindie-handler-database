<?php

/**
 * GI-DBHandler-DVLP - Table
 *
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * @copyright (c) 2018 Angel Sierra Vega. Grupo INDIE.
 *
 * @package GIndie\DBHandler\MySQL57\DataDefinition
 *
 * @version 00.90
 * @since 18-11-02
 * @todo Upgrade DocBlock to MySQL57
 */

namespace GIndie\DBHandler\MySQL57\DataDefinition\Identifiers;

/**
 * 
 * @edit 18-11-02
 * - Copied code from GIndie\DBHandler\MySQL56\...
 */
interface Table
{

    /**
     * tbl_name
     * 
     * @since 18-04-29
     */
    public static function name();

    /**
     * 
     * 
     * @since 18-04-29
     */
    public static function databaseName();

    /**
     * 
     * @return array
     * @since 18-04-27
     * @edit 18-04-30
     * - Defined attributes and return
     */
    public static function columns();

    /**
     * 
     * @param string $name
     * @param \GIndie\DBHandler\MySQL57\DataDefinition\Identifiers\Column\Definition\DataType $dataType
     * 
     * @return \GIndie\DBHandler\MySQL57\DataDefinition\Identifiers\Column
     * 
     * @since 18-04-27
     * @edit 18-04-30
     * - Defined attributes and return
     */
    public static function columnDefinition($name, Column\Definition\DataType $dataType);

    /**
     * [reference_definition] = ([keys] [constraints] [foreign_keys])
     * 
     * @since 18-04-30
     * @todo 
     * - Description
     * @return string
     */
    public static function referenceDefinition();
}
