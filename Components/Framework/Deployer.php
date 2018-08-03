<?php

/**
 * GI-DBHandler-DVLP - Deployer
 *
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * @copyright (c) 2018 Angel Sierra Vega. Grupo INDIE.
 *
 * @package GIndie\DBHandler
 *
 * @version DOING 0A.80
 * @since 18-07-26
 */

namespace GIndie\DBHandler\Components\Framework;

use GIndie\Framework\View;
use GIndie\ScriptGenerator\Bootstrap3\Javascript\Tooltip;

/**
 * Description of Deployer
 *
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 */
abstract class Deployer extends \GIndie\Framework\Controller
{

    /**
     * @since 18-04-07
     * @edit 18-08-14
     * - Added selectTable, createTable, dropTable
     */
    public static function config()
    {
        static::configGetRequest(static::class . "::widgetDBHandler");
        static::configPostRequest(static::class . "::widgetDatabase", "selectDatabase");
        static::configPostRequest(static::class . "::createDatabase", "createDatabase");
        static::configPostRequest(static::class . "::dropDatabase", "dropDatabase");
        static::configPostRequest(static::class . "::widgetTable", "selectTable");
        static::configPostRequest(static::class . "::createTable", "createTable");
        static::configPostRequest(static::class . "::dropTable", "dropTable");
    }

    /**
     * 
     * @return \GIndie\ScriptGenerator\Bootstrap3\Grid
     * @since 18-08-14
     */
    public static function gridTableHandler()
    {
        $grid = new \GIndie\ScriptGenerator\Bootstrap3\Grid();
        $grid->removeAttribute("class");
        $row1 = $grid->addRowGP();
        $col_i_ii_i = $row1->addColumnGP("col-sm", 6);
        $col_i_ii_i->addContent(static::widgetDatabase());
        $col_i_ii_ii = $row1->addColumnGP("col-sm", 6);
        $col_i_ii_ii->addContent("@todo");
        return $grid;
    }

    /**
     * 
     * @return 
     * @since 18-08-14
     */
    public static function dropTable()
    {
        $tmpTableClass = \urldecode($_POST["tableId"]);
        $tmpTableClass = $tmpTableClass::instance();
        $tmpTableHandler = new \GIndie\DBHandler\MySQL56\Handler\Table($tmpTableClass);
        $tmp = $tmpTableHandler->dropTable();
        $rtnWidget = static::widgetTable();
        if ($tmp !== true) {
            $error = View\Alert::danger(\GIndie\DBHandler\MySQL56::getConnection()->error);
            $rtnWidget->getHeadingBody()->addContent($error);
        }
        return $rtnWidget;
    }

    /**
     * 
     * @return 
     * @since 18-08-15
     */
    public static function createTable()
    {
        $tmpTableClass = \urldecode($_POST["tableId"]);
        $tmpTableClass = $tmpTableClass::instance();
        $tmpTableHandler = new \GIndie\DBHandler\MySQL56\Handler\Table($tmpTableClass);
        $tmp = $tmpTableHandler->createTable();
        if ($tmp !== true) {
            $error = View\Alert::danger(\GIndie\DBHandler\MySQL56::getConnection()->error);
        }
        $rtnWidget = static::widgetTable();
        if (isset($error)) {
            $rtnWidget->getHeadingBody()->addContent($error);
        }

        return $rtnWidget;
    }

    /**
     * 
     * @return \GIndie\Framework\View\Widget
     * @since 18-08-04
     * @edit 18-08-14
     * - Updated display
     * @edit 18-08-15
     * - use dsplyDatabases()
     */
    public static function widgetDBHandler()
    {
        $widget = new View\Widget("DBHandler", true, true, true);
        try {
            $dispDBHandler = static::dsplyDBHandlerINI();
            $grid = new \GIndie\ScriptGenerator\Bootstrap3\Grid();
            $grid->addScriptOnDocumentReady(Tooltip::getActivationScript());
            $grid->removeAttribute("class");
            $row1 = $grid->addRowGP();
            $col_DBHandler = $row1->addColumnGP("col-md", 6);
            $col_DBHandler->addContent($dispDBHandler);
            $connection = \GIndie\DBHandler\MySQL56::getConnection();
            $dispConnection = View\Table::displayArray(
                            ["stat" => $connection->stat()
                        , "get_client_info" => $connection->get_client_info()
                        , "get_server_info" => $connection->get_server_info()
                            ], "PHP Connection data")->addClass("table table-condensed");
            $col_Connection = $row1->addColumnGP("col-md", 6);
            $col_Connection->addContent($dispConnection);
            $widget->getBody()->addContent($grid);
            $widget->setContext("primary");
            $widget->getBodyFooter()->addContent(self::dsplyDatabases());
        } catch (\Exception $exc) {
            $alert = \GIndie\ScriptGenerator\Bootstrap3\Component\Alert::danger($exc->getMessage());
            $widget->getBody()->addContent($alert);
            $widget->setContext("danger");
        }
        return $widget;
    }

