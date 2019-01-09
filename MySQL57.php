<?php

/**
 * GI-DBHandler-DVLP - MySQL57
 *
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * @copyright (c) 2018 Angel Sierra Vega. Grupo INDIE.
 *
 * @package GIndie\DBHandler
 *
 * @version 00.BA
 * @since 18-11-02
 */

namespace GIndie\DBHandler;

use GIndie\DBHandler\MySQL57\DataDefinition\ServerAdministration\SqlCombinationModes;

/**
 * Database Handler for MySQL 5.7
 *
 * @edit 18-11-10
 * - Created selectGlobalSqlMode(), getGlobalSqlMode(), handleDefaultSqlMode()
 * - Created setGlobalSqlMode()
 * @edit 18-11-11
 * - defaultGlobalVars()
 * @edit 18-12-??
 * - Handle Character Set Variables
 * @edit 19-01-09
 * - Created defaultSessionVars(), getCurrentSessionVars(), autodefineSessionVars()
 * - Created getSuperPrivilege()
 */
class MySQL57 extends AbstractDBHandler
{

    /**
     * Defines the global variables for the DBMS
     * 
     * @return array
     * @since 18-11-11
     * @edit 18-12-02
     * @edit 19-01-09
     * - Default time zone to UTC -06:00
     */
    public static function defaultGlobalVars()
    {
        $rtnArray = [];
        //Character sets
        $rtnArray["character_set_client"] = "utf8mb4";
        $rtnArray["character_set_connection"] = "utf8mb4";
        $rtnArray["character_set_database"] = "utf8mb4";
        $rtnArray["character_set_filesystem"] = "binary";
        $rtnArray["character_set_results"] = "utf8mb4";
        $rtnArray["character_set_server"] = "utf8mb4";
        $rtnArray["character_set_system"] = null; //Variable 'character_set_system' is a read only variable
        //Collation
        $rtnArray["collation_connection"] = "utf8mb4_unicode_ci"; //utf8_general_ci
        $rtnArray["collation_database"] = "utf8mb4_unicode_ci"; //latin1_swedish_ci
        $rtnArray["collation_server"] = "utf8mb4_unicode_ci"; //latin1_swedish_ci
        //Others
        $rtnArray["sql_mode"] = SqlCombinationModes::TRADITIONAL;
        $rtnArray["system_time_zone"] = null;
        $rtnArray["time_zone"] = "-06:00"; //The value can be given as a string indicating an offset from UTC, such as '+10:00' or '-6:00'. 
        //Others 2
        $rtnArray["log_error"] = null;
        $rtnArray["version"] = null;
        $rtnArray["version_compile_os"] = null;
        $rtnArray["foreign_key_checks"] = 1;
        return $rtnArray;
    }

    /**
     * Defines the default session variables for the DBMS.
     * 
     * @return array
     * @since 19-01-09
     */
    public static function defaultSessionVars()
    {
        $rtnArray = [];
        foreach (static::defaultGlobalVars() as $key => $value) {
            switch ($key)
            {
                case "character_set_system":
                case "system_time_zone":
                case "log_error":
                case "version":
                case "version_compile_os":
                    break; //UTC-06:00
                default:
                    $rtnArray[$key] = $value;
                    break;
            }
        }
        return $rtnArray;
    }

    /**
     * 
     * @return array
     * @since 18-11-11
     */
    public static function getCurrentGlobalVars()
    {
        $query = [];
        foreach (static::defaultGlobalVars() as $varname => $value) {
            $query[] = "@@GLOBAL.{$varname} AS {$varname}";
        }
        $query = "SELECT " . \join(", ", $query) . ";";
        $rtnArray = static::query($query)->fetch_assoc();
        $rtnArray["sql_mode"] = \join(", ", \explode(",", $rtnArray["sql_mode"]));
        return $rtnArray;
    }

    /**
     * 
     * @return array
     * @since 19-01-09
     */
    public static function getCurrentSessionVars()
    {
        $query = [];
        foreach (static::defaultSessionVars() as $varname => $value) {
            $query[] = "@@SESSION.{$varname} AS {$varname}";
        }
        $query = "SELECT " . \join(", ", $query) . ";";
        $result = static::query($query);
        if ($result) {
            $rtnArray = $result->fetch_assoc();
            $rtnArray["sql_mode"] = \join(", ", \explode(",", $rtnArray["sql_mode"]));
            return $rtnArray;
        } else {
            \trigger_error(static::$connection->error, \E_USER_ERROR);
        }
    }

