<?php


/**
 * DVLP-DBHandler - INIHandler
 *
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * @copyright (CC) 2020 Angel Sierra Vega. Grupo INDIE.
 * @license file://LICENSE
 *
 * @package GIndie\DBHandler\Components
 *
 * @since 18-02-14
 * @version 00.AA
 */

namespace GIndie\DBHandler;

/**
 * 
 * @edit 18-02-14
 * - Class extends from \GIndie\INIHandler
 * - Created fileName(), requiredVars(), getHost()
 * @edit 18-07-26
 * - Created getMainUsername(), getMainPassword(), 
 * @edit 18-10-02
 * - Upgraded version
 * @todo
 * - Handle different users (including root)
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
     * @return string
     * @since 18-07-26
     */
    public static function getMainUsername()
    {
        return static::getValue("users", "main_username");
    }

    /**
     * 
     * @return string
     * @since 18-07-26
     */
    public static function getMainPassword()
    {
        return static::getValue("users", "main_password");
    }
    
    /**
     * 
     * @return string
     * @since 18-08-04
     */
    public static function getServerPrefix()
    {
        return static::getValue("server", "server_prefix");
    }
    
    /**
     * 
     * @return string
     * @since 18-07-26
     */
    public static function getHost()
    {
        return static::getValue("server", "host");
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
