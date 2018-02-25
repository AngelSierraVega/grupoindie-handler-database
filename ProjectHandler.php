<?php

namespace GIndie\DBHandler;

/**
 * DVLP-DBHandler - ProjectHandler
 *
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * @copyright (c) 2018 Angel Sierra Vega. Grupo INDIE.
 *
 * @package DatabaseHandler
 *
 * @version GI-DBH.00.00 18-02-24 Empty class created.
 * @edit GI-DBH.00.01
 * - Added code from GI-CMMN
 */
class ProjectHandler extends \GIndie\ProjectHandler
{

    /**
     * 
     * @return string
     * @since GI-DBH.00.01
     */
    public static function pathToSourceCode()
    {
        return \pathinfo(__FILE__, \PATHINFO_DIRNAME) . \DIRECTORY_SEPARATOR;
    }

    /**
     * 
     * @return string
     * @since GI-DBH.00.01
     */
    public static function projectName()
    {
        return "DBHandler";
    }

    /**
     * 
     * @return null
     * @since GI-DBH.00.01
     */
    public static function projectNamespace()
    {
        return null;
    }

    /**
     * 
     * @return string
     * @since GI-DBH.00.01
     */
    public static function projectVendor()
    {
        return "GIndie";
    }

}
