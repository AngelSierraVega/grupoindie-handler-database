<?php

/**
 * GI-DBHandler-DVLP - AbstractDBHandler
 *
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * @copyright (c) 2018 Angel Sierra Vega. Grupo INDIE.
 *
 * @package GIndie\DBHandler
 *
 * @version 0A.30
 * @since 18-07-26
 */

namespace GIndie\DBHandler;

/**
 * Implements the common/main funcionality and variables for a languaje-specific
 * DBHandler
 * 
 * @abstract
 * @edit 18-07-26
 * - Added code from Deprecated/MySQL
 */
abstract class AbstractDBHandler
{

    /**
     * 
     * @return \mysqli
     * @since 18-02-14
     * @edit 18-07-26
     * - Use getHost(), getMainUsername(), getMainPassword()
     * - Changed method visibility from private to protected
     */
    protected static function openConnection()
    {
        $connection = new \mysqli("p:" . INIHandler::getHost(), INIHandler::getMainUsername(), INIHandler::getMainPassword());
        if (\mysqli_connect_errno()) {
            throw ExceptionDBHandler::invalidConnection(\mysqli_connect_error());
        }
        $connection->set_charset("utf8");
        return $connection;
    }

    /**
     * Performs a query on the connection.
     * 
     * @param string $query
     * 
     * @since 18-02-14
     * 
     * @return \mysqli_result|boolean <b>FALSE</b> on failure. For successful SELECT, 
     * SHOW, DESCRIBE or EXPLAIN queries <b>mysqli_query</b> will return a 
     * <b>mysqli_result</b> object. For other successful queries <b>mysqli_query</b> 
     * will return <b>TRUE</b>.
     * 
     * @todo
     * - Implement parameter \GIndie\DBHandler\MySQL\Statement $query
     * 
     */
    public static function query($query)
    {
        if (\is_null(static::$connection)) {
            static::$connection = static::openConnection();
        }
        return static::$connection->query($query);
    }

    /**
     * 
     * @return \mysqli 
     * @since 18-02-14
     */
    public static function getConnection()
    {
        if (\is_null(static::$connection)) {
            static::$connection = static::openConnection();
        }
        return static::$connection;
    }

    /**
     *
     * @var \mysqli 
     * @since 18-02-14
     */
    protected static $connection;

}
