<?php

/**
 * GI-DBHandler-DVLP - DataType
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

namespace GIndie\DBHandler\MySQL57\DataDefinition\Identifiers\Column\Definition;

/**
 * 
 * @edit 18-11-02
 * - Copied code from GIndie\DBHandler\MySQL56\...
 */
interface DataType
{

    /**
     * @param int|null $m
     * @since 18-08-02
     */
    public static function blob($m = null);

    /**
     * @param int $m
     * @param boolean $unsigned
     * @param boolean $zerofill 
     * 
     * @since 18-02-14
     * - Added from \GIndie\DBHandler\MySQL\Table\Column
     * @edit 18-04-27
     * - Defined interface
     * @edit 18-04-30
     * - Added from \GIndie\DBHandler\MySQL56\DataDefinition\DataTypes\Numeric
     */
    public static function tinyint($m, $unsigned = false, $zerofill = false);

    /**
     * @param null|int $fsp
     * @since 18-08-02
     */
    public static function timestamp($fsp = null);

    /**
     * @param null|int $m
     * @param boolean $unsigned
     * @param boolean $zerofill 
     * 
     * @since 18-02-14
     * - Added from \GIndie\DBHandler\MySQL\Table\Column
     * @edit 18-04-27
     * - Defined interface
     * @edit 18-04-30
     * - Added from \GIndie\DBHandler\MySQL56\DataDefinition\DataTypes\Numeric
     */
    public static function integer($m = null, $unsigned = false, $zerofill = false);

    /**
     * @since 18-02-14
     * - Added from \GIndie\DBHandler\MySQL\Table\Column
     * @edit 18-04-27
     * - Defined interface
     * @edit 18-04-30
     * - Added from \GIndie\DBHandler\MySQL56\DataDefinition\DataTypes\Numeric
     */
    public static function serial();

    /**
     * @since 18-04-26
     * - Added from \GIndie\DBHandler\MySQL\Table\Column
     * @edit 18-04-30
     * - Added from \GIndie\DBHandler\MySQL56\DataDefinition\DataTypes\DateTime
     * @edit 18-08-01
     * - Added default null
     */
    public static function datetime($fsp = null);

    /**
     * @param int $m
     * @param int $d
     * @param boolean $unsigned
     * @param boolean $zerofill
     * 
     * @return \GIndie\DBHandler\MySQL56\Instance\DataType
     * @since 18-09-02
     */
    public static function decimal($m = 10, $d = 0, $unsigned = false, $zerofill = false);

    /**
     * @since 18-04-26
     * - Added from \GIndie\DBHandler\MySQL\Table\Column
     * @edit 18-04-30
     * - Added from \GIndie\DBHandler\MySQL56\DataDefinition\DataTypes\DateTime
     */
    public static function date();

    /**
     * @param int $m
     * @param string|null $charsetName
     * @param string|null $collationName
     * 
     * @since 18-02-14
     * - Added from \GIndie\DBHandler\MySQL\Table\Column
     * @edit 18-04-27
     * - Defined interface
     * @edit 18-04-30
     * - Added from \GIndie\DBHandler\MySQL56\DataDefinition\DataTypes\String
     */
    public static function char($m, $charsetName = null, $collationName = null);

    /**
     * @param int $m
     * @param string|null $charsetName
     * @param string|null $collationName
     * 
     * @since 18-02-14
     * - Added from \GIndie\DBHandler\MySQL\Table\Column
     * @edit 18-04-27
     * - Defined interface
     * @edit 18-04-30
     * - Added from \GIndie\DBHandler\MySQL56\DataDefinition\DataTypes\String
     */
    public static function varchar($m, $charsetName = null, $collationName = null);

    /**
     * @param int $m
     * @param string|null $charsetName
     * @param string|null $collationName
     * 
     * @since 18-02-14
     * - Added from \GIndie\DBHandler\MySQL\Table\Column
     * @edit 18-04-27
     * - Defined interface
     * @edit 18-04-30
     * - Added from \GIndie\DBHandler\MySQL56\DataDefinition\DataTypes\String
     */
    public static function tinytext($m, $charsetName = null, $collationName = null);

    /**
     * @param int|null $m
     * @param string|null $charsetName
     * @param string|null $collationName
     * 
     * @since 18-02-14
     * - Added from \GIndie\DBHandler\MySQL\Table\Column
     * @edit 18-04-27
     * - Defined interface
     * @edit 18-04-30
     * - Added from \GIndie\DBHandler\MySQL56\DataDefinition\DataTypes\string
     * @edit 18-08-15
     * - Default null value for $m
     */
    public static function text($m = null, $charsetName = null, $collationName = null);

    /**
     * @param array $values
     * @param null|string $charsetName
     * @param null|string $collationName
     * 
     * @since 18-02-14
     * - Added from \GIndie\DBHandler\MySQL\Table\Column
     * @edit 18-04-27
     * - Defined interface
     * @edit 18-04-30
     * - Added from \GIndie\DBHandler\MySQL56\DataDefinition\DataTypes\string
     */
    public static function enum(array $values, $charsetName = null, $collationName = null);

    /**
     * @since 18-04-30
     * @return string
     */
    public function getDatatype();

    /**
     * @since 18-04-30
     * @return int
     */
    public function getM();

    /**
     * 
     * @since 18-04-30
     * @return boolean
     */
    public function getUnsigned();

    /**
     * 
     * @since 18-04-30
     * @return boolean
     */
    public function getZerofill();

    /**
     * @since 18-04-30
     * 
     * @return string
     */
    public function getFSP();

    /**
     * 
     * @since 18-04-30
     * @return string
     */
    public function getCharsetName();

    /**
     * 
     * @since 18-04-30
     * @return string
     */
    public function getCollationName();

    /**
     * 
     * @since 18-04-30
     * @return array
     */
    public function getValues();

    /**
     * @since 18-04-30
     * @param int $m
     */
    public function setM($m);

    /**
     * @since 18-04-30
     * @param type $unsigned
     */
    public function setUnsigned($unsigned);

    /**
     * @since 18-04-30
     * @param boolean $zerofill
     */
    public function setZerofill($zerofill);

    /**
     * @since 18-04-30
     * @param int $fsp
     */
    public function setFSP($fsp);

    /**
     * @since 18-04-30
     * @param string $charsetName
     */
    public function setCharacterSet($charsetName);

    /**
     * 
     * @param string $collationName
     */
    public function setCollation($collationName);

    /**
     * 
     * @param array $values
     */
    public function setValues(array $values);

    /**
     * 
     * @param int $d
     * @since 18-08-01
     */
    public function setD($d);
}
