<?php

namespace GIndie\DBHandler\MySQL56\Instance;

/**
 * GI-DBHandler-DVLP - ColumnDefinition
 *
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * @copyright (c) 2018 Angel Sierra Vega. Grupo INDIE.
 *
 * @package DatabaseHandler
 *
 * @version 00
 * @since 18-04-30
 * @edit 18-05-01
 * - Added methods from defined interterface(s)
 * @todo Program class
 */
class ColumnDefinition implements \GIndie\DBHandler\MySQL56\DataDefinition\Column\Definition
{
    /**
     * @todo private vars
     * notNull
     * defaultValue
     * autoIncrement
     * comment
     * columnFormat
     * storage
     */

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
     */
    public function __construct(Definition\DataType $dataType);

    /**
     * If neither NULL nor NOT NULL is specified, the column is treated as though NULL had 
     * been specified.
     * 
     * @param boolean $value 
     * @return \Self
     * 
     * @since 18-05-01
     * - Added from \GIndie\DBHandler\MySQL56\DataDefinition\Column\Definition
     */
    public function setNotNull($value = true);

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
     */
    public function setDefaultValue($value);

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
     */
    public function setAutoIncrement($value = true);

    /**
     * A comment for a column can be specified with the COMMENT option, up to 1024 characters 
     * long. The comment is displayed by the SHOW CREATE TABLE and SHOW FULL COLUMNS statements.
     * 
     * @param string $comment 
     * @return \Self
     * 
     * @since 18-05-01
     * - Added from \GIndie\DBHandler\MySQL56\DataDefinition\Column\Definition
     */
    public function setComment($comment);

    /**
     * @return boolean
     * 
     * @since 18-05-01
     * - Added from \GIndie\DBHandler\MySQL56\DataDefinition\Column\Definition
     */
    public function getNotNull();

    /**
     * BLOB and TEXT columns cannot be assigned a default value.
     * 
     * @return mixed
     * 
     * @since 18-05-01
     * - Added from \GIndie\DBHandler\MySQL56\DataDefinition\Column\Definition
     */
    public function getDefaultValue();

    /**
     * An integer or floating-point column can have the additional attribute AUTO_INCREMENT. 
     * 
     * @return boolean
     * 
     * @since 18-05-01
     * - Added from \GIndie\DBHandler\MySQL56\DataDefinition\Column\Definition
     */
    public function getAutoIncrement();

    /**
     * @return string
     * 
     * @since 18-05-01
     * - Added from \GIndie\DBHandler\MySQL56\DataDefinition\Column\Definition
     */
    public function getComment();
}

namespace GIndie\DBHandler\MySQL\Table;

/**
 * DVLP-DBHandler - Column
 *
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * @copyright (c) 2018 Angel Sierra Vega. Grupo INDIE.
 *
 * @package DatabaseHandler
 * @subpackage MySQL56
 *
 * @version GI-DBH.00.00 18-02-14 Empty class created.
 * @edit GI-DBH.00.01
 * - Created private vars
 * - Created dummies for static methods
 * @edit 18-04-26
 * - Abstracted static constructors into ToDo\StaticConstructors
 * @edit 18-05-01
 * - Moved from <[base_dir]\MysqL\Table\Column.php>
 */
class Column implements ColumnTypes
{

    /**
     * @since 18-04-26
     */
    use StaticConstructors;

    /**
     * 
     * @param type $columnName
     * @param type $dataType
     * @param type $length
     * @param type $values
     * @param type $primaryKey
     * @param type $notNull
     * @param type $unique
     * @param type $binary
     * @param type $unsigned
     * @param type $zerofill
     * @param type $autoincremental
     * @param type $default
     * 
     * @since 18-04-26
     */
    protected function __construct($columnName, $dataType, $length, $values, $primaryKey, $notNull, $unique,
                                   $binary, $unsigned, $zerofill, $autoincremental, $default)
    {
        $this->columnName = $columnName;
        $this->dataType = $dataType;
        $this->length = $length;
        $this->values = $values;
        $this->primaryKey = $primaryKey;
        $this->notNull = $notNull;
        $this->unique = $unique;
        $this->binary = $binary;
        $this->unsigned = $unsigned;
        $this->zerofill = $zerofill;
        $this->autoincremental = $autoincremental;
        $this->default = $default;
    }

    /**
     *
     * @var string 
     * @since GI-DBH.00.01
     */
    private $columnName;

    /**
     *
     * @var int
     * @since GI-DBH.00.01
     */
    private $dataType;

    /**
     *
     * @var int 
     * @since GI-DBH.00.01
     */
    private $length;

    /**
     *
     * @var string comma sepparated values 
     * @since GI-DBH.00.01
     */
    private $values;

    /**
     *
     * @var string 
     * @since GI-DBH.00.01
     */
    private $primaryKey;

    /**
     *
     * @var boolean 
     * @since GI-DBH.00.01
     */
    private $notNull;

    /**
     *
     * @var boolean 
     * @since GI-DBH.00.01
     */
    private $unique;

    /**
     *
     * @var boolean 
     * @since GI-DBH.00.01
     */
    private $binary;

    /**
     *
     * @var boolean 
     * @since GI-DBH.00.01
     */
    private $unsigned;

    /**
     *
     * @var boolean 
     * @since GI-DBH.00.01
     */
    private $zerofill;

    /**
     *
     * @var boolean 
     * @since GI-DBH.00.01
     */
    private $autoincremental;

    /**
     *
     * @var string 
     * @since GI-DBH.00.01
     */
    private $default;

}