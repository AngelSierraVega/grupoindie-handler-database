<?php

/**
 * GI-DBHandler-DVLP - DataType
 *
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * @copyright (CC) 2020 Angel Sierra Vega. Grupo INDIE.
 * @license file://LICENSE
 *
 * @package GIndie\DBHandler\MySQL57\Instance
 *
 * @version DOING
 * @since 18-11-02
 */

namespace GIndie\DBHandler\MySQL57\Instance;

use GIndie\DBHandler\MySQL57\DataDefinition\DataTypes;

/**
 * @edit 18-07-31
 * - Added params $datatype, $unzigned, $m, $zerofill
 * - Added integer(), __construct(), setM(), getM(), setUnzigned(), getUnzigned()
 * - Added settZerofill(), getZerofill()
 * @edit 18-08-01
 * - Renamed class from ColumnType to DataType
 * @edit 18-08-02
 * - Added blob()
 * @edit 18-08-16
 * - Updated methods.
 * @edit 18-08-26
 * - Added bigint(), serializedBigint()
 * @edit 18-09-02
 * - Updated decimal()
 * @edit 18-09-17
 * - Updated setValues() 
 * @edit 18-10-02
 * - Upgraded version
 * @edit 18-11-02
 * - Copied code from \GIndie\DBHandler\MySQL56\...
 * @edit 18-11-04
 * - Created year()
 * - Upgrade DocBlock in some methods
 * @edit 18-11-06
 * - Created valuesUnformatted, getValuesUnformatted()
 * @edit 18-11-11
 * - Abstracted class into \DataType\*
 * 
 */
class DataType extends DataType\StringDataTypes
{
    
}
