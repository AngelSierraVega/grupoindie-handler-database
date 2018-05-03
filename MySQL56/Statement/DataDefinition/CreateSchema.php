<?php

namespace GIndie\DBHandler\MySQL56\Statement\DataDefinition;

/**
 * GI-DBHandler-DVLP - CreateSchema
 * 
 * MySQL 5.6 implementation: CREATE {DATABASE | SCHEMA} [IF NOT EXISTS] db_name
 * [DEFAULT] CHARACTER SET [=] charset_name
 * [DEFAULT] COLLATE [=] collation_name
 * 
 * @link <https://dev.mysql.com/doc/refman/5.6/en/create-database.html>
 * 
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * @copyright (c) 2018 Angel Sierra Vega. Grupo INDIE.
 *
 * @package DatabaseHandler
 * @subpackage MySQL56
 *
 * @since 18-04-07
 * @version AO
 * 
 * @edit 18-05-03
 * - Moved file from [base_dir]\MySQL\Statement to [base_dir]\MySQL56\Statement\DataDefinition
 * - Updated namespace
 * - Class extends DataDefinitionStatement
 * @version A1
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
