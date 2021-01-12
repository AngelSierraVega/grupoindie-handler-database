<?php

/**
 * GI-DBHandler-DVLP - DisplayTraits
 *
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * @copyright (c) 2019 Angel Sierra Vega. Grupo INDIE.
 * @license file://LICENSE
 * 
 * @package GIndie\DBHandler\Components\Framework
 *
 * @version 00.C0
 * @since 19-01-09
 */

namespace GIndie\DBHandler\Components\Framework;

use GIndie\ScriptGenerator\Bootstrap3\Javascript\Tooltip;
use GIndie\Framework\View;

/**
 * Description of DisplayTraits
 *
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 */
trait DisplayTraits
{

    /**
     * 
     * @return \GIndie\Framework\View\Table
     * @since 18-08-14
     * @edit 19-01-09
     * - Moved from \GIndie\Framework\Components\Framework\Deployer.php
     */
    public static function dsplyDBHandlerINI()
    {
        $passwordValue = \GIndie\DBHandler\INIHandler::getMainPassword();
        switch ($passwordValue)
        {
            case "":
                $passwordValue = "Empty string!";
                break;
        }
        $passwordNode = Tooltip::tooltipOnLeft(\GIndie\ScriptGenerator\HTML5\Category\Basic::paragraph("********"),
                $passwordValue);
        return View\Table::displayArray(
                [
                "server_prefix" => \GIndie\DBHandler\INIHandler::getServerPrefix(),
                "host" => \GIndie\DBHandler\INIHandler::getHost(),
                "main_username" => \GIndie\DBHandler\INIHandler::getMainUsername(),
                "main_password" => $passwordNode
                ], "DBHandler.ini")->addClass("table");
    }

    /**
     * 
     * @return \GIndie\Framework\View\Table
     * @since 19-01-09
     */
    public static function phpConnectionData()
    {
        $connection = \GIndie\DBHandler\MySQL57::getConnection();
        return View\Table::displayArray(
                ["stat" => $connection->stat()
                , "get_client_info" => $connection->get_client_info()
                , "get_server_info" => $connection->get_server_info()
                ], "PHP Connection data")->addClass("table table-condensed");
    }

    /**
     * 
     * @return \GIndie\Framework\View\Table
     * @since 19-01-09
     */
    public static function globalVars()
    {
        return View\Table::displayArray(
                \GIndie\DBHandler\MySQL57::getCurrentGlobalVars()
                , "Global variables")->addClass("table table-condensed");
    }

    /**
     * 
     * @return \GIndie\Framework\View\Table
     * @since 19-01-09
     */
    public static function sessionVars()
    {
        return View\Table::displayArray(
                \GIndie\DBHandler\MySQL57::getCurrentSessionVars()
                , "Session variables")->addClass("table table-condensed");
    }

    /**
     * 
     * @return \GIndie\Framework\View\Table
     * @since 19-01-09
     */
    public static function userPrivileges()
    {
        return View\Table::displayArray(
                ["super_priv" => \GIndie\DBHandler\MySQL57::getSuperPrivilege()]
                , "User privileges")->addClass("table table-condensed");
    }

}
