<?php

/**
 * GI-DBHandler-DVLP - ReferenceDefinition
 *
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * @copyright (c) 2018 Angel Sierra Vega. Grupo INDIE.
 *
 * @package GIndie\DBHandler
 *
 * @version 0A.70
 * @since 18-08-20
 */

namespace GIndie\DBHandler\MySQL56\Instance;

/**
 * Description of ReferenceDefinition
 * 
 */
class ReferenceDefinition
{

    /**
     *
     * @var array
     * @since 18-08-20
     */
    private $references = [];

    /**
     * 
     * @return array
     * @since 18-08-20
     */
    public function getReferences()
    {
        return $this->references;
    }

    /**
     * 
     * @param string $reference
     * @return \GIndie\DBHandler\MySQL56\Instance\ReferenceDefinition
     * @since 18-08-20
     */
    public function setPrimaryKey($reference)
    {
        $this->references[] = "PRIMARY KEY (`{$reference}`)";
        return $this;
    }

    /**
     * 
     * @param string $columnName
     * @param boolean|string $fullKeyname
     * @return \GIndie\DBHandler\MySQL56\Instance\ReferenceDefinition
     * @throws \Exception
     * @since 18-08-20
     */
    public function addUniqueKey($columnName, $fullKeyname = false)
    {
        switch (true)
        {
            case ($fullKeyname === true):
                $this->references[] = "UNIQUE KEY `idxnq_{$columnName}` (`{$columnName}`)";
                break;
            case ($fullKeyname === false):
                $this->references[] = "UNIQUE KEY (`{$columnName}`)";
                break;
            case \is_string($fullKeyname):
                $this->references[] = "UNIQUE KEY `{$fullKeyname}` (`{$columnName}`)";
                break;
            default:
                throw new \Exception("Unrecognized type for {$fullKeyname}");
                break;
        }
        return $this;
    }

}
