<?php

namespace GIndie\DBHandler;

/**
 * DVLP-DBHandler - INIHandler
 *
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * @copyright (c) 2018 Angel Sierra Vega. Grupo INDIE.
 *
 * @package GIndie\DBHandler\Components
 *
 * @since 18-02-14
 * @edit
 * - Class extends from \GIndie\INIHandler
 * - Created fileName(), requiredVars()
 * @version 0A.00
 * @todo
 * - Handle root user
 * @version 0A.10
 */
class INIHandler extends \GIndie\INIHandler
{

    /**
     * 
     * @return string
     * @since 18-02-14
     */
    public static function fileName()
    {
        return "DBHandler";
    }

    /**
     * 
     * @return array
     * @since 18-02-14
     */
    public static function requiredVars()
    {
        return [
            "server" => ["server_prefix", "host"],
            "users" => ["main_username", "main_password"]
        ];
    }

}
