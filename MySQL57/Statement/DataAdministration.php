<?php

/**
 * GI-DBHandler-DVLP - DataAdministration
 *
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * @copyright (CC) 2020 Angel Sierra Vega. Grupo INDIE.
 * @license file://LICENSE
 *
 * @package GIndie\DBHandler\MySQL57\Statement
 *
 * @version 00.50
 * @since 18-08-16
 * @todo Upgrade DocBlock
 */

namespace GIndie\DBHandler\MySQL57\Statement;

/**
 * 
 * @edit 18-10-02
 * - Upgraded version
 * @edit 18-11-02
 * - Copied code from MySQL56\...
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
