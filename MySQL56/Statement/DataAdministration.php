<?php

/**
 * GI-DBHandler-DVLP - DataAdministration
 *
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * @copyright (c) 2018 Angel Sierra Vega. Grupo INDIE.
 *
 * @package GIndie\DBHandler
 *
 * @version 0A.00
 * @since 18-08-16
 */

namespace GIndie\DBHandler\MySQL56\Statement;

/**
 * Description of DataAdministration
 * 
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
