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
 * @version AO
 * @since 18-02-14
 */
interface Schema
{

    /**
     * @since 18-02-14
     * @return string
     */
    public static function name();

    /**
     * @since 18-04-06
     * @return array
     */
    public static function tableClasses();
}
