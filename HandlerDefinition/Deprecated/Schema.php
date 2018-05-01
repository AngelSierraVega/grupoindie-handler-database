<?php

namespace GIndie\DBHandler\HandlerDefinition\Deprecated;

/**
 * DVLP-DBHandler - Schema
 *
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * @copyright (c) 2018 Angel Sierra Vega. Grupo INDIE.
 *
 * @package DatabaseHandler
 *
 * @version 00
 * @since 18-02-14
 * @deprecated since 18-05-01
 * - Moved class from [base_dir]\Interfaces to [base_dir]\HandlerDefinition\Deprecated
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
     */
    public static function tableClasses();
}
