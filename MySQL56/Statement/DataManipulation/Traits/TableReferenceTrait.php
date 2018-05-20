<?php

namespace GIndie\DBHandler\MySQL56\Statement\DataManipulation\Traits;

/**
 * DVLP-DBHandler - tableReferenceTrait
 *
 * @link <https://dev.mysql.com/doc/refman/5.6/en/select.html>
 *
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * @copyright (c) 2018 Angel Sierra Vega. Grupo INDIE.
 *
 * @package GIndie\DBHandler\MySQL56\Statement
 *
 * @since 18-02-15
 * @edit 
 * - Functional trait
 * @version A0
 * @edit 18-05-03
 * - Moved file from [base_dir]\MySQL\Statement to [base_dir]\MySQL56\Statement\DataManipulation\Traits
 * - Updated namespace
 * - Updated trait name due to PSR-0 Violation
 * @version 0A.10
 */
trait TableReferenceTrait
{

    /**
     * @return string
     * @since 18-02-15
     */
    protected function renderTableReferences()
    {
        return " FROM " . \join(", ", $this->tableReferences);
    }

    /**
     * @param array $selectors
     * @return $this
     * 
     * @since 18-02-15
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
     * @since 18-02-15
     */
    private $tableReferences;

}
