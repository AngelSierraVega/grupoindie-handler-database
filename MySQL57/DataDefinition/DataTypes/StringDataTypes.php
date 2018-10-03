<?php

/**
 * GI-DBHandler-DVLP - StringDataTypes
 *
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * @copyright (c) 2018 Angel Sierra Vega. Grupo INDIE.
 *
 * @package GIndie\DBHandler\MySQL57\DataDefinition
 *
 * @version 00.90
 * @since 18-11-02
 * @todo Upgrade DocBlock
 */

namespace GIndie\DBHandler\MySQL57\DataDefinition\DataTypes;

/**
 * 
 * @edit 18-11-02
 * - Copied code from GIndie\DBHandler\MySQL56\...
 */
interface StringDataTypes
{

    /**
     * 
     * @since 18-04-26 
     * @edit 18-05-01
     */
    const DATATYPE_CHAR = "CHAR";

    /**
     * @since 18-04-27 
     * @edit 18-05-01
     */
    const DATATYPE_NCHAR = "NCHAR";

    /**
     * @since 18-04-26 
     * @edit 18-05-01
     */
    const DATATYPE_VARCHAR = "VARCHAR";

    /**
     * @since 18-04-26 
     * @edit 18-05-01
     */
    const DATATYPE_BINARY = "BINARY";

    /**
     * @since 18-04-26 
     * @edit 18-05-01
     */
    const DATATYPE_VARBINARY = "VARBINARY";

    /**
     * @since 18-04-26 
     * @edit 18-05-01
     */
    const DATATYPE_TINYBLOB = "TINYBLOB";

    /**
     * @since 18-04-26 
     * @edit 18-05-01
     */
    const DATATYPE_TINYTEXT = "TINYTEXT";

    /**
     * @since 18-04-26 
     * @edit 18-05-01
     */
    const DATATYPE_BLOB = "BLOB";

    /**
     * @since 18-04-26 
     * @edit 18-05-01
     */
    const DATATYPE_TEXT = "TEXT";

    /**
     * @since 18-04-26 
     * @edit 18-05-01
     */
    const DATATYPE_MEDIUMBLOB = "MEDIUMBLOB";

    /**
     * @since 18-04-26 
     * @edit 18-05-01
     */
    const DATATYPE_MEDIUMTEXT = "MEDIUMTEXT";

    /**
     * @since 18-04-26 
     * @edit 18-05-01
     */
    const DATATYPE_LONGBLOB = "LONGBLOB";

    /**
     * @since 18-04-26 
     * @edit 18-05-01
     */
    const DATATYPE_LONGTEXT = "LONGTEXT";

    /**
     * @since 18-04-26 
     * @edit 18-05-01
     */
    const DATATYPE_ENUM = "ENUM";

    /**
     * @since 18-04-26 
     * @edit 18-05-01
     */
    const DATATYPE_SET = "SET";

}
