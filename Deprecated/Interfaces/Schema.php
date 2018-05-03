<?php

namespace GIndie\DBHandler\Interfaces;

/**
 * DVLP-DBHandler - Schema
 *
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * @copyright (c) 2018 Angel Sierra Vega. Grupo INDIE.
 *
 * @package DatabaseHandler
 *
 * @version A0
 * @since 18-02-14
 * @deprecated since 18-05-01
 * - Moved class from [base_dir]\Interfaces to [base_dir]\HandlerDefinition\Deprecated
 * @edit 18-05-02
 * - Moved class from [base_dir]\Interfaces to [base_dir]\Deprecated\Interfaces
 * @version A1.00
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
