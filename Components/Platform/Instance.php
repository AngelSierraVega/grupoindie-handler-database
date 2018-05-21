<?php

/**
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * @copyright (C) 2018 Angel Sierra Vega. Grupo INDIE.
 *
 * @package GIndie\DBHandler\Components\Platform
 * 
 * @version 0A.2A
 */

namespace GIndie\DBHandler\Components\Platform;

/**
 * @since 18-03-21
 * - Functional class
 * @edit 18-05-05
 * - Updated namespace
 * - Updated BRAND_NAME
 * @edit 18-05-20
 * - Moved file from [sndbx_folder]\Platform\..
 */
class Instance extends \GIndie\Platform\Instance
{

    /**
     * 
     * @since 18-03-21
     * @edit 18-05-05
     */
    const BRAND_NAME = "DBHandler";

    /**
     * 
     * @since 18-03-21
     * @edit 18-05-21
     */
    public function config()
    {
        $this->setModule(ModuleDBMS::class);
        $this->setModule(ModuleDataModel::class);
    }

}
