<?php

/**
 * GI-DBHandler-DVLP - DataManipulation
 *
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * @copyright (CC) 2020 Angel Sierra Vega. Grupo INDIE.
 * @license file://LICENSE
 *
 * @package GIndie\DBHandler\MySQL57\Statement
 *
 * @version DOING
 * @since 18-02-15
 * @todo Upgrade DocBlock
 */

namespace GIndie\DBHandler\MySQL57\Statement;

/**
 * @edit 18-02-15
 * - Defined traits
 * @edit 18-05-03
 * - Factory class
 * - Created select()
 * - Moved traits to [current]\DataManipulation\DataManipulationStatement
 * @edit 18-08-26
 * - Created insert()
 * @since 18-08-29
 * - Created delete()
 * @edit 18-10-02
 * - Upgraded version
 * @edit 18-11-02
 * - Copied code from MySQL56\...
 */
class DataManipulation
{

    /**
     * 
     * @param array $selectors
     * @param array $tableReferences
     * 
     * @return \GIndie\DBHandler\MySQL57\Statement\DataManipulation\Select
     * 
     * @since 18-02-15
     */
    public static function select(array $selectors, array $tableReferences)
    {
        return new DataManipulation\Select($selectors, $tableReferences);
    }

    /**
     * 
     * @param array $tableReferences
     * @param array $insertData
     * @return \GIndie\DBHandler\MySQL57\Statement\DataManipulation\Insert
     * @since 18-08-26
     */
    public static function insert(array $tableReferences, array $insertData)
    {
        return new DataManipulation\Insert($tableReferences, $insertData);
    }

    /**
     * 
     * @param array $tableReferences
     * @return \GIndie\DBHandler\MySQL57\Statement\DataManipulation\Delete
     * @since 18-08-29
     */
    public static function delete(array $tableReferences)
    {
        return new DataManipulation\Delete($tableReferences);
    }

}
