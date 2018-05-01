<?php

namespace GIndie\DBHandler;

/**
 * DVLP-DBHandler - INIHandler
 *
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * @copyright (c) 2018 Angel Sierra Vega. Grupo INDIE.
 *
 * @package DatabaseHandler
 *
 * @since 18-02-14
 * @edit
 * - Class extends from \GIndie\INIHandler
 * - Created fileName(), requiredVars()
 * @version A0
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
