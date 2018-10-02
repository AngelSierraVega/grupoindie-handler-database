<?php

namespace GIndie\DBHandler\MySQL56\Statement\DataManipulation\Traits;

/**
 * DVLP-DBHandler - selectorTrait
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
 * - Created $selectors, setSelectors(), renderSelectors()
 * @version A0
 * @edit 18-05-03
 * - Moved file from [base_dir]\MySQL\Statement to [base_dir]\MySQL56\Statement\DataManipulation\Traits
 * - Updated namespace
 * - Updated trait name due to PSR-0 Violation
 * @version 00.A3
 * @edit 18-10-02
 * - Upgraded version
 * @todo 
 * - Create addSelector()
 */
trait SelectorTrait
{

    /**
     * 
     * @return string
     * 
     * @since 18-02-15
     */
    protected function renderSelectors()
    {
        return " " . \join(", ", $this->selectors);
    }

    /**
     * 
     * @param array $selectors
     * 
     * @return $this
     * 
     * @since 18-02-15
     */
    public function setSelectors(array $selectors)
    {
        $this->selectors = [];
        foreach ($selectors as $key => $value) {
            switch (true)
            {
                case \is_array($value):
                    foreach ($value as $tmpValue) {
                        $this->selectors["{$key}.{$tmpValue}"] = "`{$key}`.`{$tmpValue}`";
                    }
                    break;
                case \is_int($key):
                    $this->selectors[$value] = $this->getFormatedValue($value);
                    break;
                default:
                    $this->selectors["{$key}.{$value}"] = "`{$key}`.`{$value}`";
                    break;
            }
        }
        return $this;
    }

    /**
     * 
     * @param string $value
     * @return string
     * @since 18-02-15
     * @edit 18-08-13
     * - Removed ` from custom value
     */
    protected function getFormatedValue($value)
    {
        $rtnValue = "";
        switch ($value)
        {
            case "*":
                $rtnValue = $value;
                break;
            default:
//                $rtnValue = "`{$value}`";
                $rtnValue = $value;
                break;
        }
        return $rtnValue;
    }

    /**
     *
     * @var array 
     * @since 18-02-15
     */
    private $selectors;

}
