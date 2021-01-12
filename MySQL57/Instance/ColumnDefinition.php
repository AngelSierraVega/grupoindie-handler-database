<?php

/**
 * GI-DBHandler-DVLP - ColumnDefinition
 *
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * @copyright (CC) 2020 Angel Sierra Vega. Grupo INDIE.
 * @license file://LICENSE
 *
 * @package GIndie\DBHandler\MySQL57\Instance
 *
 * @version 00.76
 * @since 18-10-03
 */

namespace GIndie\DBHandler\MySQL57\Instance;

use GIndie\DBHandler\MySQL57;

/**
 * 
 *
 * @link <https://dev.mysql.com/doc/refman/5.7/en/create-table.html>
 * 
 * column_definition:
 * data_type [NOT NULL | NULL] [DEFAULT default_value]
 *    [AUTO_INCREMENT] [UNIQUE [KEY]] [[PRIMARY] KEY]
 *     [COMMENT 'string']
 *     [COLUMN_FORMAT {FIXED|DYNAMIC|DEFAULT}]
 *     [STORAGE {DISK|MEMORY|DEFAULT}]
 *     [reference_definition]
 * | data_type [GENERATED ALWAYS] AS (expression)
 *     [VIRTUAL | STORED] [NOT NULL | NULL]
 *     [UNIQUE [KEY]] [[PRIMARY] KEY]
 *     [COMMENT 'string']
 * @edit 19-12-20
 * - Added getDataTypeName()
 */
class ColumnDefinition implements MySQL57\DataDefinition\Identifiers\Column\Definition
{

    /**
     *
     * @var array
     * @since 18-08-18
     * @deprecated since 18-08-26
     */
    private $indexes = [];

    /**
     * 
     * @param string $index
     * @since 18-08-18
     * @deprecated since 18-08-26
     */
    public function addIndex($index)
    {
        $this->indexes[] = $index;
    }

    /**
     *
     * @var \GIndie\DBHandler\MySQL57\Instance\DataType
     * @since 18-08-15
     */
    private $dataType;

    /**
     * @param \GIndie\DBHandler\MySQL57\DataDefinition\Column\Definition\DataType $dataType 
     * 
     * @since 18-05-01
     * @edit 18-08-15
     * - Functional method
     */
    public function __construct(\GIndie\DBHandler\MySQL57\Instance\DataType $dataType)
    {
        $this->dataType = $dataType;
    }

    /**
     * 
     * @return \GIndie\DBHandler\MySQL57\DataDefinition\Column\Definition\DataType
     * @since 18-08-20
     */
    public function getDataType()
    {
        return $this->dataType;
    }

