<?php

/**
 * GI-Platform-SNDBX - Module 
 *
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * @copyright (C) 2018 Angel Sierra Vega. Grupo INDIE.
 *
 * @package GIndie\DBHandler\Components\Platform
 * 
 * @version 0A.26
 */

namespace GIndie\DBHandler\Components\Platform;

use GIndie\Platform\View;
use GIndie\ScriptGenerator\Bootstrap3\Component\Alert;

/**
 * 
 * @since 18-03-21
 * @edit 18-05-05
 * - Updated namespace
 * @edit 18-05-06
 * - Upgraded NAME, config(), widgetReload()
 * @edit 18-05-20
 * - Functional Database read
 * - Moved file from [sndbx_folder]\Platform\..
 * @todo
 * - Main functionality for module
 * - Complete functionality for module
 */
class Module extends \GIndie\Platform\Controller\Module
{

    /**
     * @since 18-03-21
     * @edit 18-05-06
     * @edit 18-05-20
     */
    const NAME = "DBMS Manager";

    /**
     * @since 18-03-21
     * @edit 18-05-06
     * - Upgraded placeholder structure
     * @edit 18-05-20
     * - Defined [some] slaves
     */
    public function config()
    {
        /**
         * [DBMSInfo                 ]
         * [EventScheduler][Databases]
         */
        $this->configPlaceholder("i-i-i")->typeHTMLString("[DBMSInfo]");
        $this->configPlaceholder("i-ii-i")->typeHTMLString("[EventScheduler]");
        $this->configPlaceholder("i-ii-ii")->typeHTMLString("[Databases]");

        /**
         * [DatabaseInfo            ]
         * [Events][Routines][Tables]
         */
        $this->configPlaceholder("ii-i-i")->typeHTMLString("[DatabaseInfo]");
        $this->configPlaceholder("ii-iii-i")->typeHTMLString("[Events]");
        $this->configPlaceholder("ii-iii-ii")->typeHTMLString("[Routines]");
        $this->configPlaceholder("ii-iii-iii")->typeHTMLString("[Tables]");

        /**
         * [TableInfo               ]
         * [Attributes][Restrictions]
         */
        $this->configPlaceholder("iii-i-i")->typeHTMLString("[TableInfo]");
        $this->configPlaceholder("iii-ii-i")->typeHTMLString("[Attributes]");
        $this->configPlaceholder("iii-ii-ii")->typeHTMLString("[Restrictions]");

        /**
         * Define slaves
         */
        $this->configPlaceholder("i-ii-ii")->addSlave("ii-i-i");
        $this->configPlaceholder("i-ii-ii")->addSlave("ii-iii-iii");
    }

    /**
     * Stores the selected database-id
     * @var null|string 
     * @since 18-05-20
     */
    protected $databaseId = null;

    /**
     * 
     * @param string $placeholderId
     * @param string $selectedId
     * @return \GIndie\ScriptGenerator\HTML5\Category\StylesSemantics\Span
     * @since 18-05-20
     */
    protected function runActionSelectRow($placeholderId, $selectedId)
    {
        switch ($placeholderId)
        {
            case "i-ii-ii":
                $this->databaseId = $selectedId;
                break;
        }
        return parent::runActionSelectRow($placeholderId, $selectedId);
    }

    /**
     * 
     * @return \GIndie\Platform\View\Widget
     * @since 18-05-04
     * @edit 18-05-20
     * - Functional method
     * @todo
     * - Implement funcionality on Tables\Selectable
     * - Abstract funcionality
     */
    private function wdgtDatabases()
    {
        $this->databaseId = null;
        $form = new \GIndie\Platform\View\Form(null, false, false);
        $form->addContent(View\Input::hidden("@placeholderId", "i-ii-ii"));
        $form->setAttribute("gip-action", "@selectRow");
        $form->addSubmitOnChange();
        $tableSelectable = new \GIndie\ScriptGenerator\Dashboard\Tables\Selectable();
        $tableSelectable->addHeader(["#", "Database"]);
        $query = \GIndie\DBHandler\MySQL56\Statement\DataManipulation\Show::databases();
        $result = \GIndie\DBHandler\MySQL::query($query);
        foreach ($result->fetch_all(\MYSQLI_ASSOC) as $rowNumber => $assocArray) {
            $tableSelectable->addSelectableRow($assocArray["Database"], [$assocArray["Database"]]);
        }
        $form->addContent($tableSelectable);
        $rtnWidget = new View\Widget("Databases", $form, false);
        $rtnWidget->addButtonHeading(\GIndie\Platform\View\Widget\Buttons::Reload());
        $rtnWidget->setContext("primary");
        return $rtnWidget;
    }

