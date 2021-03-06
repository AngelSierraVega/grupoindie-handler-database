<?php

/**
 * GI-DBHandler-DVLP - InsertDataTrait
 *
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * @copyright (CC) 2020 Angel Sierra Vega. Grupo INDIE.
 * @license file://LICENSE
 *
 * @package GIndie\DBHandler\MySQL\Statement
 *
 * @version 00.AB
 * @since 18-08-26
 */

namespace GIndie\DBHandler\MySQL\Statement\Traits;

/**
 * Description of InsertDataTrait
 *
 * @edit 18-08-27
 * - Updated insertRecordData()
 * @edit 18-10-02
 * - Upgraded version
 * @edit 18-11-02
 * - Moved from MySQL56\...
 */
trait InsertDataTrait
{

    /**
     * 
     * @param array $insertData
     * @return $this
     * @throwsDPR \Exception
     * @since 18-08-26
     * @edit 19-12-21
     * - Removed exception
     */
    public function setInsertData(array $insertData)
    {
        $this->insertValues = [];
        $this->columnNames = [];
        $tmpEval = false;
        foreach ($insertData as $key => $value) {
            switch (true) {
                case \is_string($key) === true:
                    $tmpEval = true;
                    break;
                case $tmpEval === true:
                    break;
                case \is_array($value) === true:
                    $this->insertRecordData($value);
                    break;
                default:
                    \trigger_error("Error on data: key not defined. " . print_r($insertData), \E_USER_ERROR);
                    //throw new \Exception("todo setInsertData of type NOT array");
                    break;
            }
        }
        if ($tmpEval === true) {
            $this->insertRecordData($insertData);
        }
        return $this;
    }

    /**
     * 
     * @param mixed $value
     * @return mixed
     * @since 18-08-26
     * @todo
     * - ¿Return string exclusively?
     */
    protected function getFormattedValue($value)
    {
        $rtnValue;
        switch (true) {
            case \is_string($value) === true:
                $rtnValue = "\"{$value}\"";
                break;
            case \is_null($value) === true:
                $rtnValue = "NULL";
                break;
            default:
                $rtnValue = $value;
                break;
        }
        return $rtnValue;
    }

    /**
     * 
     * @param array $recordData
     * 
     * @return $this
     * 
     * @since 18-08-26
     * @edit 18-08-27
     * - Bug on columnames
     */
    public function insertRecordData(array $recordData)
    {
        foreach ($recordData as $key => $value) {
            switch (true) {
                case \is_string($key):
                    //$this->columnNames["`{$key}_test`"] = true;
                    $this->columnNames["`{$key}`"] = true;
                    $recordData[$key] = $this->getFormattedValue($value);
                    break;
                default:
                    throw new \Exception("todo insertRecordData of type NOT string");
                    break;
            }
        }
        $this->insertValues[] = "(" . \join(",", \array_values($recordData)) . ")";
        return $this;
    }

    /**
     * 
     * @return string
     * 
     * @since 18-08-26
     */
    protected function renderInsertData()
    {
        return \count($this->insertValues) == 0 ? "" : " (" . \join(",", \array_keys($this->columnNames)) . ") VALUES " . \join(", ", $this->insertValues);
    }

    /**
     *
     * @var array 
     * @since 18-08-26
     */
    private $insertValues = [];

    /**
     *
     * @var array 
     * @since 18-08-26
     */
    private $columnNames = [];

}
