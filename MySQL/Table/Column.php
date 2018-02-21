<?php

namespace GIndie\DBHandler\MySQL\Table;

/**
 * DVLP-DBHandler - Column
 *
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * @copyright (c) 2018 Angel Sierra Vega. Grupo INDIE.
 *
 * @package DatabaseHandler
 *
 * @version GI-DBH.00.00 18-02-14 Empty class created.
 * @edit GI-DBH.00.01
 * - Created private vars
 * - Created dummies for static methods
 */
class Column
{

    /**
     * @since GI-DBH.00.01
     * @todo 
     * - Functional method
     * 
     */
    public static function integer();

    /**
     * @since GI-DBH.00.01
     * @todo 
     * - Functional method
     */
    public static function varchar();

    /**
     * @since GI-DBH.00.01
     * @todo 
     * - Functional method
     */
    public static function datetime();

    /**
     * @todo 
     * - Functional method
     */
    public static function date();

    /**
     * @since GI-DBH.00.01
     * @todo 
     * - Functional method
     */
    public static function char();

    /**
     * @since GI-DBH.00.01
     * @todo 
     * - Functional method
     */
    public static function enum();

    /**
     * @since GI-DBH.00.01
     * @todo 
     * - Functional method
     */
    public static function tinyint();

    /**
     * @since GI-DBH.00.01
     * @todo 
     * - Functional method
     */
    public static function tinytext();

    /**
     * @since GI-DBH.00.01
     * @todo 
     * - Functional method
     */
    public static function text();

    /**
     *
     * @var string 
     * @since GI-DBH.00.01
     */
    private $columnName;

    /**
     *
     * @var int
     * @todo constants with data types 
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
