<?php

namespace GIndie\DBHandler\MySQL\Statement;

/**
 * GI-DBHandler-DVLP - CreateSchema
 * 
 * @link <https://dev.mysql.com/doc/refman/5.6/en/create-database.html>
 * CREATE {DATABASE | SCHEMA} [IF NOT EXISTS] db_name
 * [DEFAULT] CHARACTER SET [=] charset_name
 * [DEFAULT] COLLATE [=] collation_name
 *
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * @copyright (c) 2018 Angel Sierra Vega. Grupo INDIE.
 *
 * @package DatabaseHandler
 *
 * @version AO
 * @since 18-04-07
 */
class CreateSchema extends DataDefinition
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
