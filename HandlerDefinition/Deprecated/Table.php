<?php

namespace GIndie\DBHandler\HandlerDefinition\Deprecated;
/**
 * DVLP-DBHandler - Table
 *
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * @copyright (c) 2018 Angel Sierra Vega. Grupo INDIE.
 *
 * @package DatabaseHandler
 *
 * @version 00
 * @edit 18-02-15
 * - Created schema(), primaryKeyName(), name(), columnNames()
 * @edit 18-04-26
 * - Created config()
 * @deprecated since 18-05-01
 * - Moved class from [base_dir]\Interfaces to [base_dir]\HandlerDefinition\Deprecated
 */
interface Table
{

    /**
     * @since 18-04-26
     * @deprecated since 18-05-01
     */
    public static function config();

    /**
     * @since 18-02-15
     * @deprecated since 18-05-01
     * @return string
     */
    public static function schema();

    /**
     * @since 18-02-15
     * @deprecated since 18-05-01
     * @return string
     */
    public static function name();

    /**
     * @since 18-02-15
     * @deprecated since 18-05-01
     * @return string
     */
    public static function primaryKeyName();

    /**
     * @since 18-02-15
     * @deprecated since 18-05-01
     * @return string
     */
    public static function columnNames();
}
