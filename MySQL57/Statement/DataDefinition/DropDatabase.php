<?php

/**
 * GI-DBHandler-DVLP - DropDatabase
 *
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * @copyright (CC) 2020 Angel Sierra Vega. Grupo INDIE.
 * @license file://LICENSE
 *
 * @package GIndie\DBHandler\MySQL57\Statement
 *
 * @version 00.90
 * @since 18-08-02
 * @todo Upgrade DocBlock to MySQL57
 */

namespace GIndie\DBHandler\MySQL57\Statement\DataDefinition;

/**
 * 
 * @edit 18-10-02
 * - Upgraded version
 * @edit 18-11-02
 * - Copied code from GIndie\DBHandler\MySQL56\...
 */
class DropDatabase extends DataDefinitionStatement
{

    /**
     *
     * @var string 
     * @since 18-08-02
     */
    private $name;

    /**
     * 
     * @param string $name
     * @since 18-08-02
     */
    public function __construct($name)
    {
        $this->name = $name;
    }

    /**
     * 
     * @return string
     * @since 18-08-02
     */
    public function __toString()
    {
        return "DROP DATABASE IF EXISTS `{$this->name}`;";
    }

}
