<?php

/**
 * GI-DBHandler-DVLP - DataType
 *
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * @copyright (c) 2018 Angel Sierra Vega. Grupo INDIE.
 *
 * @package GIndie\DBHandler\MySQL57\Instance
 *
 * @version 00.70
 * @since 18-11-02
 * @todo Upgrade DocBlock
 */

namespace GIndie\DBHandler\MySQL57\Instance;

use GIndie\DBHandler\MySQL57\DataDefinition\DataTypes;
use GIndie\DBHandler\MySQL57\DataDefinition\Identifiers\Column;

/**
 * @edit 18-07-31
 * - Added params $datatype, $unzigned, $m, $zerofill
 * - Added integer(), __construct(), setM(), getM(), setUnzigned(), getUnzigned()
 * - Added settZerofill(), getZerofill()
 * @edit 18-08-01
 * - Renamed class from ColumnType to DataType
 * @edit 18-08-02
 * - Added blob()
 * @edit 18-08-16
 * - Updated methods.
 * @edit 18-08-26
 * - Added bigint(), serializedBigint()
 * @edit 18-09-02
 * - Updated decimal()
 * @edit 18-09-17
 * - Updated setValues() 
 * @edit 18-10-02
 * - Upgraded version
 * @edit 18-11-02
 * - Copied code from \GIndie\DBHandler\MySQL56\...
 */
