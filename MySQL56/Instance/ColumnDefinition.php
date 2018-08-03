<?php

/**
 * GI-DBHandler-DVLP - ColumnDefinition
 *
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * @copyright (c) 2018 Angel Sierra Vega. Grupo INDIE.
 *
 * @package GIndie\DBHandler\MySQL56\Instance
 *
 * @version 0A.80
 * @since 18-04-30
 */

namespace GIndie\DBHandler\MySQL56\Instance;

/**
 * @edit 18-05-01
 * - Added methods from defined interterface(s)
 * @edit 18-05-15
 * - Class implements \GIndie\DBHandler\MySQL56\DataDefinition\Identifiers\Column\Definition
 * - Added code from temp class Column
 * @todo 
 * - Functional class
 */
class ColumnDefinition
        implements \GIndie\DBHandler\MySQL56\DataDefinition\Identifiers\Column\Definition
{
    /**
     * @todo private vars
     * columnFormat
     * storage
     */

    /**
     *
     * @var array
     * @since 18-08-18
     */
    private $indexes = [];

    /**
     * 
     * @param string $index
     * @since 18-08-18
     */
    public function addIndex($index)
    {
        $this->indexes[] = $index;
    }

    /**
     *
     * @var \GIndie\DBHandler\MySQL56\Instance\DataType
     * @since 18-08-15
     */
    private $dataType;

    /**
     * Once defined the table and the column name, [this class] defines the specification
     * of a Column.
     * 
     * @link <https://dev.mysql.com/doc/refman/5.6/en/create-table.html#create-table-types-attributes>
     * 
     * @param \GIndie\DBHandler\MySQL56\DataDefinition\Column\Definition\DataType $dataType 
     * Represents the data type in a column definition. spatial_type represents
     * a spatial data type. The data type syntax shown is representative only. For a full 
     * description of the syntax available for specifying column data types, as well as 
     * information about the properties of each type, see Chapter 11, Data Types, and 
     * Section 11.5, “Spatial Data Types”.
     * 
     * @since 18-05-01
     * - Added from \GIndie\DBHandler\MySQL56\DataDefinition\Column\Definition
     * @edit 18-08-15
     * - Functional method
     */
    public function __construct(\GIndie\DBHandler\MySQL56\Instance\DataType $dataType)
    {
        $this->dataType = $dataType;
    }

    /**
     * 
     * @return \GIndie\DBHandler\MySQL56\DataDefinition\Column\Definition\DataType
     * @since 18-08-20
     */
    public function getDataType()
    {
        return $this->dataType;
    }

    /**
     *
     * @var boolean 
     * @since 18-08-15
     */
    private $notNull;

    /**
     * If neither NULL nor NOT NULL is specified, the column is treated as though NULL had 
     * been specified.
     * 
     * @param boolean $value 
     * @return \Self
     * 
     * @since 18-05-01
     * - Added from \GIndie\DBHandler\MySQL56\DataDefinition\Column\Definition
     * @edit 18-08-15
     * - Functional method
     */
    public function setNotNull($value = true)
    {
        $this->notNull = $value;
        return $this;
    }

    /**
     *
     * @var string 
     * @since 18-08-15
     */
    private $default;

    /**
     * Specifies a default value for a column. With one exception, the default value must be a 
     * constant; it cannot be a function or an expression. This means, for example, that you 
     * cannot set the default for a date column to be the value of a function such as NOW() or 
     * CURRENT_DATE. The exception is that you can specify CURRENT_TIMESTAMP as the default for 
     * a TIMESTAMP or DATETIME column. See Section 11.3.5, “Automatic Initialization and Updating 
     * for TIMESTAMP and DATETIME”.
     * 
     * If a column definition includes no explicit DEFAULT value, MySQL determines the default 
     * value as described in Section 11.6, “Data Type Default Values”.
     * 
     * BLOB and TEXT columns cannot be assigned a default value.
     * 
     * @param mixed $value 
     * @return \Self
     * 
     * @since 18-05-01
     * - Added from \GIndie\DBHandler\MySQL56\DataDefinition\Column\Definition
     * @edit 18-08-15
     * - Functional method
     */
    public function setDefaultValue($value)
    {
        $this->default = $value;
        return $this;
    }

    /**
     *
     * @var boolean 
     * @since 18-08-15
     */
    private $autoincrement;

    /**
     * An integer or floating-point column can have the additional attribute AUTO_INCREMENT. 
     * When you insert a value of NULL (recommended) or 0 into an indexed AUTO_INCREMENT 
     * column, the column is set to the next sequence value. Typically this is value+1, where 
     * value is the largest value for the column currently in the table. AUTO_INCREMENT 
     * sequences begin with 1.
     * 
     * To retrieve an AUTO_INCREMENT value after inserting a row, use the LAST_INSERT_ID() 
     * SQL function or the mysql_insert_id() C API function. See Section 12.14, 
     * “Information Functions”, and Section 23.8.7.37, “mysql_insert_id()”.
     * 
     * If the NO_AUTO_VALUE_ON_ZERO SQL mode is enabled, you can store 0 in AUTO_INCREMENT 
     * columns as 0 without generating a new sequence value. See Section 5.1.10, 
     * “Server SQL Modes”.
     * 
     * There can be only one AUTO_INCREMENT column per table, it must be indexed, and it 
     * cannot have a DEFAULT value. An AUTO_INCREMENT column works properly only if it 
     * contains only positive values. Inserting a negative number is regarded as inserting 
     * a very large positive number. This is done to avoid precision problems when numbers 
     * “wrap” over from positive to negative and also to ensure that you do not accidentally 
     * get an AUTO_INCREMENT column that contains 0.
     * 
     * @param boolean $value 
     * @return \Self
     * 
     * @since 18-05-01
     * - Added from \GIndie\DBHandler\MySQL56\DataDefinition\Column\Definition
     * @edit 18-08-15
     * - Functional method
     */
    public function setAutoIncrement($value = true)
    {
        $this->autoincrement = $value;
        return $this;
    }

    /**
     *
     * @var type 
     * @since 18-08-15
     */
    private $comment;

    /**
     * A comment for a column can be specified with the COMMENT option, up to 1024 characters 
     * long. The comment is displayed by the SHOW CREATE TABLE and SHOW FULL COLUMNS statements.
     * 
     * @param string $comment 
     * @return \Self
     * 
     * @since 18-05-01
     * - Added from \GIndie\DBHandler\MySQL56\DataDefinition\Column\Definition
     * @edit 18-08-15
     * - Functional method
     */
    public function setComment($comment)
    {
        $this->comment = $comment;
        return $this;
    }

    /**
     * @return boolean
     * 
     * @since 18-05-01
     * - Added from \GIndie\DBHandler\MySQL56\DataDefinition\Column\Definition
     * @edit 18-08-15
     * - Functional method
     */
    public function getNotNull()
    {
        return $this->notNull;
    }

    /**
     * BLOB and TEXT columns cannot be assigned a default value.
     * 
     * @return mixed
     * 
     * @since 18-05-01
     * - Added from \GIndie\DBHandler\MySQL56\DataDefinition\Column\Definition
     * @edit 18-08-15
     * - Functional method
     */
    public function getDefaultValue()
    {
        return $this->default;
    }

    /**
     * An integer or floating-point column can have the additional attribute AUTO_INCREMENT. 
     * 
     * @return boolean
     * 
     * @since 18-05-01
     * - Added from \GIndie\DBHandler\MySQL56\DataDefinition\Column\Definition
     * @edit 18-08-15
     * - Functional method
     */
    public function getAutoIncrement()
    {
        return $this->autoincrement;
    }

    /**
     * @return string
     * 
     * @since 18-05-01
     * - Added from \GIndie\DBHandler\MySQL56\DataDefinition\Column\Definition
     * @edit 18-08-15
     * - Functional method
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * @return string
     * @since 18-08-16
     * @edit 18-08-18
     * - Added render of indexes
     * - Added NOT NULL
     * - Added AUTOINCREMENT
     */
    public function getColumnDefinition()
    {
        $rtnStr = $this->dataType->getDatatype();

        switch ($this->dataType->getDatatype())
        {
            case DataType::DATATYPE_INT:
            case DataType::DATATYPE_TINYINT:
                $rtnStr .= !\is_null($this->dataType->getM()) ? "({$this->dataType->getM()})" : "";
                $rtnStr .= ($this->dataType->getUnsigned()) ? " UNSIGNED" : "";
                $rtnStr .= ($this->dataType->getZerofill()) ? " ZEROFILL" : "";
                break;
            case DataType::DATATYPE_TIMESTAMP:
            case DataType::DATATYPE_TIME:
                $rtnStr .= !\is_null($this->dataType->getFSP()) ? "({$this->dataType->getFSP()})" : "";
                break;
            case DataType::DATATYPE_DECIMAL:
                $rtnStr .= "({$this->dataType->getM()},{$this->dataType->getD()})";
                break;
            case DataType::DATATYPE_VARCHAR:
                $rtnStr .= "({$this->dataType->getM()})";
                $rtnStr .= !\is_null($this->dataType->getCharsetName()) ? " CHARACTER SET {$this->dataType->getCharsetName()}" : "";
                $rtnStr .= !\is_null($this->dataType->getCollationName()) ? " COLLATE {$this->dataType->getCollationName()}" : "";
                break;
            default:
                break;
        }
        if ($this->getNotNull() === true) {
            $rtnStr .= " NOT NULL ";
        }
        if ($this->getAutoIncrement() === true) {
            $rtnStr .= " AUTO_INCREMENT ";
        }
        if (\array_count_values($this->indexes) > 0) {
            $rtnStr .= " " . \join(" ", $this->indexes);
        }
        return $rtnStr;
    }

}
