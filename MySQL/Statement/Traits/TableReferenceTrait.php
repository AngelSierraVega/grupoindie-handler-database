<?php

/**
 *
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * @copyright (c) 2018 Angel Sierra Vega. Grupo INDIE.
 *
 * @package GIndie\DBHandler\MySQL\Statement
 * 
 */

namespace GIndie\DBHandler\MySQL\Statement\Traits;

/**
 * DVLP-DBHandler - tableReferenceTrait
 *
 *
 * @since 18-02-15
 * @edit 
 * - Functional trait
 * @edit 18-05-03
 * - Moved file from [base_dir]\MySQL\Statement to [base_dir]\MySQL56\Statement\DataManipulation\Traits
 * - Updated namespace
 * - Updated trait name due to PSR-0 Violation
 * @version 00.AA
 * @edit 18-10-02
 * - Upgraded version
 * @edit 18-11-02
 * - Moved from MySQL56\...
 */
trait TableReferenceTrait
{

    /**
     * @return string
     * @since 18-02-15
     * @edit 18-08-26
     * - Removed " FROM " string
     */
    protected function renderTableReferences()
    {
        return "" . \join(" ", $this->tableReferences);
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
//        var_dump($tableReferences);
        foreach ($tableReferences as $key => $value) {
            switch (true)
            {
                case \is_array($value):
                    foreach ($value as $tmpValue) {
                        if (\substr_count($tmpValue, "LEFT JOIN") > 0) {
                            $this->tableReferences["{$key}.{$tmpValue}"] = "{$tmpValue}";
//                        }if (\substr_count($tmpValue, "LEFT OUTER JOIN") > 0) {
//                            $this->tableReferences["{$key}.{$tmpValue}"] = "{$tmpValue}";
                        } else {
                            $this->tableReferences["{$key}.{$tmpValue}"] = "`{$key}`.`{$tmpValue}`";
                        }
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
//        var_dump($this->tableReferences);
        return $this;
    }

    /**
     *
     * @var array 
     * @since 18-02-15
     */
    private $tableReferences;

}