    /**
     * 
     * @return GIndie\Framework\View\Table
     * @since 18-08-15
     */
    private static function dsplyDatabases()
    {
        $table = View\Table::selectable();
        $table->addContent(View\FormInput::formPostOnSelf("selectDatabase"));
        $table->addHeader(["", "Database", "Validator"]);
        foreach (static::databases() as $databaseInstance) {
            $manejador = new \GIndie\DBHandler\MySQL56\Handler\Database($databaseInstance);
            $table->addRow(static::dsplyRowDatabase($manejador));
        }
        return $table;
    }

    /**
     * 
     * @param \GIndie\DBHandler\MySQL56\Handler\Database $databaseHandler
     * @return array
     * @since 18-08-15
     */
    private static function dsplyRowDatabase(\GIndie\DBHandler\MySQL56\Handler\Database $databaseHandler)
    {
        $button = new \GIndie\ScriptGenerator\Bootstrap3\Component\Button("Select", "submit");
        $button->addClass("btn-sm");
        $button->setForm("selectDatabase");
        $button->setAttribute("name", "databaseId");
        $button->setValue(\urlencode(\get_class($databaseHandler->getDatabase())));
        try {
            $databaseHandler->execValidation();
            $rtnRow = new \GIndie\ScriptGenerator\Bootstrap3\Tables\Row([$button, $databaseHandler->getDatabase()->name(), "---"]);
            $rtnRow->setAttribute("class", "success");
        } catch (\GIndie\DBHandler\ExceptionDBHandler $exc) {
            switch ($exc->getCode())
            {
                case \GIndie\DBHandler\ExceptionDBHandler::NO_DATABASE:
                    $rtnRow = new \GIndie\ScriptGenerator\Bootstrap3\Tables\Row([$button, $databaseHandler->getDatabase()->name(), $exc->getMessage()]);
                    $rtnRow->setAttribute("class", "bg-danger");
                    break;
            }
        }
        return $rtnRow;
    }

    /**
     * 
     * @return \GIndie\Framework\View\Table
     * @since 18-08-14
     */
    public static function dsplyDBHandlerINI()
    {
        $passwordValue = \GIndie\DBHandler\INIHandler::getMainPassword();
        switch ($passwordValue)
        {
            case "":
                $passwordValue = "Empty string!";
                break;
        }
        $passwordNode = Tooltip::tooltipOnLeft(\GIndie\ScriptGenerator\HTML5\Category\Basic::paragraph("********"), $passwordValue);
        return View\Table::displayArray(
                        [
                    "server_prefix" => \GIndie\DBHandler\INIHandler::getServerPrefix(),
                    "host" => \GIndie\DBHandler\INIHandler::getHost(),
                    "main_username" => \GIndie\DBHandler\INIHandler::getMainUsername(),
                    "main_password" => $passwordNode
                        ], "DBHandler.ini")->addClass("table");
    }

    /**
     * 
     * @return \GIndie\ScriptGenerator\Bootstrap3\Grid
     * @since 18-08-04
     */
    public static function grid()
    {
        $grid = new \GIndie\ScriptGenerator\Bootstrap3\Grid();
        $grid->removeAttribute("class");
        $row1 = $grid->addRowGP();
        $col_i_ii_i = $row1->addColumnGP("col-sm", 6);
        $col_i_ii_i->addContent(static::widgetDBHandler());
        $col_i_ii_ii = $row1->addColumnGP("col-sm", 6);
        $col_i_ii_ii->addContent(static::widgetDatabase());
        return $grid;
    }

