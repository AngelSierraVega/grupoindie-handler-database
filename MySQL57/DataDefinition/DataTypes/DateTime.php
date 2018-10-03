<?php

/**
 * GI-DBHandler-DVLP - DateTime
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
interface DateTime
{

    /**
     * 
     * @since 18-04-26 
     * @edit 18-05-01
     */
    const DATATYPE_DATE = "DATE";

    /**
     * @since 18-04-26 
     * @edit 18-05-01
     */
    const DATATYPE_DATETIME = "DATETIME";

    /**
     * @since 18-04-26 
     * @edit 18-05-01
     */
    const DATATYPE_TIMESTAMP = "TIMESTAMP";

    /**
     * @since 18-04-26 
     * @edit 18-05-01
     */
    const DATATYPE_TIME = "TIME";

    /**
     * @since 18-04-26 
     * @edit 18-05-01
     */
    const DATATYPE_YEAR = "YEAR";

}
