<?php

/**
 * DVLP-DBHandler - AutoloaderDBHandler
 *
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * @copyright (c) 2018 Angel Sierra Vega. Grupo INDIE.
 *
 * @package DatabaseHandler
 *
 * @since 18-02-14
 * @edit
 * - Functional autoloader
 * @version AO
 */

namespace GIndie\DBHandler;

/**
 * Autoloader function
 * 
 * @since 18-02-14
 * - Added code from Straffsa\WebServiceTimbrado\FacturacionExterna
 */
\spl_autoload_register(function($className) {
    switch (\substr($className, 0, (\strlen(__NAMESPACE__) * 1)))
    {
        case __NAMESPACE__:
            $edited = \substr($className, \strlen(__NAMESPACE__) + \strrpos($className, __NAMESPACE__));
            $edited = \str_replace("\\", \DIRECTORY_SEPARATOR, __DIR__ . $edited) . ".php";
            if (\is_readable($edited)) {
                require_once($edited);
            }
    }
});
