<?php

namespace GIndie\DBHandler;

/**
 * GI-DBHandler-DVLP - ExceptionDBHandler
 *
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * @copyright (c) 2018 Angel Sierra Vega. Grupo INDIE.
 *
 * @package DatabaseHandler
 * 
 * @since 18-04-07
 * - Functional class
 * @version AO
 */
class ExceptionDBHandler extends \Exception
{

    /**
     * @since 18-04-07
     */
    const NO_DATABASE = 100;

    /**
     * 
     * @param string $databaseName
     * @return \GIndie\DBHandler\ExceptionDBHandler
     * @since 18-04-07
     */
    public static function databaseNotFound($databaseName)
    {
        return new ExceptionDBHandler(self::NO_DATABASE, $databaseName);
    }

    /**
     * @since 18-04-07
     */
    const INVALID_DEFINITION = 110;

    /**
     * 
     * @param string $invalidDefinitionOf
     * @param string $expectedValue
     * @param string $currentValue
     * @return \GIndie\DBHandler\ExceptionDBHandler
     * @since 18-04-07
     */
    public static function invalidDefinition($invalidDefinitionOf, $currentValue, $expectedValue)
    {
        return new ExceptionDBHandler(self::INVALID_DEFINITION, $invalidDefinitionOf, $currentValue, $expectedValue);
    }

    /**
     * 
     * @param int $code
     * @param mixed|null $param1
     * @param mixed|null $param2
     * @since 18-04-07
     */
    public function __construct($code = 0, $param1 = null, $param2 = null, $param3 = null)
    {
        switch ($code)
        {
            case self::NO_DATABASE:
                $message = "Database '{$param1}' not found.";
                break;
            case self::INVALID_DEFINITION:
                $message = "Invalid definition of '{$param1}'. Value '{$param2}', expected '{$param3}'.";
                break;
            default:
                \trigger_error("ExceptionDBHandler code '{$code}' not defined.", \E_USER_ERROR);
                break;
        }
        parent::__construct($message, $code, null);
    }

}