    /**
     * 
     * @param \GIndie\DBHandler\MySQL56\Handler\Database $dbHandler
     * @return \GIndie\ScriptGenerator\Dashboard\Alert
     * @since 18-08-15
     */
    private static function dsplyValidatorDatabase(\GIndie\DBHandler\MySQL56\Handler\Database $dbHandler)
    {
        try {
            if ($dbHandler->execValidation()) {
                $button = new \GIndie\ScriptGenerator\Bootstrap3\Component\Button("Drop database", "submit");
                $button->addClass("btn-sm pull-right");
                $button->setContext("danger");
                $button->setForm("dropDatabase");
                $button->setAttribute("name", "databaseId");
                $button->setValue(\urlencode(\get_class($dbHandler->getDatabase())));

                $rtnTable = View\Alert::success("Database validation: Passed!" . $button);
                $rtnTable->addContent(View\FormInput::formPostOnSelf("dropDatabase"));
            }
        } catch (\GIndie\DBHandler\ExceptionDBHandler $exc) {
            switch ($exc->getCode())
            {
                case \GIndie\DBHandler\ExceptionDBHandler::NO_DATABASE:
                    $button = new \GIndie\ScriptGenerator\Bootstrap3\Component\Button("Create database", "submit");
                    $button->addClass("btn-sm pull-right");
                    $button->setContext("success");
                    $button->setForm("createDatabase");
                    $button->setAttribute("name", "databaseId");
                    $button->setValue(\urlencode(\get_class($dbHandler->getDatabase())));
                    $rtnTable = View\Alert::danger("Database validation: " . $exc->getMessage() . $button);
                    $rtnTable->addContent(View\FormInput::formPostOnSelf("createDatabase"));
                    break;
            }
        }
        return $rtnTable;
    }

    /**
     * 
     * @return \GIndie\Framework\View\Widget
     * @since 18-04-07
     * @edit 18-08-14
     * - Added forms for dropTable, createTable, selectTable
     * @edit 18-08-15
     * - Removed try catch
     * - Used dsplyValidatorDatabase(), dsplyTables()
     */
    public static function widgetDatabase()
    {
        $tmpDBclass = \urldecode($_POST["databaseId"]);
        $tmpDBclass = new $tmpDBclass();
        $tmpDBHandler = new \GIndie\DBHandler\MySQL56\Handler\Database($tmpDBclass);
        $widget = new View\Widget("Database Model <b>" . \get_class($tmpDBclass) . "</b>", true, true, true);
        $dsplyValidator = static::dsplyValidatorDatabase($tmpDBHandler);
        $table = View\Table::displayArray(
                        [
                    "name" => $tmpDBHandler->getDatabase()->name(),
                    "charset" => $tmpDBHandler->getDatabase()->charset(),
                    "collation" => $tmpDBHandler->getDatabase()->collation()
                        ], "Definition"
                )->addClass("table");
        $widget->getBody()->addContent($table);
        $widget->getBodyFooter()->addContent($dsplyValidator);
        if ($dsplyValidator->hasClass("alert-danger") === true) {
            $widget->setContext("danger");
        } else {
            $widget->setContext("primary");
            $widget->addContent(self::dsplyTables($tmpDBHandler));
        }
        return $widget;
    }

    /**
     * 
     * @param \GIndie\DBHandler\MySQL56\Handler\Table $tableHandler
     * @return \GIndie\Framework\View\Alert
     * @since 18-08-15
     */
    private static function dsplyValidatorTable(\GIndie\DBHandler\MySQL56\Handler\Table $tableHandler)
    {
        try {
            if ($tableHandler->execValidation()) {
                $button = new \GIndie\ScriptGenerator\Bootstrap3\Component\Button("Drop table", "submit");
                $button->addClass("btn-sm pull-right");
                $button->setContext("danger");
                $button->setForm("dropTable");
                $button->setAttribute("name", "tableId");
                $button->setValue(\urlencode(\get_class($tableHandler->getTable())));

                $rtnValidator = View\Alert::success("Table validation: Passed!" . $button);
                $rtnValidator->addContent(View\FormInput::formPostOnSelf("dropTable"));
            }
        } catch (\GIndie\DBHandler\ExceptionDBHandler $exc) {
            $button = new \GIndie\ScriptGenerator\Bootstrap3\Component\Button("Create table", "submit");
            $button->addClass("btn-sm pull-right");
            $button->setContext("success");
            $button->setForm("createTable");
            $button->setAttribute("name", "tableId");
            $button->setValue(\urlencode(\get_class($tableHandler->getTable())));
            $rtnValidator = View\Alert::danger("Table validation: " . $exc->getMessage() . $button);
            $rtnValidator->addContent(View\FormInput::formPostOnSelf("createTable"));
        }
        return $rtnValidator;
    }

