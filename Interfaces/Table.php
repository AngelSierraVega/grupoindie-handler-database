<?php

namespace GIndie\DBHandler\Interfaces;

/**
 * DVLP-DBHandler - Table
 *
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * @copyright (c) 2018 Angel Sierra Vega. Grupo INDIE.
 *
 * @package DatabaseHandler
 *
 * @version GI-DBH.00.00 18-02-14 Empty interface created.
 * @edit GI-DBH.00.01 18-02-15
 * - Created schema(), primaryKeyName(), name(), columnNames()
 */
interface Table
{

    /**
     * @since GI-DBH.00.01
     * @return string
     */
    public static function schema();

    /**
     * @since GI-DBH.00.01
     * @return string
     */
    public static function name();

    /**
     * @since GI-DBH.00.01
     * @return string
     */
    public static function primaryKeyName();
    
    /**
     * @since GI-DBH.00.01
     * @return string
     */
    public static function columnNames();
}
