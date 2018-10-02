<?php

/**
 * GI-Platform-SNDBX - Schema 
 *
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * @copyright (C) 2018 Angel Sierra Vega. Grupo INDIE.
 *
 * @package GIndie\DBHandler
 * 
 * @version DEPRECATED
 * @since 18-02-14
 */

namespace GIndie\DBHandler\Interfaces;

/**
 * @deprecated since 18-05-01
 * - Moved class from [base_dir]\Interfaces to [base_dir]\HandlerDefinition\Deprecated
 * @edit 18-05-02
 * - Moved class from [base_dir]\Interfaces to [base_dir]\Deprecated\Interfaces
 * @edit 18-10-02
 * - Upgraded version
 */
interface Schema
{

    /**
     * @since 18-02-14
     * @deprecated since 18-05-01
     * @return string
     */
    public static function name();

    /**
     * @since 18-04-06
     * @deprecated since 18-05-01
     * @return array
     * public static function tableClasses();
     */
}
