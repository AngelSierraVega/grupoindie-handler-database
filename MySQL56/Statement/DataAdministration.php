<?php

/**
 * GI-DBHandler-DVLP - DataAdministration
 *
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * @copyright (c) 2018 Angel Sierra Vega. Grupo INDIE.
 *
 * @package GIndie\DBHandler
 *
 * @version 00.30
 * @since 18-08-16
 */

namespace GIndie\DBHandler\MySQL56\Statement;

/**
 * Description of DataAdministration
 * @edit 18-10-02
 * - Upgraded version
 */
class DataAdministration
{

    /**
     * 
     * @param type $tableName
     * @return \GIndie\DBHandler\MySQL56\Statement\DataAdministration\ShowColumns
     * @since 18-08-16
     */
    public static function showColulmns($tableName)
    {
        return new DataAdministration\ShowColumns($tableName);
    }

}
