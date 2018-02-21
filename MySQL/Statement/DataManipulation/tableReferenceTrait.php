<?php

namespace GIndie\DBHandler\MySQL\Statement\DataManipulation;

/**
 * DVLP-DBHandler - tableReferenceTrait
 *
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * @copyright (c) 2018 Angel Sierra Vega. Grupo INDIE.
 *
 * @package DatabaseHandler
 *
 * @version GI-DBH.00.00 18-02-15 Empty trait created.
 */
trait tableReferenceTrait
{

    /**
     * 
     * @return string
     * 
     * @since GI-DBH.00.01
     */
    protected function renderTableReferences()
    {
        return " FROM " . \join(", ", $this->tableReferences);
    }

    /**
     * 
     * @param array $selectors
     * 
     * @return $this
     * 
     * @since GI-DBH.00.01
     */
    public function setTableReferences(array $tableReferences)
    {
        $this->tableReferences = [];
        foreach ($tableReferences as $key => $value) {
            switch (true)
            {
                case \is_array($value):
                    foreach ($value as $tmpValue) {
                        $this->tableReferences["{$key}.{$tmpValue}"] = "`{$key}`.`{$tmpValue}`";
                    }
                    break;
                case \is_int($key):
                    $this->tableReferences[$value] = "`{$value}`";
                    break;
                default:
                    $this->tableReferences["{$key}.{$value}"] = "`{$key}`.`{$value}`";
                    break;
            }
        }
        return $this;
    }

    /**
     *
     * @var array 
     * @since GI-DBH.00.01
     */
    private $tableReferences;

}
