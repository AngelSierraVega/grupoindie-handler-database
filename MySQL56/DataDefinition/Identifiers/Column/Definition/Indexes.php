<?php

/**
 * GI-DBHandler-DVLP - Indexes
 *
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * @copyright (c) 2018 Angel Sierra Vega. Grupo INDIE.
 *
 * @package GIndie\DBHandler
 *
 * @version DEPRECATED
 * @since 18-08-18
 */

namespace GIndie\DBHandler\MySQL56\DataDefinition\Identifiers\Column\Definition;

/**
 *  Several keywords apply to creation of indexes and foreign keys. For general 
 * background in addition to the following descriptions, see Section 13.1.13, 
 * “CREATE INDEX Syntax”, and Section 13.1.17.6, “Using FOREIGN KEY Constraints”.
 * 
 *     CONSTRAINT symbol
 *     If the CONSTRAINT symbol clause is given, the symbol value, if used, must be 
 * unique in the database. A duplicate symbol results in an error. If the clause 
 * is not given, or a symbol is not included following the CONSTRAINT keyword, 
 * a name for the constraint is created automatically.
 * 
 * 
 *     KEY | INDEX
 *     KEY is normally a synonym for INDEX. The key attribute PRIMARY KEY can 
 * also be specified as just KEY when given in a column definition. This was 
 * implemented for compatibility with other database systems.
 * 
 * 
 *     FULLTEXT
 *     A FULLTEXT index is a special type of index used for full-text searches. 
 * Only the InnoDB and MyISAM storage engines support FULLTEXT indexes. They can 
 * be created only from CHAR, VARCHAR, and TEXT columns. Indexing always happens 
 * over the entire column; column prefix indexing is not supported and any 
 * prefix length is ignored if specified. See Section 12.9, “Full-Text Search 
 * Functions”, for details of operation. A WITH PARSER clause can be specified 
 * as an index_option value to associate a parser plugin with the index if 
 * full-text indexing and searching operations need special handling. This 
 * clause is valid only for FULLTEXT indexes. See Section 24.2, “The MySQL 
 * Plugin API”, for details on creating plugins.
 * 
 *     SPATIAL
 *     You can create SPATIAL indexes on spatial data types. Spatial types are 
 * supported only for MyISAM tables and indexed columns must be declared as NOT 
 * NULL. See Section 11.5, “Spatial Data Types”.
 * 
 *     FOREIGN KEY
 *     MySQL supports foreign keys, which let you cross-reference related data 
 * across tables, and foreign key constraints, which help keep this spread-out 
 * data consistent. For definition and option information, see 
 * reference_definition, and reference_option.
 * 
 *     Partitioned tables employing the InnoDB storage engine do not support 
 * foreign keys. See Section 19.6, “Restrictions and Limitations on 
 * Partitioning”, for more information.
 * 
 *     CHECK
 *     The CHECK clause is parsed but ignored by all storage engines. See 
 * Section 1.7.2.3, “Foreign Key Differences”. 
 * 
 * @link <https://dev.mysql.com/doc/refman/5.6/en/create-table.html#create-table-indexes-keys>
 * 
 *
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * @deprecated since 18-08-26
 * @edit 18-10-02
 * - Upgraded version
 */
interface Indexes
{

    /**
     *     PRIMARY KEY
     *     A unique index where all key columns must be defined as NOT NULL. If they are 
     * not explicitly declared as NOT NULL, MySQL declares them so implicitly (and 
     * silently). A table can have only one PRIMARY KEY. The name of a PRIMARY KEY 
     * is always PRIMARY, which thus cannot be used as the name for any other kind 
     * of index.
     *     If you do not have a PRIMARY KEY and an application asks for the PRIMARY KEY 
     * in your tables, MySQL returns the first UNIQUE index that has no NULL columns 
     * as the PRIMARY KEY.
     *     In InnoDB tables, keep the PRIMARY KEY short to minimize storage overhead for
     * secondary indexes. Each secondary index entry contains a copy of the primary 
     * key columns for the corresponding row. (See Section 14.8.2.1, “Clustered and 
     * Secondary Indexes”.)
     *     In the created table, a PRIMARY KEY is placed first, followed by all UNIQUE 
     * indexes, and then the nonunique indexes. This helps the MySQL optimizer to 
     * prioritize which index to use and also more quickly to detect duplicated 
     * UNIQUE keys.
     *     A PRIMARY KEY can be a multiple-column index. However, you cannot create a 
     * multiple-column index using the PRIMARY KEY key attribute in a column 
     * specification. Doing so only marks that single column as primary. 
     * You must use a separate PRIMARY KEY(key_part, ...) clause.
     *     If a table has a PRIMARY KEY or UNIQUE NOT NULL index that consists of a 
     * single column that has an integer type, you can use _rowid to refer to the 
     * indexed column in SELECT statements, as described in Unique Indexes.
     *     In MySQL, the name of a PRIMARY KEY is PRIMARY. For other indexes, if you 
     * do not assign a name, the index is assigned the same name as the first 
     * indexed column, with an optional suffix (_2, _3, ...) to make it unique. You 
     * can see index names for a table using SHOW INDEX FROM tbl_name. See Section 
     * 13.7.5.23, “SHOW INDEX Syntax”.
     * @since 18-08-18
     */
    const IDX_PRIMARY_KEY = "PRIMARY KEY";

    /**
     * 
     * UNIQUE
     *     A UNIQUE index creates a constraint such that all values in the index 
     * must be distinct. An error occurs if you try to add a new row with a key 
     * value that matches an existing row. For all engines, a UNIQUE index permits 
     * multiple NULL values for columns that can contain NULL. If you specify a 
     * prefix value for a column in a UNIQUE index, the column values must be unique 
     * within the prefix length.
     *     If a table has a PRIMARY KEY or UNIQUE NOT NULL index that consists of a 
     * single column that has an integer type, you can use _rowid to refer to the 
     * indexed column in SELECT statements, as described in Unique Indexes.
     * @since 18-08-18
     */
    const IDX_UNIQUE = "UNIQUE";

    /**
     * 
     * @param string $index
     * @since 18-08-18
     */
    public function addIndex($index);
}
