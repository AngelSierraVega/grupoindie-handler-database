<?php

/**
 * GI-DBHandler-DVLP - Numeric
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
interface Numeric
{

    /**
     * @since 18-04-26 
     * @edit 18-05-01
     */
    const DATATYPE_BIT = "BIT";

    /**
     * @since 18-04-26 
     * @edit 18-05-01
     */
    const DATATYPE_TINYINT = "TINYINT";

    /**
     * @since 18-04-26 
     * @edit 18-05-01
     */
    const DATATYPE_BOOL = "BOOL";

    /**
     * @since 18-04-26 
     * @edit 18-05-01
     */
    const DATATYPE_BOOLEAN = "BOOLEAN";

    /**
     * @since 18-04-26 
     * @edit 18-05-01
     */
    const DATATYPE_SMALLINT = "SMALLINT";

    /**
     * @since 18-04-26 
     * @edit 18-05-01
     */
    const DATATYPE_MEDIUMINT = "MEDIUMINT";

    /**
     * @since 18-04-26 
     * @edit 18-05-01
     */
    const DATATYPE_INT = "INT";

    /**
     * @since 18-04-26 
     * @edit 18-05-01
     */
    const DATATYPE_INTEGER = "INTEGER";

    /**
     * @since 18-04-26 
     * @edit 18-05-01
     */
    const DATATYPE_BIGINT = "BIGINT";

    /**
     * @since 18-04-26 
     * @edit 18-05-01
     */
    const DATATYPE_SERIAL = "SERIAL";

    /**
     * @since 18-04-26 
     * @edit 18-05-01
     */
    const DATATYPE_DECIMAL = "DECIMAL";

    /**
     * @since 18-04-26 
     * @edit 18-05-01
     */
    const DATATYPE_DEC = "DEC";

    /**
     * @since 18-04-26 
     * @edit 18-05-01
     */
    const DATATYPE_NUMERIC = "NUMERIC";

    /**
     * @since 18-04-26 
     * @edit 18-05-01
     */
    const DATATYPE_FIXED = "FIXED";

    /**
     * @since 18-04-26 
     * @edit 18-05-01
     */
    const DATATYPE_FLOAT = "FLOAT";

    /**
     * @since 18-04-26 
     * @edit 18-05-01
     */
    const DATATYPE_DOUBLE = "DOUBLE";

    /**
     * @since 18-04-26 
     * @edit 18-05-01
     */
    const DATATYPE_DOUBLE_PRECISION = "DOUBLE_PRECISION";

    /**
     * @since 18-04-26 
     * @edit 18-05-01
     */
    const DATATYPE_REAL = "REAL";

}
