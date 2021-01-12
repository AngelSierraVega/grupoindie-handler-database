<?php

/**
 * GI-DBHandler-DVLP - CommonMethods
 *
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * @copyright (CC) 2020 Angel Sierra Vega. Grupo INDIE.
 * @license file://LICENSE
 *
 * @package GIndie\DBHandler\MySQL57\Instance
 *
 * @version 00.B0
 * @since 18-11-11
 */

namespace GIndie\DBHandler\MySQL57\Instance\DataType;

use GIndie\DBHandler\MySQL57\DataDefinition\Identifiers\Column;

/**
 * Description of CommonMethods
 *
 * @edit 18-11-11
 * - Moved methods from Instance\DataType
 */
abstract class CommonMethods implements Column\Definition\DataType
{
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
     * @var array 
     * @since 18-11-07
     */
    private $valuesUnformatted;

    /**
     * 
     * @return array
     * @since 18-11-07
     */
    public function getValuesUnformatted()
    {
        return $this->valuesUnformatted;
    }

    /**
     * 
     * @param array $values
     * @return \GIndie\DBHandler\MySQL57\Instance\DataType
     * @since 18-08-01
     * @edit 18-09-17
     * - Added value format handling
     * @edit 18-11-07
     * - Use valuesUnformatted
     */
    public function setValues(array $values)
    {
        $this->values = [];
        $this->valuesUnformatted = $values;
        foreach ($values as $value) {
            $this->values[] = "'{$value}'";
        }
        return $this;
    }
}
