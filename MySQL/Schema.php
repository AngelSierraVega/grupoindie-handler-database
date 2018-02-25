<?php

namespace GIndie\DBHandler\MySQL;

/**
 * DVLP-DBHandler - Schema
 *
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * @copyright (c) 2018 Angel Sierra Vega. Grupo INDIE.
 *
 * @package DatabaseHandler
 *
 * @version GI-DBH.00.00 18-02-14 Empty class created.
 * - Class implements \GIndie\DBHandler\Interfaces\Schema
 * - Abstract class
 * @edit 18-04-06
 * - Added charset(), collation()
 * @deprecated since 18-04-30
 * - Moved code to ..\MySQL56\Handler\Database, ..\MySQL56\Instance\Database
 * - Class extends \GIndie\DBHandler\MySQL56\Handler\Database
 */
abstract class Schema extends \GIndie\DBHandler\MySQL56\Handler\Database
{
    
}