    /**
     * 
     * @edit 19-01-08
     * - 
     */
    protected static function autodefineGlobalVars()
    {
        $rtnVal = true;
        $currentVars = static::getCurrentGlobalVars();
        $defaultVars = static::defaultGlobalVars();
        $arrayDiff = \array_diff_assoc($defaultVars, $currentVars);
        $setValues = [];
        foreach ($arrayDiff as $varname => $value) {
            switch ($varname)
            {
                case \is_null($defaultVars[$varname]):
                    break;
                case "sql_mode":
                    if (!\array_key_exists(SqlCombinationModes::TRADITIONAL,
                            \array_flip(\explode(", ", $currentVars["sql_mode"])))) {
                        $setValues[] = "GLOBAL {$varname} = '" . SqlCombinationModes::TRADITIONAL . "'";
                    }
                    break;
                default:
                    $setValues[] = "GLOBAL {$varname} = '" . $defaultVars[$varname] . "'";
                    break;
            }
        }
        if (\count($setValues) > 0) {
            static::query("SET " . \join(", ", $setValues) . ";");
            $rtnVal = static::autodefineGlobalVars();
        }
        return $rtnVal;
    }

    /**
     * 
     * @return boolean
     * @since 19-01-09
     */
    protected static function autodefineSessionVars()
    {
        $rtnVal = true;
        $currentVars = static::getCurrentSessionVars();
        $defaultVars = static::defaultSessionVars();
        $arrayDiff = \array_diff_assoc($defaultVars, $currentVars);
        $setValues = [];
        foreach ($arrayDiff as $varname => $value) {
            switch ($varname)
            {
                case \is_null($defaultVars[$varname]):
                    break;
                case "sql_mode":
                    if (!\array_key_exists(SqlCombinationModes::TRADITIONAL,
                            \array_flip(\explode(", ", $currentVars["sql_mode"])))) {
                        $setValues[] = "SESSION {$varname} = '" . SqlCombinationModes::TRADITIONAL . "'";
                    }
                    break;
                default:
                    $setValues[] = "SESSION {$varname} = '" . $defaultVars[$varname] . "'";
                    break;
            }
        }
        if (\count($setValues) > 0) {
            static::query("SET " . \join(", ", $setValues) . ";");
            $rtnVal = static::autodefineSessionVars();
        }
        return $rtnVal;
    }

    /**
     * Sets de default global sql mode to TRADITIONAL if is not defined
     * 
     * @return boolean
     * @since 18-11-10
     */
    protected static function handleDefaultSqlMode()
    {
        switch (true)
        {
            case \array_key_exists(SqlCombinationModes::TRADITIONAL,
                \array_flip(\explode(",", static::getGlobalSqlMode()))):
                break;
            default:
                static::setGlobalSqlMode(SqlCombinationModes::TRADITIONAL);
                static::handleDefaultSqlMode();
                break;
        }
        return true;
    }

    /**
     * 
     * @param string $mode
     * @return boolean
     * @since 18-11-10
     */
    public static function setGlobalSqlMode($mode)
    {
        return static::getConnection()->query("SET GLOBAL sql_mode = '{$mode}';");
    }

    /**
     * 
     * @return \mysqli_result|boolean
     * @since 18-11-10
     */
    public static function selectGlobalSqlMode()
    {
        return static::query("SELECT @@GLOBAL.sql_mode;");
    }

    /**
     * 
     * @return string
     * @since 18-11-10
     */
    public static function getGlobalSqlMode()
    {
        return static::selectGlobalSqlMode()->fetch_assoc()["@@GLOBAL.sql_mode"];
    }

    /**
     * 'N','Y'
     * 
     * @since 19-01-08
     * @return string|false
     */
    public static function getSuperPrivilege()
    {
        $query = MySQL57\Statement\DataManipulation::select(["super_priv"], ["mysql" => "user"]);
        $query->addConditionEquals("user", INIHandler::getMainUsername());
        $query->addConditionEquals("host", INIHandler::getHost());
        if (($result = static::query($query)) == true) {
            return $result->fetch_assoc()["super_priv"];
        } else {
            switch (static::$connection->errno)
            {
                case 1142:
                    return "N";
                    break;
                default:
                    \trigger_error(static::$connection->errno . ": " . static::$connection->error,
                        \E_USER_ERROR);
                    break;
            }
        }
    }

}
