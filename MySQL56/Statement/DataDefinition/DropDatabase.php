<?php

/**
 * GI-DBHandler-DVLP - DropDatabase
 *
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * @copyright (c) 2018 Angel Sierra Vega. Grupo INDIE.
 *
 * @package GIndie\DBHandler
 *
 * @version 0A.30
 * @since 18-08-02
 */

namespace GIndie\DBHandler\MySQL56\Statement\DataDefinition;

/**
 * DROP DATABASE drops all tables in the database and deletes the database. Be 
 * very careful with this statement! To use DROP DATABASE, you need the DROP 
 * privilege on the database. DROP SCHEMA is a synonym for DROP DATABASE. 
 * 
 * IF EXISTS is used to prevent an error from occurring if the database does 
 * not exist.
 * 
 * If the default database is dropped, the default database is unset (the 
 * DATABASE() function returns NULL).
 * 
 * If you use DROP DATABASE on a symbolically linked database, both the link and 
 * the original database are deleted.
 * 
 * DROP DATABASE returns the number of tables that were removed. This 
 * corresponds to the number of .frm files removed.
 * 
 * The DROP DATABASE statement removes from the given database directory those 
 * files and directories that MySQL itself may create during normal operation
 * 
 * DROP {DATABASE | SCHEMA} [IF EXISTS] db_name
 * 
 * @link <https://dev.mysql.com/doc/refman/5.6/en/drop-database.html>
 * 
 *
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
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