    /**
     * Returns the datatype name of the column definition
     * 
     * @return string
     * @since 19-12-20
     */
    public function getDataTypeName()
    {
        return $this->dataType->getDatatype();
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
     * @edit 18-08-26
     * - Deprecated indexes
     * - Handle DataType::DATATYPE_BIGINT 
     * @edit 18-09-02
     * - Added COMMENT
     * @edit 18-10-02
     * - Exploded content into getColumnDefinitionDataType(),
     *   getColumnDefinitionDefault(), getColumnDefinitionComment()
     * 
     * data_type [NOT NULL | NULL] [DEFAULT default_value]
     *    [AUTO_INCREMENT] [UNIQUE [KEY]] [[PRIMARY] KEY]
     *     [COMMENT 'string']
     *     [COLUMN_FORMAT {FIXED|DYNAMIC|DEFAULT}]
     *     [STORAGE {DISK|MEMORY|DEFAULT}]
     *     [reference_definition]
     * |
     * data_type [GENERATED ALWAYS] AS (expression)
     *     [VIRTUAL | STORED] [NOT NULL | NULL]
     *     [UNIQUE [KEY]] [[PRIMARY] KEY]
     *     [COMMENT 'string']
     * 
     * @return string
     * @since 18-10-11
     * @todo Validate use of NOT NULL
     */
    public function getColumnDefinition()
    {
        if (isset($this->generated)) {
            $rtnStr = $this->getColumnDefinitionDataType();
            $rtnStr .= " GENERATED ALWAYS AS " . $this->expression;
            $rtnStr .= " " . $this->generated;
//            if ($this->getNotNull() === true) {
//                $rtnStr .= " NOT NULL";
//            }
            $rtnStr .= $this->getColumnDefinitionComment();
        } else {
            $rtnStr = $this->getColumnDefinitionDataType();
            if ($this->getNotNull() === true) {
                $rtnStr .= " NOT NULL";
            }
            $rtnStr .= $this->getColumnDefinitionDefault();
            if ($this->getAutoIncrement() === true) {
                $rtnStr .= " AUTO_INCREMENT";
            }
            $rtnStr .= $this->getColumnDefinitionComment();
        }
        return $rtnStr;
    }

    /**
     * 
     * @return string
     * @since 18-10-02
     * @edit 18-11-04
     * - Handle DATATYPE_DATETIME
     * @edit 19-08-06
     * - Handle DATATYPE_SET
     * - Handle DATATYPE_SMALLINT
     * - Handle DATATYPE_FLOAT
     */
    protected function getColumnDefinitionDataType()
    {
        $rtnStr = $this->dataType->getDatatype();
        switch ($this->dataType->getDatatype()) {
            case DataType::DATATYPE_SERIAL:
            case DataType::DATATYPE_DATE:
                break;
            case DataType::DATATYPE_ENUM:
            case DataType::DATATYPE_SET:
                $rtnStr .= "(" . (\join(",", $this->dataType->getValues())) . ")";
                $rtnStr .= !\is_null($this->dataType->getCharsetName()) ? " CHARACTER SET {$this->dataType->getCharsetName()}" : "";
                $rtnStr .= !\is_null($this->dataType->getCollationName()) ? " COLLATE {$this->dataType->getCollationName()}" : "";
                break;
            case DataType::DATATYPE_SMALLINT:
            case DataType::DATATYPE_INT:
            case DataType::DATATYPE_TINYINT:
            case DataType::DATATYPE_BIGINT:
                $rtnStr .= !\is_null($this->dataType->getM()) ? "({$this->dataType->getM()})" : "";
                $rtnStr .= ($this->dataType->getUnsigned()) ? " UNSIGNED" : "";
                $rtnStr .= ($this->dataType->getZerofill()) ? " ZEROFILL" : "";
                break;
            case Datatype::DATATYPE_DATETIME:
            case DataType::DATATYPE_TIMESTAMP:
            case DataType::DATATYPE_TIME:
                $rtnStr .= !\is_null($this->dataType->getFSP()) ? "({$this->dataType->getFSP()})" : "";
                break;
            case DataType::DATATYPE_DECIMAL:
            case DataType::DATATYPE_FLOAT:
                $rtnStr .= "({$this->dataType->getM()},{$this->dataType->getD()})";
                $rtnStr .= ($this->dataType->getUnsigned()) ? " UNSIGNED" : "";
                $rtnStr .= ($this->dataType->getZerofill()) ? " ZEROFILL" : "";
                break;
            case DataType::DATATYPE_CHAR:
            case DataType::DATATYPE_VARCHAR:
                $rtnStr .= "({$this->dataType->getM()})";
            case DataType::DATATYPE_MEDIUMTEXT:
            case DataType::DATATYPE_TEXT:
                $rtnStr .= !\is_null($this->dataType->getCharsetName()) ? " CHARACTER SET {$this->dataType->getCharsetName()}" : "";
                $rtnStr .= !\is_null($this->dataType->getCollationName()) ? " COLLATE {$this->dataType->getCollationName()}" : "";
                break;
            default:
                \trigger_error("@todo handle datatype " . $this->dataType->getDatatype(), \E_USER_ERROR);
                break;
        }
        return $rtnStr;
    }

    /**
     * 
     * @return string
     * @since 18-10-02
     * @edit 18-11-02
     * - Handle default value now()
     */
    protected function getColumnDefinitionDefault()
    {
        $rtnStr = "";
        if (!is_null($this->default)) {
            switch (true) {
                case \is_int($this->default) === true:
                    $rtnStr .= " DEFAULT " . $this->default;
                    break;
                case \is_string($this->default) === true:
                    switch ($this->default) {
                        case "now()":
                        case "NULL":
                            $rtnStr .= " DEFAULT " . $this->default;
                            break;
                        default:
                            $rtnStr .= " DEFAULT '" . $this->default . "'";
                            break;
                    }
                    break;
                default:
//                    var_dump($this->default);
                    \trigger_error("@todo handle type", \E_USER_ERROR);
                    break;
            }
        }
        return $rtnStr;
    }

    /**
     * 
     * @return string
     * @since 18-10-02
     */
    protected function getColumnDefinitionComment()
    {
        $rtnStr = "";
        if (!\is_null($this->comment)) {
            switch (true) {
                case (\is_string($this->comment) === true):
                    $rtnStr .= " COMMENT '" . \addslashes($this->comment) . "'";
                    break;
                default:
//                    var_dump($this->comment);
                    \trigger_error("Comment must be string", \E_USER_ERROR);
                    break;
            }
        }
        return $rtnStr;
    }

    /**
     *
     * @var string
     * @since 18-10-03
     */
    protected $generated;

    /**
     *
     * @var mixed
     * @since 18-10-11
     */
    protected $expression;

    /**
     * Values of a generated column are computed from an expression included in the column definition. 
     *  The VIRTUAL or STORED keyword indicates how column values are stored, which has implications for column use:
     *
     * InnoDB supports secondary indexes on virtual columns. See Section 13.1.18.9, “Secondary Indexes and Generated Columns”.
     *
     *
     * It is permitted to mix VIRTUAL and STORED columns within a table.
     * 
     * 
     * @param mixed $expression
     * @param string $columnUse VIRTUAL: Column values are not stored, but are 
     * evaluated when rows are read, immediately after any BEFORE triggers. A 
     * virtual column takes no storage. STORED: Column values are evaluated and 
     * stored when rows are inserted or updated. A stored column does require 
     * storage space and can be indexed. The default is VIRTUAL if neither 
     * keyword is specified.
     * 
     * @return \GIndie\DBHandler\MySQL57\Instance\ColumnDefinition
     * 
     * @since 18-10-11
     * 
     */
    public function setGenerated($expression, $columnUse = "VIRTUAL")
    {
        $this->expression = $expression;
        switch ($columnUse) {
            case "VIRTUAL":
            case "STORED":
                $this->generated = $columnUse;
                break;
            default:
                \trigger_error("Invalid definition of columnUse {$columnUse}", \E_USER_ERROR);
                break;
        }
        return $this;
    }

    /**
     * 
     * @return boolean
     * @since 18-10-28
     */
    public function isGenerated()
    {
        return ($this->expression !== null);
        if ($this->expression !== null) {
            return true;
        }
        return false;
    }

}
