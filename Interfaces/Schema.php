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
 * @version GI-DBH.00.00 18-02-14 Empty interface created.
 */
interface Schema
{
    /**
     * @since GI-DBH.00.01
     * @return string
     */
    public static function name();
}
