<?php

/**
 * GI-DBHandler-DVLP - CreateSchema
 *
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * @copyright (CC) 2020 Angel Sierra Vega. Grupo INDIE.
 * @license file://LICENSE
 *
 * @package GIndie\DBHandler\MySQL57\Statement
 *
 * @version 00.90
 * @since 18-04-07
 * @todo Upgrade DocBlock to MySQL57
 */

namespace GIndie\DBHandler\MySQL57\Statement\DataDefinition;

/**
 * @edit 18-05-03
 * - Moved file from [base_dir]\MySQL\Statement to [base_dir]\MySQL56\Statement\DataDefinition
 * - Updated namespace
 * - Class extends DataDefinitionStatement
 * @edit 18-10-02
 * - Upgraded version
 * @edit 18-11-02
 * - Copied code from GIndie\DBHandler\MySQL56\...
 */
class CreateSchema extends DataDefinitionStatement
{

    /**
     * 
     * @param string $name
     * @param string $characterSet
     * @param string $collation
     * @since 18-04-07
     */
    public function __construct($name, $characterSet, $collation)
    {
        $this->name = $name;
        $this->characterSet = $characterSet;
        $this->collation = $collation;
    }

    /**
     * 
     * @return string
     * @since 18-04-07
     */
    public function __toString()
    {
        return "CREATE SCHEMA IF NOT EXISTS `{$this->name}` "
                . "DEFAULT CHARACTER SET `{$this->characterSet}` "
                . "DEFAULT COLLATE `{$this->collation}`;";
    }

    /**
     *
     * @var string 
     * @since 18-04-10
     */
    private $name;

    /**
     *
     * @var string 
     * @since 18-04-10
     */
    private $characterSet;

    /**
     *
     * @var string 
     * @since 18-04-10
     */
    private $collation;

}