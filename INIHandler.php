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
 * @version GI-DBH.00.00 18-02-14 Empty class created.
 * @edit GI-DBH.00.01
 * - Class extends from \GIndie\INIHandler
 * - Created fileName(), requiredVars()
 */
class INIHandler extends \GIndie\INIHandler
{

    /**
     * 
     * @return string
     * @since GI-DBH.00.01
     */
    public static function fileName()
    {
        return "DBHandler";
    }

    /**
     * 
     * @return array
     * @since GI-DBH.00.01
     */
    public static function requiredVars()
    {
        return [
            "server" => ["server_prefix", "host"],
            "users" => ["main_username", "main_password"]
        ];
    }

}