    /**
     * 
     * @param \GIndie\DBHandler\MySQL56\Handler\Table $tableHandler
     * @return \GIndie\Framework\View\Table
     * @since 18-08-15
     * @edit 18-08-20
     * - Abstracted and renamed method
     */
    private static function dsplyTableModelDefinition(\GIndie\DBHandler\MySQL56\Instance\Table $tableInstance)
    {
//        $instance = $tableHandler->getTable();
        $tableDefinition = new View\Table();
        $tableDefinition->addContent("<caption>Model definition</caption>");
        $tableDefinition->addHeader(["Name", "Database name"]);
        $tableDefinition->addRow([$tableInstance->databaseName(), $tableInstance->name()]);
        $tableDefinition->addClass("table col-xs-12");
        return $tableDefinition;
    }

    /**
     * 
     * @param \GIndie\DBHandler\MySQL56\Instance\Table $tableInstance
     * @return \GIndie\Framework\View\Table
     * @since 18-08-20
     */
    private static function dsplyTableModelColumns(\GIndie\DBHandler\MySQL56\Instance\Table $tableInstance)
    {
        $span = \GIndie\ScriptGenerator\HTML5\Category\StylesSemantics::span();
        $tableColumns = View\Table::displayArray(
                        [
                        ], "Model column definition"
                )->addClass("table");
        foreach ($tableInstance->columns() as $columnName => $tmpColumnDefinition) {
            $tableColumns->addRow([$columnName, $tmpColumnDefinition->getColumnDefinition()]);
        }
        $span->addContent($tableColumns);
        $span->addClass("col-sm-6");
        return $span;
    }
    
    /**
     * 
     * @param \GIndie\DBHandler\MySQL56\Instance\Table $tableInstance
     * @return \GIndie\ScriptGenerator\HTML5\Category\StylesSemantics\Span
     * @since 18-08-20
     */
    private static function dsplyTableModelReferenceDefinition(\GIndie\DBHandler\MySQL56\Instance\Table $tableInstance)
    {
        $span = \GIndie\ScriptGenerator\HTML5\Category\StylesSemantics::span();
        $tableColumns = View\Table::displayArray(
                        [
                        ], "Model reference definition"
                )->addClass("table");
        foreach ($tableInstance->referenceDefinition()->getReferences() as $columnId => $tmpReference) {
            $tableColumns->addRow([$tmpReference]);
        }
        $span->addContent($tableColumns);
        $span->addClass("col-sm-6");
        return $span;
    }

    /**
     * 
     * @return \GIndie\Framework\View\Widget
     * @since 18-08-15
     */
    public static function widgetTable()
    {
        $tmpTableclass = \urldecode($_POST["tableId"]);
        $tmpTableclass = $tmpTableclass::instance();
        $tmpTableHandler = new \GIndie\DBHandler\MySQL56\Handler\Table($tmpTableclass);
        $widget = new View\Widget("Table Model <b>" . \get_class($tmpTableclass) . "</b>", true, true, true, true);
        $dsplyValidator = static::dsplyValidatorTable($tmpTableHandler);
        $widget->getBody()->addContent(static::dsplyTableModelDefinition($tmpTableclass));
        $widget->getBody()->addContent(static::dsplyTableModelColumns($tmpTableclass));
        $widget->getBody()->addContent(static::dsplyTableModelReferenceDefinition($tmpTableclass));
        $widget->getBodyFooter()->addContent($dsplyValidator);
        if ($dsplyValidator->hasClass("alert-danger") === true) {
            $widget->setContext("danger");
        } else {
            $widget->setContext("primary");
            $widget->addContent(static::dsplyTableColumns($tmpTableHandler));
        }

        //$widget->addActionPost($formId, $params);
        $widget->getFooter()->addContent(View\FormInput::formPostOnSelf("selectDatabase"));
        $button = new \GIndie\ScriptGenerator\Bootstrap3\Component\Button("Return to database", "submit");
        $button->addClass("btn-sm pull-right");
        $button->setForm("selectDatabase");
        $button->setContext("info");
        $button->setAttribute("name", "databaseId");
        $button->setValue(\urlencode($tmpTableHandler->getTable()->databaseClassname()));
        $widget->getFooter()->addContent($button);
        /**
         * Reload button
         */
        $widget->getFooter()->addContent(View\FormInput::formPostOnSelf("selectTable"));
        $button = new \GIndie\ScriptGenerator\Bootstrap3\Component\Button("Reload", "submit");
        $button->addClass("btn-sm pull-right");
        $button->setForm("selectTable");
        $button->setAttribute("name", "tableId");
        $button->setContext("info");
        $button->setValue(\urlencode(\get_class($tmpTableclass)));
        $widget->getFooter()->addContent($button);
        $widget->getFooter()->addContent("-");
        return $widget;
    }

