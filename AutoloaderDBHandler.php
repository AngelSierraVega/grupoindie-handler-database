<?php

/**
 * DVLP-DBHandler - AutoloaderDBHandler
 *
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * @copyright (c) 2018 Angel Sierra Vega. Grupo INDIE.
 *
 * @package DatabaseHandler
 *
 * @version GI-DBH.00.00 18-02-14 Empty file created.
 * @edit GI-DBH.00.01
 * - Functional autoloader
 */

namespace GIndie\DBHandler;

/**
 * Autoloader function
 * 
 * @since GI-DBH.00.01
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
