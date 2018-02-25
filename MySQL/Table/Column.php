<?php

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
