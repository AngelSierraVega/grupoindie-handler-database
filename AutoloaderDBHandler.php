<?php

/**
 * DVLP-DBHandler - AutoloaderDBHandler
 *
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * @copyright (c) 2018 Angel Sierra Vega. Grupo INDIE.
 *
 * @package GIndie\DBHandler\ProjectDefinition
 * 
 * @version 00.A4
 * @since 18-02-14
 * 
 * @edit 18-02-14
 * - Functional autoloader
 * @edit 18-05-05
 * - Autoloader for deprecated folders
 * @edit 18-10-02
 * - Upgraded version
 */

namespace GIndie\DBHandler;

/**
 * Autoloader function
 * 
 * @since 18-02-14
 * - Added code from Straffsa\WebServiceTimbrado\FacturacionExterna
 * @edit 18-05-05
 * @edit 18-11-01
 * - Removed access to DEPRECATED
 */
\spl_autoload_register(function($className) {
    if (\strcmp(__NAMESPACE__, \substr($className, 0, (\strlen(__NAMESPACE__) * 1))) == 0) {
        $requestedFile = \explode("\\", $className);
        $requestedFile = \array_pop($requestedFile) . ".php";
//        $requestedNamespace = \substr($className, 0, (\strlen($requestedFile) - 3) * -1);
        switch (true)
        {
//            case (0 == \strcmp($requestedFile, 'MySQL.php')):
//                $edited = "\\Deprecated\\" . $requestedFile;
//                $edited = \str_replace("\\", \DIRECTORY_SEPARATOR, __DIR__ . $edited);
//                require_once($edited);
//                break;
//            case \is_int(\strpos($className, 'GIndie\\DBHandler\\MySQL\\')):
//                $edited = "\\Deprecated\\MySQL\\" . $requestedFile;
//                $edited = \str_replace("\\", \DIRECTORY_SEPARATOR, __DIR__ . $edited);
//                require_once($edited);
//                break;
//            case \is_int(\strpos($className, 'GIndie\\DBHandler\\Interfaces\\')):
//                $edited = "\\Deprecated\\Interfaces\\" . $requestedFile;
//                $edited = \str_replace("\\", \DIRECTORY_SEPARATOR, __DIR__ . $edited);
//                require_once($edited);
//                break;
            default:
                $edited = \substr($className, \strlen(__NAMESPACE__) + \strrpos($className, __NAMESPACE__));
                $edited = \str_replace("\\", \DIRECTORY_SEPARATOR, __DIR__ . $edited) . ".php";
                if (\is_readable($edited)) {
                    require_once($edited);
                }
                break;
        }
    }
});