    /**
     * 
     * @return \GIndie\Platform\View\Widget
     * @since 18-05-04
     * @edit 18-05-20
     * - Functional method
     * @todo
     * - Fully functional method
     */
    private function wdgtDatabaseInfo()
    {
        if (isset($this->databaseId)) {
            $rtnWidget = new View\Widget("[@doingDatabaseInfo]", false, true);
            $rtnWidget->setContext("info");
            $rtnWidget->getBody()->addContent($this->databaseId);
            $rtnWidget->getBody()->addContent("<br>@toDo");
        } else {
            $rtnWidget = new View\Widget("DatabaseInfo - No database selected", false, false);
        }
        $rtnWidget->addButtonHeading(\GIndie\Platform\View\Widget\Buttons::Reload());
        return $rtnWidget;
    }

    /**
     * 
     * @return \GIndie\Platform\View\Widget
     * @since 18-05-04
     * @todo
     * - Functional method
     */
    private function wdgtEvents()
    {
        $rtnWidget = new View\Widget("[Events]", false, false);
        return $rtnWidget;
    }

    /**
     * 
     * @return \GIndie\Platform\View\Widget
     * @since 18-05-04
     * @todo
     * - Functional method
     */
    private function wdgtRoutines()
    {
        $rtnWidget = new View\Widget("[Routines]", false, false);
        return $rtnWidget;
    }

    /**
     * 
     * @return \GIndie\Platform\View\Widget
     * @since 18-05-04
     * @todo
     * - Functional method
     */
    private function wdgtTables()
    {
        $rtnWidget = new View\Widget("[Tables]", false, false);
        return $rtnWidget;
    }

    /**
     * 
     * @return \GIndie\Platform\View\Widget
     * @since 18-05-04
     * @todo
     * - Functional method
     */
    private function wdgtTableInfo()
    {
        $rtnWidget = new View\Widget("[TableInfo]", false, false);
        return $rtnWidget;
    }

    /**
     * 
     * @return \GIndie\Platform\View\Widget
     * @since 18-05-04
     * @todo
     * - Functional method
     */
    private function wdgtAttributes()
    {
        $rtnWidget = new View\Widget("[Attributes]", false, false);
        return $rtnWidget;
    }

    /**
     * 
     * @return \GIndie\Platform\View\Widget
     * @since 18-05-04
     * @todo
     * - Functional method
     */
    private function wdgtRestrictions()
    {
        $rtnWidget = new View\Widget("[Restrictions]", false, false);
        return $rtnWidget;
    }

    /**
     * 
     * @param string $id
     * @param string $class
     * @param string $selected
     * 
     * @since 18-03-21
     * 
     * @return \GIndie\Platform\View\Widget
     * @edit 18-05-06
     * - Upgraded widget structure
     */
    protected function widgetReload($id, $class, $selected)
    {
        $widget;
        switch ($id)
        {
            /**
             * [DBMSInfo               ]
             * [EventScheduler][Databases]
             */
            case "i-i-i":
                $widget = $this->wdgtDBMSInfo();
                break;
            case "i-ii-i":
                $widget = $this->wdgtEventScheduler();
                break;
            case "i-ii-ii":
                $widget = $this->wdgtDatabases();
                break;
            /**
             * [DatabaseInfo            ]
             * [Events][Routines][Tables]
             */
            case "ii-i-i":
                $widget = $this->wdgtDatabaseInfo();
                break;
            case "ii-iii-i":
                $widget = $this->wdgtEvents();
                break;
            case "ii-iii-ii":
                $widget = $this->wdgtRoutines();
                break;
            case "ii-iii-iii":
                $widget = $this->wdgtTables();
                break;
            /**
             * [TableInfo               ]
             * [Attributes][Restrictions]
             */
            case "iii-i-i":
                $widget = $this->wdgtTableInfo();
                break;
            case "iii-ii-i":
                $widget = $this->wdgtAttributes();
                break;
            case "iii-ii-ii":
                $widget = $this->wdgtRestrictions();
                break;
            default:
                $widget = parent::widgetReload($id, $class, $selected);
                break;
        }
        return $widget;
    }

    /**
     * @since 18-03-21
     * @return \GIndie\Platform\View\Widget
     * @edit 18-05-07
     * - Upgraded widget, renamed method from widgetGeneralInfo() to wdgtDBMSInfo()
     * @todo
     * - Display all global vars and connection vars
     */
    protected function wdgtDBMSInfo()
    {
        $rtnWidget = new View\Widget("MySQL", true, true);
        $rtnWidget->addButtonHeading(\GIndie\Platform\View\Widget\Buttons::Reload());
        $rtnWidget->setContext("primary");
        $link = \GIndie\DBHandler\MySQL::getConnection();
        $rtnWidget->getBody()->addContent("<b>MySQL version:</b> " . \mysqli_get_server_info($link)); //mysqli_stat
        $rtnWidget->getBody()->addContent("<br>");
        $rtnWidget->getBody()->addContent("<b>Status:</b> " . \mysqli_stat($link));
        $rtnWidget->getBody()->addContent("<br>");
        $result = $link->query("select @@basedir,@@sql_mode;")->fetch_array();
        $rnt = "<b>Variable basedir:</b> " . $result[0];
        $rnt .= "<br><b>Variable sql_mode:</b> " . $result[1];
        $rtnWidget->getBody()->addContent($rnt);
        $rtnWidget->getBody()->addContent("<br>");
        return $rtnWidget;
    }

