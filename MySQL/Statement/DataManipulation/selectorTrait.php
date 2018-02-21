<?php

namespace GIndie\DBHandler\MySQL\Statement\DataManipulation;

/**
 * DVLP-DBHandler - selectorTrait
 * 
 * @link <https://dev.mysql.com/doc/refman/5.7/en/select.html>
 *
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * @copyright (c) 2018 Angel Sierra Vega. Grupo INDIE.
 *
 * @package DatabaseHandler
 *
 * @version GI-DBH.00.00 18-02-15 Empty trait created.
 * @edit GI-DBH.00.01
 * - Created $selectors, setSelectors(), renderSelectors()
 * @todo 
 * - Create addSelector()
 */
trait selectorTrait
{

    /**
     * 
     * @return string
     * 
     * @since GI-DBH.00.01
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
     * @since GI-DBH.00.01
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

    protected function getFormatedValue($value)
    {
        $rtnValue = "";
        switch ($value)
        {
            case "*":
                $rtnValue = $value;
                break;
            default:
                $rtnValue = "`{$value}`";
                break;
        }
        return $rtnValue;
    }

    /**
     *
     * @var array 
     * @since GI-DBH.00.01
     */
    private $selectors;

}
