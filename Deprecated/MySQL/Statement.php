<?php

namespace GIndie\DBHandler\MySQL;

use GIndie\DBHandler\MySQL56;

/**
 * DVLP-DBHandler - Statement
 *
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * @copyright (c) 2018 Angel Sierra Vega. Grupo INDIE.
 *
 * @package DatabaseHandler
 * 
 * @since 18-02-14
 * @version 00
 * @edit 18-02-15
 * - Created select()
 * @edit 18-04-07
 * - Created createSchema()
 * @version A0
 * @deprecated since 18-05-02
 * @edit 18-05-02
 * - Moved file from [base_dir]\MySQL to [base_dir]\Deprecated\MySQL
 * @edit 18-05-03
 * - Updated class
 * @version A1.00
 */
class Statement
{

    /**
     * 
     * @param array $selectors
     * @param array $tableReferences
     * 
     * @return \GIndie\DBHandler\MySQL56\Statement\DataManipulation\Select
     * 
     * @since 18-02-15
     * @deprecated since 18-05-02 use MySQL56\Statement\DataManipulation::select instead
     * @edit 18-05-03
     * - Use MySQL56\Statement\DataManipulation
     * - Updated return type
     */
    public static function select(array $selectors, array $tableReferences)
    {
        return MySQL56\Statement\DataManipulation::select($selectors, $tableReferences);
    }

    /**
     * 
     * @param string $name
     * @param string $characterSet
     * @param string $collation
     * @return \GIndie\DBHandler\MySQL56\Statement\DataDefinition\CreateSchema
     * @since 18-04-07
     * @deprecated since 18-05-02. Use MySQL56\Statement\DataDefinition::createDatabase instead
     * @edit 18-05-03
     * - Use MySQL56\Statement\DataDefinition
     * - Updated return type
     */
    public static function createSchema($name, $characterSet, $collation)
    {
        return MySQL56\Statement\DataDefinition::createDatabase($name, $characterSet, $collation);
    }

}
