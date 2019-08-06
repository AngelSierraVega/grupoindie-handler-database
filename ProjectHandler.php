<?php

/**
 * DVLP-DBHandler - ProjectHandler
 *
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * @copyright (c) 2018 Angel Sierra Vega. Grupo INDIE.
 *
 * @package GIndie\DBHandler\Components
 *
 * @since 18-02-24
 * @version 00.9E
 *
 */

namespace GIndie\DBHandler;

/**
 * 
 * @edit 18-02-24
 * - Added code from GI-CMMN
 * @edit 18-05-19
 * - extends \GIndie\ProjectHandler\AbstractProjectHandler
 * @edit 18-10-02
 * - Upgraded version
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
     * @edit 18-10-02
     * - Upgraded project versions 
     */
    public static function versions()
    {
//        $rtnArray = parent::versions();
        $rtnArray = [];

        $rtnArray[\hexdec("00.01")]["description"] = "Cero";
        $rtnArray[\hexdec("00.01")]["code"] = "Cero";
        $rtnArray[\hexdec("00.01")]["threshold"] = "00.01";

        $rtnArray[\hexdec("00.30")]["description"] = "Functional project for FacturacionExterna";
        $rtnArray[\hexdec("00.30")]["code"] = "FP-FE";
        $rtnArray[\hexdec("00.30")]["threshold"] = "00.30";

        $rtnArray[\hexdec("00.70")]["description"] = "Upgrade generic MySQL to specific MySQL56 functionality";
        $rtnArray[\hexdec("00.70")]["code"] = "MySQL-MySQL56";
        $rtnArray[\hexdec("00.70")]["threshold"] = "00.70";

        //00.8D
        $rtnArray[\hexdec("00.8D")]["description"] = "Functional framework implementation for deployer.";
        $rtnArray[\hexdec("00.8D")]["code"] = "DPLYR-Funct";
        $rtnArray[\hexdec("00.8D")]["threshold"] = "00.8D";

        //00.8D
        $rtnArray[\hexdec("00.93")]["description"] = "Upgrade from MySQL56 to MySQL57.";
        $rtnArray[\hexdec("00.93")]["code"] = "PGRD-MySQL57";
        $rtnArray[\hexdec("00.93")]["threshold"] = "00.93";

        //00.9A
        $rtnArray[\hexdec("00.9A")]["description"] = "Goodbye 2018";
        $rtnArray[\hexdec("00.9A")]["code"] = "GDBYE-2018";
        $rtnArray[\hexdec("00.9A")]["threshold"] = "00.9A";

        //00.9D
        $rtnArray[\hexdec("00.9D")]["description"] = "Methods for BuscadorRUEyAC (A)";
        $rtnArray[\hexdec("00.9D")]["code"] = "UPDT-RUEyAC-A";
        $rtnArray[\hexdec("00.9D")]["threshold"] = "00.9D";
        
        //00.9E
        $rtnArray[\hexdec("00.9E")]["description"] = "Methods for BuscadorRUEyAC (B)";
        $rtnArray[\hexdec("00.9E")]["code"] = "UPDT-RUEyAC-B";
        $rtnArray[\hexdec("00.9E")]["threshold"] = "00.9E";

        $rtnArray[\hexdec("00.B0")]["description"] = "Upgrade DBHandler for MMR-PRDL";
        $rtnArray[\hexdec("00.B0")]["code"] = "FP-MMR-PRDL";
        $rtnArray[\hexdec("00.B0")]["threshold"] = "00.B0";


        $rtnArray[\hexdec("01.00")]["description"] = "Release";
        $rtnArray[\hexdec("01.00")]["code"] = "One";
        $rtnArray[\hexdec("01.00")]["threshold"] = "01.00";

//        $rtnArray[\hexdec("0B.00")]["description"] = "";
//        $rtnArray[\hexdec("0B.00")]["code"] = "BetaCero";
//        $rtnArray[\hexdec("0B.00")]["threshold"] = "0B.00";
//        \ksort($rtnArray);
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
