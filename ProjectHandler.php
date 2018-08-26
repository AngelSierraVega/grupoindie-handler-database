<?php

namespace GIndie\DBHandler;

/**
 * DVLP-DBHandler - ProjectHandler
 *
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * @copyright (c) 2018 Angel Sierra Vega. Grupo INDIE.
 *
 * @package GIndie\DBHandler\Components
 *
 * @since 18-02-24
 * @edit 18-02-24
 * - Added code from GI-CMMN
 * @version 0A.30
 * @edit 18-05-19
 * - extends \GIndie\ProjectHandler\AbstractProjectHandler
 */
class ProjectHandler extends \GIndie\ProjectHandler\AbstractProjectHandler
{

    /**
     * 
     * @return string
     * @since 18-05-17
     * @edit 18-05-19
     * - Upgraded project versions 
     * @edit 18-08-26
     * - Upgraded project versions 
     */
    public static function versions()
    {
        $rtnArray = parent::versions();
        //AlphaCero
        $rtnArray[\hexdec("0A.00")]["description"] = "Functional project for FacturacionExterna";
        //AlphaOne
        $rtnArray[\hexdec("0A.10")]["description"] = "Upgrade generic MySQL to specific MySQL56 functionality";
        $rtnArray[\hexdec("0A.10")]["code"] = "AlphaOne";
        $rtnArray[\hexdec("0A.10")]["threshold"] = "0A.10";
        //BetaCero
        $rtnArray[\hexdec("0B.00")]["description"] = "Functional project for MMR-PRDL";
        $rtnArray[\hexdec("0B.00")]["code"] = "BetaCero";
        $rtnArray[\hexdec("0B.00")]["threshold"] = "0B.00";
        \ksort($rtnArray);
        return $rtnArray;
    }

    /**
     * 
     * @return string
     * @since 18-02-24
     */
    public static function pathToSourceCode()
    {
        return \pathinfo(__FILE__, \PATHINFO_DIRNAME) . \DIRECTORY_SEPARATOR;
    }

    /**
     * 
     * @return string
     * @since 18-02-24
     */
    public static function projectName()
    {
        return "DBHandler";
    }

    /**
     * 
     * @return null
     * @since 18-02-24
     */
    public static function projectNamespace()
    {
        return null;
    }

    /**
     * 
     * @return string
     * @since 18-02-24
     */
    public static function projectVendor()
    {
        return "GIndie";
    }

}