    /**
     * 
     * @return type
     * @since 18-03-21
     * @todo 
     * - Translate text
     */
    private function textoPlanificadorDesactivado()
    {
        \ob_start();
        ?>
        <p>Para activar <em>automáticamente</em> el planificador de eventos al 
            reiniciar MySQL defina la variable <kbd>event_scheduler = ON</kbd>
            dentro de <mark>la categoría</mark> <kbd>[mysqld]</kbd> 
            desde el archivo de configuración de MySQL.</p>
        <p><small>Archivo de configuración en Red Hat, Fedora y derivados:</small>
            <br><samp>/etc/my.cnf</samp></p>
        <p><small>Archivo de configuración en Ubuntu, Debian y derivados:</small>
            <br><samp>/etc/mysql/my.cnf</samp></p>
        <pre>
                                                                                                                        ...
                                                                                                                        [mysqld]
                                                                                                                        ...
                                                                                                                        event_scheduler = ON
        </pre>
        <?php

        $out = \ob_get_contents();
        \ob_end_clean();
        return $out;
    }

    /**
     * 
     * @param array $array
     * @return string
     * @since 18-03-21
     * @todo
     * - Remove method from class
     */
    private function parseAssoc(array $array)
    {
        $rtnStr = "";
        foreach ($array as $key => $value) {
            switch (true)
            {
                case \is_null($value):break;
                default:
                    $rtnStr .= "<b>{$key}</b>: {$value}<br>";
                    break;
            }
        }
        return $rtnStr;
    }

    /**
     * @since 18-03-21
     * @return \GIndie\Platform\View\Widget
     * @edit 18-05-07
     * - Upgraded widget, action targets
     * - Renamed method from widgetEventScheduler() to wdgtEventScheduler()
     * @todo
     * - Rename actions
     */
    protected function wdgtEventScheduler()
    {
        $rtnWidget = new View\Widget("Event Scheduler", true, true);
        $result = \GIndie\DBHandler\MySQL::query("SELECT @@event_scheduler;")->fetch_assoc();
        switch ($result["@@event_scheduler"])
        {
            case "ON":
            case "on":
            case "1":
            case 1:
                $rtnWidget->setContext("primary");
                $result = \GIndie\DBHandler\MySQL::query("SELECT * FROM information_schema.processlist WHERE USER='event_scheduler';");
                while ($array = $result->fetch_assoc()) {
                    $rtnWidget->getBody()->addContent($this->parseAssoc($array));
                }
                $params = ["target" => "#i-ii-i",
                    "gip-action" => "desactivar-planificador",
                    "action-name" => "Desactivar",
                    "context" => "danger"
                ];
                $rtnWidget->addActionHeading($params);
                break;
            case "OFF":
            case "off":
            case "0":
            case 0:
                $rtnWidget->getBody()->addContent($this->textoPlanificadorDesactivado());
                $rtnWidget->setContext("warning");
                $params = ["target" => "#i-ii-i",
                    "gip-action" => "activar-planificador",
                    "action-name" => "Activar",
                    "context" => "success"
                ];
                $rtnWidget->addActionHeading($params);
                break;
        }
        $rtnWidget->addButtonHeading(\GIndie\Platform\View\Widget\Buttons::Reload());
        return $rtnWidget;
    }

    /**
     * 
     * @since 18-03-21
     * 
     * @param string $action
     * @param string $id
     * @param string $class
     * @param string $selected
     * 
     * @return mixed
     * @edit 18-05-07
     * - Removed deprecated actions
     * @todo
     * - Upgrade action names
     */
    public function run($action, $id, $class, $selected)
    {
        $rtn = null;
        switch ($action)
        {
            case "activar-planificador":
                $result = \GIndie\DBHandler\MySQL::query("SET GLOBAL event_scheduler = ON;");
                $rtn = $this->wdgtEventScheduler();
                if (!$result) {
                    $rtn->getHeadingBody()->addContent(
                            Alert::danger(\GIndie\DBHandler\MySQL::getConnection()->error)
                    );
                }
                break;
            case "desactivar-planificador":
                $result = \GIndie\DBHandler\MySQL::query("SET GLOBAL event_scheduler = OFF;");
                $rtn = $this->wdgtEventScheduler();
                if (!$result) {
                    $rtn->getHeadingBody()->addContent(
                            Alert::danger(\GIndie\DBHandler\MySQL::getConnection()->error)
                    );
                }
                break;
            default:
                $rtn = parent::run($action, $id, $class, $selected);
                break;
        }
        return $rtn;
    }

    /**
     * 
     * @return array
     * @since 18-03-21
     */
    public static function requiredRoles()
    {
        return ["AS"];
    }

}
