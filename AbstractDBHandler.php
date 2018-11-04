<?php

/**
 * GI-DBHandler-DVLP - AbstractDBHandler
 *
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * @copyright (c) 2018 Angel Sierra Vega. Grupo INDIE.
 *
 * @package GIndie\DBHandler
 *
 * @version 00.AA
 * @since 18-02-14
 */

namespace GIndie\DBHandler;

/**
 * Implements the common/main funcionality and variables for a languaje-specific
 * DBHandler
 * 
 * @abstract
 * @edit 18-07-26
 * - Moved code from Deprecated/MySQL
 * @edit 18-10-02
 * - Upgraded version
 * @edit 18-11-10
 * - Created __construct()
 * @todo Handle Character Set Variables
 */
abstract class AbstractDBHandler
{

    /**
     * @since 18-11-10
     */
    private function __construct()
    {
        
    }

    /**
     * 
     * @return \mysqli
     * @since 18-02-14
     * @edit 18-07-26
     * - Use getHost(), getMainUsername(), getMainPassword()
     * - Changed method visibility from private to protected
     * @edit 18-11-11
     * - Graciously handles utf8bm4 charset
     * @todo Revert visibility to private
     */
    protected static function openConnection()
    {
        $connection = new \mysqli("p:" . INIHandler::getHost(), INIHandler::getMainUsername(), INIHandler::getMainPassword());
        if (\mysqli_connect_errno()) {
            throw ExceptionDBHandler::invalidConnection(\mysqli_connect_error());
        }
//        switch ($connection->get_charset())
//        {
//            case "utf8bm4":
//                break;
//            default:
//                
//                break;
//        }
//        $connection->set_charset("utf8mb4");
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
     * @edit 18-11-10
     * - Use getConnection()
     * 
     * @todo
     * - Implement parameter \GIndie\DBHandler\MySQL\Statement $query
     * 
     */
    public static function query($query)
    {
        return static::getConnection()->query($query);
    }
    
    public static function querySelect(){
        $select= new MySQL57\Statement\DataManipulation\Select($selectors, $tableReferences);
        $select->addCondition($expresion);
        $select;
    }

    /**
     * Gets the \mysqli connection object
     * 
     * @return \mysqli 
     * @since 18-02-14
     * @edit 18-11-10
     * - Use handleDefaultSqlMode() if no connection exists
     */
    final public static function getConnection()
    {
        if (\is_null(static::$connection)) {
            static::$connection = static::openConnection();
//            static::handleDefaultSqlMode();
            static::autodefineGlobalVars();
//            static::$connection->refresh();
//            static::$connection = static::openConnection();
        }
        return static::$connection;
    }

    /**
     * The \mysqli connection object
     * @var \mysqli 
     * @since 18-02-14
     * @todo Private static var
     */
    protected static $connection;

}
