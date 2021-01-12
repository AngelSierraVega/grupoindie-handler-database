<?php

/**
 * GI-DBHandler-DVLP - DataManipulation
 *
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * @copyright (CC) 2020 Angel Sierra Vega. Grupo INDIE.
 * @license file://LICENSE
 *
 * @package GIndie\DBHandler\MySQL56\Statement
 *
 * @version 00.60
 * @since 18-02-15
 */

namespace GIndie\DBHandler\MySQL56\Statement;

use GIndie\DBHandler\MySQL\Statement\DataManipulation AS Traits;

/**
 * 
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
 */
class DataManipulation
{

    /**
     * 
     * @param array $selectors
     * @param array $tableReferences
     * 
     * @return \GIndie\DBHandler\MySQL56\Statement\DataManipulation\Select
     * 
     * @since 18-02-15
     * @edit 18-05-03
     * - Copied method from [base_dir]\MySQL\Statement to [base_dir]\MySQL56\Statement
     */
    public static function select(array $selectors, array $tableReferences)
    {
        return new DataManipulation\Select($selectors, $tableReferences);
    }

    /**
     * INSERT inserts new rows into an existing table. The INSERT ... VALUES and 
     * INSERT ... SET forms of the statement insert rows based on explicitly 
     * specified values. The INSERT ... SELECT form inserts rows selected from 
     * another table or tables. INSERT with an ON DUPLICATE KEY UPDATE clause 
     * enables existing rows to be updated if a row to be inserted would cause a 
     * duplicate value in a UNIQUE index or PRIMARY KEY.
     * 
     * Inserting into a table requires the INSERT privilege for the table. If the ON
     * DUPLICATE KEY UPDATE clause is used and a duplicate key causes an UPDATE to 
     * be performed instead, the statement requires the UPDATE privilege for the 
     * columns to be updated. For columns that are read but not modified you need 
     * only the SELECT privilege (such as for a column referenced only on the right 
     * hand side of an col_name=expr assignment in an ON DUPLICATE KEY UPDATE 
     * clause).
     * 
     * When inserting into a partitioned table, you can control which partitions and 
     * subpartitions accept new rows. The PARTITION option takes a list of the 
     * comma-separated names of one or more partitions or subpartitions (or both) of
     * the table. If any of the rows to be inserted by a given INSERT statement do 
     * not match one of the partitions listed, the INSERT statement fails with the 
     * error Found a row not matching the given partition set. For more information 
     * and examples, see Section 19.5, “Partition Selection”.
     * 
     * You can use REPLACE instead of INSERT to overwrite old rows. REPLACE is the 
     * counterpart to INSERT IGNORE in the treatment of new rows that contain unique 
     * key values that duplicate old rows: The new rows replace the old rows rather 
     * than being discarded. See Section 13.2.8, “REPLACE Syntax”. 
     * 
     * @link <https://dev.mysql.com/doc/refman/5.6/en/insert.html>
     * 
     * @param array $tableReferences
     * @param array $insertData
     * @return \GIndie\DBHandler\MySQL56\Statement\DataManipulation\Insert
     * @since 18-08-26
     */
    public static function insert(array $tableReferences, array $insertData)
    {
        return new DataManipulation\Insert($tableReferences, $insertData);
    }

    /**
     * 
     * @param array $tableReferences
     * @return \GIndie\DBHandler\MySQL56\Statement\DataManipulation\Delete
     * @since 18-08-29
     */
    public static function delete(array $tableReferences)
    {
        return new DataManipulation\Delete($tableReferences);
    }

}
