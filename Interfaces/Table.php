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
 * @edit 18-02-15
 * - Created schema(), primaryKeyName(), name(), columnNames()
 * @edit 18-04-26
 * - Created config()
 */
interface Table
{

    /**
     * @since 18-04-26
     */
    public static function config();

    /**
     * @since 18-02-15
     * @return string
     */
    public static function schema();

    /**
     * @since 18-02-15
     * @return string
     */
    public static function name();

    /**
     * @since 18-02-15
     * @return string
     */
    public static function primaryKeyName();

    /**
     * @since 18-02-15
     * @return string
     */
    public static function columnNames();
}
