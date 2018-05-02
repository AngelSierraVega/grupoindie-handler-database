<?php

namespace GIndie\DBHandler;

use GIndie\DBHandler\INIHandler;

/**
 * DVLP-DBHandler - MySQL
 *
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * @copyright (c) 2018 Angel Sierra Vega. Grupo INDIE.
 *
 * @package DatabaseHandler
 *
 * @since 18-02-14
 * @edit
 * - Added openConnection(), query(), $connection from DPR-DBHandler
 * - Created getConnection()
 * @version AO
 * 
 * @todo Class extends MySQL56
 * @deprecated since 18-05-01
 * @edit 18-05-02
 * - Moved file from [base_dir] to [base_dir]\Deprecated
 * @version AO.DPR
 */
class MySQL
{

    /**
     * 
     * @return \mysqli
     * @since 18-02-14
     * @deprecated since 18-05-01
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
     * @since 18-02-14
     * @deprecated since 18-05-01
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
     * @deprecated since 18-05-01
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
