<?php

/**
 *
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * @copyright (CC) 2020 Angel Sierra Vega. Grupo INDIE.
 * @license file://LICENSE
 *
 * @package GIndie\DBHandler\MySQL\Statement
 * 
 */

namespace GIndie\DBHandler\MySQL\Statement\Traits;

/**
 * DVLP-DBHandler - selectorTrait
 * 
 *
 * @since 18-02-15
 * @edit
 * - Created $selectors, setSelectors(), renderSelectors()
 * @version A0
 * @edit 18-05-03
 * - Moved file from [base_dir]\MySQL\Statement to [base_dir]\MySQL56\Statement\DataManipulation\Traits
 * - Updated namespace
 * - Updated trait name due to PSR-0 Violation
 * @version 00.A7
 * @edit 18-10-02
 * - Upgraded version
 * @edit 18-11-02
 * - Moved from MySQL56\...
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
     * @edit 18-11-15
     * - Upgraded behaviour when is nested array
     */
    public function setSelectors(array $selectors)
    {
        $this->selectors = [];
        foreach ($selectors as $key => $value) {
            switch (true)
            {
                case \is_array($value):
                    foreach ($value as $tmpKey => $tmpValue) {
                        if(\is_int($key)){
                            $this->selectors["{$tmpKey}.{$tmpValue}"] = "`{$tmpKey}`.`{$tmpValue}`";
                        }else{
                            $this->selectors["{$key}.{$tmpValue}"] = "`{$key}`.`{$tmpValue}`";
                        }
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