    /**
     * 
     * @param \GIndie\DBHandler\MySQL56\Handler\Table $tableHandler
     * @return \GIndie\Framework\View\Table
     * @since 18-08-16
     */
    private static function dsplyTableColumns(\GIndie\DBHandler\MySQL56\Handler\Table $tableHandler)
    {
        $table = View\Table::displayArray(
                        [], "DBMS columns"
                )->addClass("table");
        $result = $tableHandler->showColumns();
        $headerTmp = [];
        foreach ($result->fetch_fields() as $field) {
            $headerTmp[] = $field->name;
        }
        $table->addHeader($headerTmp);
        foreach ($result->fetch_all(\MYSQLI_ASSOC) as $definition) {
            $table->addRow($definition);
        }
        return $table;
    }

    /**
     * 
     * @return GIndie\Framework\View\Table
     * @since 18-08-02
     * @edit 18-08-15
     * - Upgraded code
     */
    private static function dsplyTables(\GIndie\DBHandler\MySQL56\Handler\Database $dbHandler)
    {
        $table = View\Table::selectable();
        $table->addHeader(["", "Table", "Validator"]);
        $table->addContent(View\FormInput::formPostOnSelf("selectTable"));
        foreach ($dbHandler->getTables() as $classname => $tableHandler) {
            try {
                $tableHandler->execValidation();
                $button = new \GIndie\ScriptGenerator\Bootstrap3\Component\Button("Select", "submit");
                $button->addClass("btn-sm");
                $button->setForm("selectTable");
                $button->setAttribute("name", "tableId");
                $button->setValue(\urlencode($classname));
                //$row = $table->addRowGetPointer(static::constructRow($tableHandler));
                $row = $table->addRowGetPointer([$button, $tableHandler->getTable()->name(), "OK"]);
                $row->setAttribute("class", "success");
                //$row->addClass("bg-success");
            } catch (\GIndie\DBHandler\ExceptionDBHandler $exc) {
                $button = new \GIndie\ScriptGenerator\Bootstrap3\Component\Button("Select", "submit");
                $button->addClass("btn-sm");
                $button->setForm("selectTable");
                $button->setAttribute("name", "tableId");
                $button->setValue(\urlencode($classname));
                $row = $table->addRowGetPointer([$button, $tableHandler->getTable()->name(), $exc->getMessage()]);
                $row->setAttribute("class", "danger");
            }
        }

        return $table;
    }

    /**
     * 
     * @param \GIndie\DBHandler\MySQL56\Handler\Table $tableHandler
     * @return type
     * @since 18-08-07
     * @todo
     * - Upgrade row creation
     */
    private static function constructRowDPR(\GIndie\DBHandler\MySQL56\Handler\Table $tableHandler)
    {
        $tableHandler->execValidation();
        return [$tableHandler->getTable()->name(), "@todo"];
    }

    /**
     * @return \GIndie\DBHandler\MySQL56\Instance\Database
     * @since 18-08-02
     */
    abstract protected static function databases();

    /**
     * 
     * @since 18-04-07
     * @return \GIndie\ScriptGenerator\Bootstrap3\Grid
     * @edit 18-08-02
     * - Use static::databaseHandler()
     * @edit 18-08-14
     * - Return grid()
     * @edit 18-08-15
     * - Return widgetDatabase()
     */
    public static function createDatabase()
    {
        $tmpDBclass = \urldecode($_POST["databaseId"]);
        $tmpDBclass = new $tmpDBclass();
        $tmpDBHandler = new \GIndie\DBHandler\MySQL56\Handler\Database($tmpDBclass);
        \GIndie\DBHandler\MySQL56::query($tmpDBHandler->stmCreate());
        return static::widgetDatabase();
    }

    /**
     * 
     * @since 18-08-02
     * @return \GIndie\ScriptGenerator\Bootstrap3\Grid
     * @edit 18-08-14
     * - Return grid()
     * @edit 18-08-15
     * - Return widgetDatabase()
     */
    public static function dropDatabase()
    {
        $tmpDBclass = \urldecode($_POST["databaseId"]);
        $tmpDBclass = new $tmpDBclass();
        $tmpDBHandler = new \GIndie\DBHandler\MySQL56\Handler\Database($tmpDBclass);
        \GIndie\DBHandler\MySQL56::query($tmpDBHandler->stmDrop());
        return static::widgetDatabase();
    }

}
