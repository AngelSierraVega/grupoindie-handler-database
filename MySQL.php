<?php

namespace GIndie\DBHandler;

/**
 * DVLP-DBHandler - MySQL
 *
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * @copyright (c) 2018 Angel Sierra Vega. Grupo INDIE.
 *
 * @package DatabaseHandler
 *
 * @version GI-DBH.00.00 18-02-14 Empty class created.
 * @edit GI-DBH.00.01
 * - Added openConnection(), query(), $connection from DPR-DBHandler
 */
class MySQL
{

    /**
     * 
     * @return \mysqli
     * @since GI-DBH.00.01
     */
    private static function openConnection()
    {
        $host = INIHandler::getValue("server", "host");
        $username = INIHandler::getValue("users", "main_username");
        $password = INIHandler::getValue("users", "main_password");
        $connection = new \mysqli("p:" . $host, $username, $password);
        if (\mysqli_connect_errno()) {
            throw new \Exception("Connection failed: " . \mysqli_connect_error());
        }
        $connection->set_charset("utf8");
        return $connection;
    }

    /**
     * 
     * Performs a query on the connection.
     * 
     * @param \GIndie\DBHandler\MySQL\Statement $query
     * 
     * @return \mysqli_result|boolean <b>FALSE</b> on failure. For successful SELECT, 
     * SHOW, DESCRIBE or EXPLAIN queries <b>mysqli_query</b> will return a 
     * <b>mysqli_result</b> object. For other successful queries <b>mysqli_query</b> 
     * will return <b>TRUE</b>.
     * @since GI-DBH.00.01
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
     * @var \mysqli 
     * @since GI-DBH.00.01
     */
    public static $connection;

}