class DataType implements DataTypes\Numeric, DataTypes\DateTime, DataTypes\StringDataTypes,
        Column\Definition\DataType
{

    /**
     * @since 18-08-26
     */
    public static function bigint($m, $unsigned = false, $zerofill = false)
    {
        $rntColumn = new DataType(static::DATATYPE_BIGINT);
        $rntColumn->setM($m);
        $rntColumn->setUnsigned($unsigned);
        $rntColumn->setZerofill($zerofill);
        return $rntColumn;
    }

    /**
     * Alias for BIGINT(20) UNSIGNED
     * @return \GIndie\DBHandler\MySQL57\Instance\DataType
     * @since 18-08-26
     */
    public static function serializedBigint()
    {
        $rtnData = static::bigint(20, true);
        return $rtnData;
    }

    /**
     * 
     * @param int|null $m
     * @since 18-08-02
     */
    public static function blob($m = null)
    {
        $rtnData = new DataType(static::DATATYPE_BLOB);
        $rtnData->setM($m);
        return $rtnData;
    }

    /**
     * 
     * @param null|int $fsp
     * @return \GIndie\DBHandler\MySQL57\Instance\DataType
     * 
     * @since 18-08-02
     */
    public static function timestamp($fsp = null)
    {
        $rtnData = new DataType(static::DATATYPE_TIMESTAMP);
        $rtnData->setFSP($fsp);
        return $rtnData;
    }

    /**
     * 
     * @param int $m
     * @param int $d
     * @param boolean $unsigned
     * @param boolean $zerofill
     * 
     * @return \GIndie\DBHandler\MySQL57\Instance\DataType
     * @since 18-08-01
     * @edit 18-09-02
     * - Added params $unsigned, $zerofill
     */
    public static function decimal($m = 10, $d = 0, $unsigned = false, $zerofill = false)
    {
        $rtnData = new DataType(static::DATATYPE_DECIMAL);
        $rtnData->setM($m)->setD($d);
        $rtnData->setUnsigned($unsigned);
        $rtnData->setZerofill($zerofill);
        return $rtnData;
    }

    /**
     * 
     * @param int $m
     * @param string|null $charsetName
     * @param string|null $collationName
     * 
     * @return \GIndie\DBHandler\MySQL57\Instance\DataType
     * @since 18-08-01
     */
    public static function char($m, $charsetName = null, $collationName = null)
    {
        $rtnData = new DataType(static::DATATYPE_CHAR);
        $rtnData->setM($m);
        $rtnData->setCharacterSet($charsetName);
        $rtnData->setCollation($collationName);
        return $rtnData;
    }

    /**
     * 
     * @return \GIndie\DBHandler\MySQL57\Instance\DataType
     * @since 18-08-01
     */
    public static function date()
    {
        $rtnData = new DataType(static::DATATYPE_DATE);
        return $rtnData;
    }

    /**
     * 
     * @param null|string $fsp 
     * 
     * @return \GIndie\DBHandler\MySQL57\Instance\DataType
     * @since 18-08-01
     */
    public static function datetime($fsp = null)
    {
        $rtnData = new DataType(static::DATATYPE_DATETIME);
        $rtnData->setFSP($fsp);
        return $rtnData;
    }

    /**
     * @return \GIndie\DBHandler\MySQL57\Instance\DataType
     * @since 18-08-01
     */
    public static function time($fsp = null)
    {
        $rtnData = new DataType(static::DATATYPE_TIME);
        $rtnData->setFSP($fsp);
        return $rtnData;
    }

    /**
     * 
     * @param array $values
     * @param null|string $charsetName
     * @param null|string $collationName
     * 
     * @return \GIndie\DBHandler\MySQL57\Instance\DataType
     * @since 18-08-01
     */
    public static function enum(array $values, $charsetName = null, $collationName = null)
    {
        $rtnData = new DataType(static::DATATYPE_ENUM);
        $rtnData->setValues($values);
        return $rtnData;
    }

    /**
     * 
     * @return \GIndie\DBHandler\MySQL57\Instance\DataType
     * @since 18-08-01
     */
    public static function serial()
    {
        $rtnData = new DataType(static::DATATYPE_SERIAL);
        return $rtnData;
    }

    /**
     * TEXT[(M)] [CHARACTER SET charset_name] [COLLATE collation_name]
     * 
     * 
     * @param int $m
     * @param string|null $charsetName
     * @param string|null $collationName
     * 
     * @return \GIndie\DBHandler\MySQL57\Instance\DataType
     * @since 18-08-01
     */
    public static function text($m = null, $charsetName = null, $collationName = null)
    {
        $rtnData = new DataType(static::DATATYPE_TEXT);
        $rtnData->setM($m);
        $rtnData->setCharacterSet($charsetName);
        $rtnData->setCollation($collationName);
        return $rtnData;
    }

    /**
     * @param int $m
     * @param boolean $unsigned
     * @param boolean $zerofill 
     * 
     * @return \GIndie\DBHandler\MySQL57\Instance\DataType
     * @since 18-08-01
     * @edit 18-08-16
     * - Upgraded use of setUnsigned()
     */
    public static function tinyint($m, $unsigned = false, $zerofill = false)
    {
        $rtnData = new DataType(static::DATATYPE_TINYINT);
        $rtnData->setM($m);
        $rtnData->setUnsigned($unsigned);
        $rtnData->setZerofill($zerofill);
        return $rtnData;
    }

    /**
     * @param int $m
     * @param string|null $charsetName
     * @param string|null $collationName
     * 
     * @return \GIndie\DBHandler\MySQL57\Instance\DataType
     * @since 18-08-01
     */
    public static function tinytext($m, $charsetName = null, $collationName = null)
    {
        $rtnData = new DataType(static::DATATYPE_TINYTEXT);
        $rtnData->setM($m);
        $rtnData->setCharacterSet($charsetName);
        $rtnData->setCollation($collationName);
        return $rtnData;
    }

    /**
     * 
     * @param int $m
     * @param string|null $charsetName
     * @param string|null $collationName
     * 
     * @return \GIndie\DBHandler\MySQL57\Instance\DataType
     * @since 18-08-01
     */
    public static function varchar($m, $charsetName = null, $collationName = null)
    {
        $rtnData = new DataType(static::DATATYPE_VARCHAR);
        $rtnData->setM($m);
        $rtnData->setCharacterSet($charsetName);
        $rtnData->setCollation($collationName);
        return $rtnData;
    }

    /**
     * 
     * @param null|boolean $m
     * @param null|boolean $unsigned
     * @param null|boolean $zerofill
     * @return \GIndie\DBHandler\MySQL57\Instance\DataType
     * @since 18-07-31
     * @edit 18-08-15
     * - use setUnsigned
     */
    public static function integer($m = null, $unsigned = false, $zerofill = false)
    {
        $rntColumn = new DataType(static::DATATYPE_INT);
        $rntColumn->setM($m);
        $rntColumn->setUnsigned($unsigned);
        $rntColumn->setZerofill($zerofill);
        return $rntColumn;
    }

    /**
     *
     * @var string 
     * @since 18-07-31
     */
    private $datatype;

    /**
     * 
     * @param string $datatype
     * @since 18-07-31
     */
    public function __construct($datatype)
    {
        $this->datatype = $datatype;
    }

    /**
     * 
     * @return string
     * @since 18-08-01
     */
    public function getDatatype()
    {
        return $this->datatype;
    }

    /**
     *
     * @var null|boolean 
     * @since 18-07-31
     */
    private $m;

    /**
     * 
     * @param int $m
     * @return \GIndie\DBHandler\MySQL57\Instance\DataType
     * @since 18-07-31
     * @edit 18-08-16
     * - Use of explicit $m
     */
    public function setM($m)
    {
        $this->m = $m;
        return $this;
    }

    /**
     * 
     * @return null|boolean 
     * @since 18-07-31
     */
    public function getM()
    {
        return $this->m;
    }

    /**
     *
     * @var null|int 
     * @since 18-07-31
     */
    private $d;

    /**
     * 
     * @param int $d
     * @return \GIndie\DBHandler\MySQL57\Instance\DataType
     * @since 18-07-31
     * @edit 18-08-16
     * - Use of explicit $d
     */
    public function setD($d)
    {
        $this->d = $d;
        return $this;
    }

    /**
     * 
     * @return null|boolean 
     * @since 18-07-31
     */
    public function getD()
    {
        return $this->d;
    }

    /**
     *
     * @var null|boolean 
     * @since 18-07-31
     */
    private $unsigned;

    /**
     * 
     * @param boolean $unsigned
     * @return \GIndie\DBHandler\MySQL57\Instance\DataType
     * @since 18-07-31
     * @edit 18-08-16
     * - Use of explicit $unsigned
     */
    public function setUnsigned($unsigned)
    {
        $this->unsigned = $unsigned;
        return $this;
    }

    /**
     * 
     * @return null|boolean 
     * @since 18-07-31
     */
    public function getUnsigned()
    {
        return $this->unsigned;
    }

    /**
     *
     * @var null|boolean 
     * @since 18-07-31
     */
    private $zerofill;

    /**
     * 
     * @param null|boolean $zerofill
     * @return GIndie\DBHandler\MySQL57\Instance\DataType
     * @since 18-07-31
     * @edit 18-08-16
     * - Use of explicit $zerofill
     */
    public function setZerofill($zerofill)
    {
        $this->zerofill = $zerofill;
        return $this;
    }

    /**
     * 
     * @return null|boolean 
     * @since 18-07-31
     */
    public function getZerofill()
    {
        return $this->zerofill;
    }

    /**
     *
     * @var string 
     * @since 18-08-01
     */
    private $charsetName;

    /**
     * 
     * @return string
     * @since 18-08-01
     */
    public function getCharsetName()
    {
        return $this->charsetName;
    }

    /**
     * 
     * @param string $charsetName
     * @return \GIndie\DBHandler\MySQL57\Instance\DataType
     */
    public function setCharacterSet($charsetName)
    {
        $this->charsetName = $charsetName;
        return $this;
    }

    /**
     *
     * @var string 
     * @since 18-08-01
     */
    private $collationName;

    /**
     * 
     * @return string
     * @since 18-08-01
     */
    public function getCollationName()
    {
        return $this->collationName;
    }

    /**
     * 
     * @param string $collationName
     * @since 18-08-01
     * @return \GIndie\DBHandler\MySQL57\Instance\DataType
     */
    public function setCollation($collationName)
    {
        $this->collationName = $collationName;
        return $this;
    }

    /**
     *
     * @var int 
     * @since 18-08-01
     */
    private $FSP;

    /**
     * 
     * @return int
     * @since 18-08-01
     */
    public function getFSP()
    {
        return $this->FSP;
    }

    /**
     * 
     * @param int $fsp
     * @return \GIndie\DBHandler\MySQL57\Instance\DataType
     * @since 18-08-01
     * @todo 
     * - From 0 to 6 or null
     */
    public function setFSP($fsp)
    {
        $this->FSP = $fsp;
        return $this;
    }

    /**
     *
     * @var array 
     * @since 18-08-01
     */
    private $values;

    /**
     * 
     * @return array
     * @since 18-08-01
     */
    public function getValues()
    {
        return $this->values;
    }

    /**
     * 
     * @param array $values
     * @return \GIndie\DBHandler\MySQL57\Instance\DataType
     * @since 18-08-01
     * @edit 18-09-17
     * - Added value format handling
     */
    public function setValues(array $values)
    {
        $this->values = [];
        foreach ($values as $value) {
            $this->values[] = "'{$value}'";
        }
        //$this->values = $values;
        return $this;
    }

}
