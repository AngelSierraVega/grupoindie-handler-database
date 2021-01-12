<?php

/**
 * GI-DBHandler-DVLP - Deployer
 *
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * @copyright (CC) 2020 Angel Sierra Vega. Grupo INDIE.
 * @license file://LICENSE
 *
 * @package GIndie\DBHandler\Components\Framework
 *
 * @version 00.BD
 * @since 18-07-26
 */

namespace GIndie\DBHandler\Components\Framework;

use GIndie\Framework\View;
use GIndie\ScriptGenerator\Bootstrap3\Javascript\Tooltip;
use GIndie\ScriptGenerator\Bootstrap3;
use GIndie\DBHandler\MySQL57;

/**
 * Description of Deployer
 *
 * @edit 18-09-28
 * - Added getDOM(), runFrameworkFormRequest()
 * - Upgraded config(), contentHandler(), createTable(), widgetDatabase(),
 * @edit 18-09-29
 * - Upgraded dsplyTables(), createDatabase(), dropDatabase()
 * @edit 18-10-02
 * - Upgraded version
 * @edit 18-11-02
 * - Upgraded use of MySQL57 instead of MySQL56
 * @edit 18-11-16
 * - Added functional addColumn
 * @edit 19-01-29
 * - Added functional updateField
 */
abstract class Deployer extends \GIndie\Framework\Controller
{

    /**
     * @since 19-01-09
     */
    use DisplayTraits;

    /**
     * 
     * @return type
     * @since 18-09-28
     */
    protected static function getDOM()
    {
        $dom = parent::getDOM();
        $dom->getTopbar()->setHeader("Framework deploy for DBHandler");
        return $dom;
    }

    /**
     * @since 18-04-07
     * @edit 18-08-14
     * - Added selectTable, createTable, dropTable
     * @edit 18-09-28
     * - Database actions point to same widget
     * @edit 18-12-02
     * - Added setSessionVariable
     * @edit 19-01-29
     * - Added updateField
     * @todo Table actions point to same widget
     */
    public static function config()
    {
        static::configGetRequest(static::class . "::widgetDBHandler");
        static::configPostRequest(static::class . "::setSessionVariable", "setSessionVariable");
        static::configPostRequest(static::class . "::widgetDatabase", "selectDatabase");
        static::configPostRequest(static::class . "::widgetDatabase", "createTableFromDatabase");
        static::configPostRequest(static::class . "::widgetDatabase", "createDatabase");
        static::configPostRequest(static::class . "::widgetDatabase", "dropDatabase");
        static::configPostRequest(static::class . "::widgetTable", "selectTable");
        static::configPostRequest(static::class . "::createTable", "createTable");
        static::configPostRequest(static::class . "::dropTable", "dropTable");
        static::configPostRequest(static::class . "::setSqlMode", "setSqlMode");
        static::configPostRequest(static::class . "::addColumn", "addColumn");
        static::configPostRequest(static::class . "::updateField", "updateField");
    }

    /**
     * 
     * @return \GIndie\Framework\View\Widget
     * @since 19-01-29
     */
    public static function updateField()
    {
        $tmpDatabaseClass = \urldecode($_POST["databaseId"]);
        $tmpDatabaseClass = new $tmpDatabaseClass();
        $tmpTableClass = \urldecode($_POST["tableId"]);
        $tableHandler = new MySQL57\Handler\Table($tmpTableClass::instance());
        $statement = MySQL57\Statement\DataDefinition::alterTable($tableHandler->getTable()->name());
        $statement->setDatabaseName($tmpDatabaseClass->name());
        $column = $tableHandler->getTable()->columnDefinition($_POST["fieldName"]);
        $statement->modifyColumn($_POST["fieldName"], $column->getColumnDefinition());
        $result = MySQL57::query($statement);
        $rtnWidget = static::widgetTable();
        if ($result) {
            $rtnWidget->getHeadingBody()->addContent(View\Alert::success($statement . ""));
        } else {
            $rtnWidget->getHeadingBody()->addContent(View\Alert::danger($statement . ""));
        }
        return $rtnWidget;
    }

    /**
     * 
     * @return type
     * @since 18-12-02
     * - Use deprecated
     */
    public static function setSessionVariable()
    {
        $query = "SET foreign_key_checks =" . $_POST["foreign_key_checks"] . ";";
        $result = MySQL57::query($query);
        $rtnWidget = static::widgetDBHandler();
        if ($result) {
            $rtnWidget->getHeadingBody()->addContent(View\Alert::success($query));
        } else {
            $rtnWidget->getHeadingBody()->addContent(View\Alert::danger($query));
        }
        return $rtnWidget;
    }

    /**
     * 
     * @return type
     * @since 18-09-28
     */
    private static function runFrameworkFormRequest()
    {
        $requestCode = isset(static::$requestParameters["GI-FRMWRK-FRM-RQST"]) ? static::$requestParameters["GI-FRMWRK-FRM-RQST"] : null;
        if (!\is_callable(static::class . "::{$requestCode}")) {
            switch ($requestCode)
            {
                case "createTableFromDatabase":
                    return static::createTable();
                    break;
                default:
                    return null;
                    break;
            }
        }
        return \call_user_func(static::class . "::{$requestCode}");
    }

    /**
     * 
     * @return \GIndie\ScriptGenerator\Bootstrap3\Grid
     * @since 18-08-14
     * @edit 18-09-28
     * - Renamed from gridTableHandler to contentHandler
     */
    public static function contentHandler()
    {
        //var_dump(static::$requestParameters); //
        $grid = new \GIndie\ScriptGenerator\Bootstrap3\Grid();
        $grid->removeAttribute("class");

        $navigator = $grid->addRowGP();
        $widget = $grid->addRowGP();
//        $col_i_ii_i = $row1->addColumnGP("col-sm", 6);
//        $col_i_ii_i->addContent(static::widgetDatabase());
//        $col_i_ii_ii = $row1->addColumnGP("col-sm", 6);
//        $col_i_ii_ii->addContent("@todo");
        return $grid;
    }

    /**
     * 
     * @param string $tableClass
     * @return \GIndie\Platform\Model\Record
     * @since 18-11-15
     */
    public static function getInstancedTable($tableClass)
    {
        return $tableClass::instance();
    }

    /**
     * 
     * @return \GIndie\Framework\View\Widget
     * @since 18-11-15
     */
    public static function addColumn()
    {
        $tmpDatabaseClass = \urldecode($_POST["databaseId"]);
//        $tmpDatabaseClass = $tmpDatabaseClass::instance();
        $tmpDatabaseClass = new $tmpDatabaseClass();
        $tmpTableClass = \urldecode($_POST["tableId"]);
//        $tmpTableClass = ;
        $tableHandler = new MySQL57\Handler\Table($tmpTableClass::instance());
        $statement = MySQL57\Statement\DataDefinition::alterTable($tableHandler->getTable()->name());
        $statement->setDatabaseName($tmpDatabaseClass->name());
        $column = $tableHandler->getTable()->columnDefinition($_POST["columnId"]);
        $statement->addColumn($_POST["columnId"] . " " . $column->getColumnDefinition());
        $result = MySQL57::query($statement);
        $rtnWidget = static::widgetTable();
        if ($result) {
            $rtnWidget->getHeadingBody()->addContent(View\Alert::success($statement . ""));
        } else {
            $rtnWidget->getHeadingBody()->addContent(View\Alert::danger($statement . ""));
        }
        return $rtnWidget;
    }

    /**
     * 
     * @return \GIndie\Framework\View\Widget
     * @since 18-11-08
     */
    public static function setSqlMode()
    {
        $sqlMode = $_POST["sql_mode"];
        $query = "SET GLOBAL sql_mode = '{$sqlMode}';";
        $result = \GIndie\DBHandler\MySQL57::query($query);
        $rtnWidget = static::widgetDBHandler();
        if ($result) {
            $rtnWidget->getHeadingBody()->addContent(View\Alert::success($query));
        } else {
            $rtnWidget->getHeadingBody()->addContent(View\Alert::danger($query));
        }
        return $rtnWidget;
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
        $tmpTableHandler = new \GIndie\DBHandler\MySQL57\Handler\Table($tmpTableClass);
        $tmp = $tmpTableHandler->dropTable();
        $rtnWidget = static::widgetTable();
        if ($tmp !== true) {
            $error = View\Alert::danger(\GIndie\DBHandler\MySQL57::getConnection()->error);
            $rtnWidget->getHeadingBody()->addContent($error);
        }
        return $rtnWidget;
    }

    /**
     * 
     * @return 
     * @since 18-08-15
     * @edit 18-08-26
     * - Handle insert of default record(s) if defined
     */
    public static function createTable()
    {
        $tmpTableClass = \urldecode($_POST["tableId"]);
        $tmpTableClass = $tmpTableClass::instance();
        $tmpTableHandler = new \GIndie\DBHandler\MySQL57\Handler\Table($tmpTableClass);
        
        $tmp = $tmpTableHandler->createTable();
//        $lastQueryMsj = \GIndie\DBHandler\MySQL57::$lastQuery;
        $error = null;
        if ($tmp !== true) {
//            var_dump($tmp);
//            throw new \Exception(\GIndie\DBHandler\MySQL57::getConnection()->error);
            $error = View\Alert::danger(\GIndie\DBHandler\MySQL57::getConnection()->error);
        } else {
            if (\count($tmpTableHandler->getTable()->defaultRecord()) > 0) {
                $tmpArray = $tmpTableHandler->getTable()->defaultRecord();
                if (isset($tmpArray[0])) {
                    if (\is_array($tmpArray[0])) {
                        foreach ($tmpArray as $tmpRecord) {
                            $tmpTableHandler->insert($tmpRecord);
                        }
                    } else {
                        throw new \Exception("todo handle defaultRecord definition");
                    }
                } else {
                    $tmpTableHandler->insert($tmpArray);
                }
            }
        }
        $rtnWidget = static::widgetTable();
//        $lastQuery = View\Alert::success($lastQueryMsj);
//        $rtnWidget->getHeadingBody()->addContent($lastQuery);
        if (!\is_null($error)) {
//            return $error;
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
     * @edit 19-01-09
     * - Use DisplayTraits
     */
    public static function widgetDBHandler()
    {
//        static::runFrameworkFormRequest();
        $widget = new View\Widget("DBHandler", true, true, true);
        try {
            $dispDBHandler = static::dsplyDBHandlerINI();
            $grid = new \GIndie\ScriptGenerator\Bootstrap3\Grid();
            $grid->addScriptOnDocumentReady(Tooltip::getActivationScript());
            $grid->removeAttribute("class");
            $row1 = $grid->addRowGP();
            $col_DBHandler = $row1->addColumnGP("col-md", 6);
            $col_DBHandler->addContent($dispDBHandler);
//            $connection = \GIndie\DBHandler\MySQL57::getConnection();
//            $dispConnection = View\Table::displayArray(
//                    ["stat" => $connection->stat()
//                    , "get_client_info" => $connection->get_client_info()
//                    , "get_server_info" => $connection->get_server_info()
//                    ], "PHP Connection data")->addClass("table table-condensed");
            $col_Connection = $row1->addColumnGP("col-md", 6);
            $col_Connection->addContent(static::phpConnectionData());
            /**
             * Row sql mode
             * SELECT @@GLOBAL.sql_mode;
             */
            $result = \GIndie\DBHandler\MySQL57::query("SELECT @@GLOBAL.sql_mode, @@SESSION.sql_mode;");
//            $result = $connection->query("SELECT @@GLOBAL.sql_mode;");
            $button1 = new \GIndie\ScriptGenerator\Bootstrap3\Component\Button("Set TRADITIONAL",
                "submit");
            $button1->addClass("btn-sm");
            $button1->setForm("setSqlMode");
            $button1->setAttribute("name", "sql_mode");
            $button1->setValue("TRADITIONAL");

            $btn2 = new \GIndie\ScriptGenerator\Bootstrap3\Component\Button("Set ANSI", "submit");
            $btn2->addClass("btn-sm");
            $btn2->setForm("setSqlMode");
            $btn2->setAttribute("name", "sql_mode");
            $btn2->setValue("ANSI"); //STRICT_ALL_TABLES

            $btn3 = new \GIndie\ScriptGenerator\Bootstrap3\Component\Button("Set STRICT_ALL_TABLES",
                "submit");
            $btn3->addClass("btn-sm");
            $btn3->setForm("setSqlMode");
            $btn3->setAttribute("name", "sql_mode");
            $btn3->setValue("STRICT_ALL_TABLES"); //

            $row2 = $grid->addRowGP();
            $colSqlMode = $row2->addColumnGP("col-md", 12);
//            $tmpGlobalSqlMode = $result->fetch_assoc()["@@GLOBAL.sql_mode"];
//            $tmpGlobalSqlMode = \explode(",", $tmpGlobalSqlMode);
//            $tmpGlobalSqlMode = \join(", ", $tmpGlobalSqlMode);
//            $dispSqlMode = View\Table::displayArray(
//                            ["@@GLOBAL.sql_mode" => $tmpGlobalSqlMode
//                        , "@@SESSION.sql_mode" => $result->fetch_assoc()["@@SESSION.sql_mode"]
//                        , "Actions" => [$button1, $btn2, $btn3]
//                            ], "SQL mode")->addClass("table table-condensed");
//            $dispSqlMode = View\Table::displayArray(
//                    \GIndie\DBHandler\MySQL57::getCurrentGlobalVars()
//                    , "Global variables")->addClass("table table-condensed");
            $colSqlMode->addContent(static::globalVars());

            $result = \GIndie\DBHandler\MySQL57::query("SELECT @@SESSION.foreign_key_checks;");
            $tmpGlobalSqlMode = $result->fetch_assoc()["@@SESSION.foreign_key_checks"];
//            $tmpGlobalSqlMode = \explode(",", $tmpGlobalSqlMode);
//            $tmpGlobalSqlMode = \join(", ", $tmpGlobalSqlMode);
//            var_dump($tmpGlobalSqlMode);
            $formSessionVar = View\FormInput::formPostOnSelf("setSessionVariable");
            $grid->addContent($formSessionVar);
            $btnFKC = new \GIndie\ScriptGenerator\Bootstrap3\Component\Button("SET FOREIGN_KEY_CHECKS=0;",
                "submit");
            $btnFKC->addClass("btn-sm");
            $btnFKC->setContext("danger");
            $btnFKC->setForm("setSessionVariable");
            $btnFKC->setAttribute("name", "foreign_key_checks");
            $btnFKC->setValue("0"); //
//            $dispSqlMode2 = View\Table::displayArray(
//                    ["foreign_key_checks" => [$tmpGlobalSqlMode]
//                    ], "Session variables")->addClass("table table-condensed");
//            $grid->addContent($dispSqlMode2);
            $grid->addContent(static::sessionVars());
            $grid->addContent(static::userPrivileges());

            /**
             * @todo handle character_set_....
             * show global variables like 'character\_set\_%'
             * 
             * SELECT @@GLOBAL.character_set_, etc.;
             */
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
        $table->addContent(View\FormInput::formPostOnSelf("setSqlMode"));
        $table->addHeader(["", "Class", "Database", "Validator"]);
        foreach (static::databases() as $databaseInstance) {
            $manejador = new \GIndie\DBHandler\MySQL57\Handler\Database($databaseInstance);
            $table->addRow(static::dsplyRowDatabase($manejador));
        }
        return $table;
    }

    /**
     * 
     * @param \GIndie\DBHandler\MySQL57\Handler\Database $databaseHandler
     * @return array
     * @since 18-08-15
     */
    private static function dsplyRowDatabase(\GIndie\DBHandler\MySQL57\Handler\Database $databaseHandler)
    {
        $button = new \GIndie\ScriptGenerator\Bootstrap3\Component\Button("Select", "submit");
        $button->addClass("btn-sm");
        $button->setForm("selectDatabase");
        $button->setAttribute("name", "databaseId");
        $button->setValue(\urlencode(\get_class($databaseHandler->getDatabase())));
        try {
            $databaseHandler->execValidation();
            $rtnRow = new \GIndie\ScriptGenerator\Bootstrap3\Tables\Row([$button, \get_class($databaseHandler->getDatabase()), $databaseHandler->getDatabase()->name(), "---"]);
            $rtnRow->setAttribute("class", "success");
        } catch (\GIndie\DBHandler\ExceptionDBHandler $exc) {
            switch ($exc->getCode())
            {
                case \GIndie\DBHandler\ExceptionDBHandler::NO_DATABASE:
                    $rtnRow = new \GIndie\ScriptGenerator\Bootstrap3\Tables\Row([$button, \get_class($databaseHandler->getDatabase()), $databaseHandler->getDatabase()->name(), $exc->getMessage()]);
                    $rtnRow->setAttribute("class", "bg-danger");
                    break;
                default:
                    $rtnRow = new \GIndie\ScriptGenerator\Bootstrap3\Tables\Row([$button, \get_class($databaseHandler->getDatabase()), $databaseHandler->getDatabase()->name(), $exc->getMessage()]);
                    $rtnRow->setAttribute("class", "bg-danger");
//                    \trigger_error("test ".$exc->getCode(), \E_USER_ERROR);
                    break;
            }
        }
        return $rtnRow;
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
     * @param \GIndie\DBHandler\MySQL57\Handler\Database $dbHandler
     * @return \GIndie\ScriptGenerator\Dashboard\Alert
     * @since 18-08-15
     */
    private static function dsplyValidatorDatabase(\GIndie\DBHandler\MySQL57\Handler\Database $dbHandler)
    {
        try {
            if ($dbHandler->execValidation()) {
                $button = new \GIndie\ScriptGenerator\Bootstrap3\Component\Button("Drop database",
                    "submit");
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
                    $button = new \GIndie\ScriptGenerator\Bootstrap3\Component\Button("Create database",
                        "submit");
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
     * @edit 18-09-28
     * - Use runFrameworkFormRequest()
     */
    public static function widgetDatabase()
    {
        static::runFrameworkFormRequest();
        $tmpDBclass = \urldecode($_POST["databaseId"]);
        $tmpDBclass = new $tmpDBclass();
        $tmpDBHandler = new \GIndie\DBHandler\MySQL57\Handler\Database($tmpDBclass);
        $widget = new View\Widget("Database Model <b>" . \get_class($tmpDBclass) . "</b>", true,
            true, true);
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
     * @param \GIndie\DBHandler\MySQL57\Handler\Table $tableHandler
     * @return \GIndie\Framework\View\Alert
     * @since 18-08-15
     */
    private static function dsplyValidatorTable(\GIndie\DBHandler\MySQL57\Handler\Table $tableHandler)
    {
        try {
            if ($tableHandler->execValidation()) {
                $button = new \GIndie\ScriptGenerator\Bootstrap3\Component\Button("Drop table",
                    "submit");
                $button->addClass("btn-sm pull-right");
                $button->setContext("danger");
                $button->setForm("dropTable");
                $button->setAttribute("name", "tableId");
                $button->setValue(\urlencode(\get_class($tableHandler->getTable())));

                $rtnValidator = View\Alert::success("Table validation: Passed!" . $button);
                $rtnValidator->addContent(View\FormInput::formPostOnSelf("dropTable"));
            }
        } catch (\GIndie\DBHandler\ExceptionDBHandler $exc) {
            $button = new \GIndie\ScriptGenerator\Bootstrap3\Component\Button("Create table",
                "submit");
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
     * @param \GIndie\DBHandler\MySQL57\Handler\Table $tableHandler
     * @return \GIndie\Framework\View\Table
     * @since 18-08-15
     * @edit 18-08-20
     * - Abstracted and renamed method
     */
    private static function dsplyTableModelDefinition(\GIndie\DBHandler\MySQL57\Instance\Table $tableInstance)
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
     * @var array|\GIndie\DBHandler\MySQL57\Instance\ColumnDefinition
     * @since 18-11-15
     */
    protected static $modelColumns;

    /**
     * 
     * @param \GIndie\DBHandler\MySQL57\Instance\Table $tableInstance
     * @return \GIndie\Framework\View\Table
     * @since 18-08-20
     * @edit 18-11-15
     * - Stores the model's columns.
     */
    private static function dsplyTableModelColumns(\GIndie\DBHandler\MySQL57\Instance\Table $tableInstance)
    {
        $span = \GIndie\ScriptGenerator\HTML5\Category\StylesSemantics::span();
        $tableColumns = View\Table::displayArray(
                [
                ], "Model column definition"
            )->addClass("table");
        static::$modelColumns = [];
        foreach ($tableInstance->columns() as $columnName => $tmpColumnDefinition) {
            static::$modelColumns[$columnName] = $tmpColumnDefinition;
            $tableColumns->addRow([$columnName, $tmpColumnDefinition->getColumnDefinition()]);
        }
        $span->addContent($tableColumns);
        $span->addClass("col-sm-6");
        return $span;
    }

    /**
     * 
     * @param \GIndie\DBHandler\MySQL57\Instance\Table $tableInstance
     * @return \GIndie\ScriptGenerator\HTML5\Category\StylesSemantics\Span
     * @since 18-08-20
     */
    private static function dsplyTableModelReferenceDefinition(\GIndie\DBHandler\MySQL57\Instance\Table $tableInstance)
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
     * @edit 19-12-20
     * - Added automatic form creation
     */
    public static function widgetTable()
    {
        $tmpTableclass = \urldecode($_POST["tableId"]);
        $tmpTableclass = $tmpTableclass::instance();
        $tmpTableHandler = new \GIndie\DBHandler\MySQL57\Handler\Table($tmpTableclass);
        $widget = new View\Widget("Table Model <b>" . \get_class($tmpTableclass) . "</b>", true,
            true, true, true);
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
            $widget->addContent(static::dsplyTableColumnsMissing($tmpTableHandler));
            $widget->addContent(View\FormInput\InstanceFromDBHandler::getForm($tmpTableclass));
        }

        //$widget->addActionPost($formId, $params);
        $widget->getFooter()->addContent(View\FormInput::formPostOnSelf("selectDatabase"));
        $button = new \GIndie\ScriptGenerator\Bootstrap3\Component\Button("Return to database",
            "submit");
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
     * @param \GIndie\DBHandler\MySQL57\Handler\Table $tableHandler
     * @edit 19-06-30
     * - use of View\FormInput
     */
    private static function dsplyTableColumnsMissing(\GIndie\DBHandler\MySQL57\Handler\Table $tableHandler)
    {

        $table = View\Table::displayArray(
                [], "Missing columns"
            )->addClass("table");
        $table->addHeader(["Actions", "Column", "Column definition"]);
        $missing = \array_diff_key(static::$modelColumns, static::$dbmsColumns);
//        $table->addContent(View\FormInput::formPostOnSelf("selectTable"));
        $formTemp = View\FormInput::formPostOnSelf("addColumn");
        $formTemp->addInput(View\FormInput::inputHidden("databaseId",
                \urlencode($tableHandler->getTable()->databaseClassname())));
        $formTemp->addInput(View\FormInput::inputHidden("tableId",
                \urlencode(\get_class($tableHandler->getTable()))));
        $table->addContent($formTemp);
        foreach ($missing as $column => $columnDefinition) {
//            $table->addRow([$column, $columnDefinition->getColumnDefinition()]);
            $buttonAddColumn = View\FormInput::buttonSubmitForm("addColumn", "Add Column",
                    "columnId", \urlencode($column));
            $buttonAddColumn->setContext("success");
            $row = $table->addRowGetPointer([$buttonAddColumn, $column, $columnDefinition->getColumnDefinition()]);
            $row->setAttribute("class", "danger");
        }
        return $table;
    }

    /**
     *
     * @var string|array
     * @since 18-11-15
     */
    protected static $dbmsColumns;

    /**
     * 
     * @param \GIndie\DBHandler\MySQL57\Handler\Table $tableHandler
     * @return \GIndie\Framework\View\Table
     * @since 18-08-16
     * @edit 18-11-15
     * - Stores the dbms's columns.
     * @edit 19-01-29
     * - Added Column for actions
     * - Functional "Update field" button
     * @edit 19-06-30
     * - use of View\FormInput
     */
    private static function dsplyTableColumns(\GIndie\DBHandler\MySQL57\Handler\Table $tableHandler)
    {
        $table = View\Table::displayArray(
                [], "DBMS columns"
            )->addClass("table table-condensed table-responsive");
//        $table->addContent(View\FormInput::formPostOnSelf("updateField"));
        $formTemp = View\FormInput::formPostOnSelf("updateField");
        $formTemp->addInput(View\FormInput::inputHidden("databaseId",
                \urlencode($tableHandler->getTable()->databaseClassname())));
        $formTemp->addInput(View\FormInput::inputHidden("tableId",
                \urlencode(\get_class($tableHandler->getTable()))));
        $table->addContent($formTemp);
        $result = $tableHandler->showColumns();
        $headerTmp = ["Actions"];
        foreach ($result->fetch_fields() as $field) {
            $headerTmp[] = $field->name;
        }
        $table->addHeader($headerTmp);
        static::$dbmsColumns = [];
        foreach ($result->fetch_all(\MYSQLI_ASSOC) as $definition) {
            static::$dbmsColumns[$definition["Field"]] = $definition;
            $button = new Bootstrap3\Component\Button("Update field", "submit");
            $button->addClass("btn-sm pull-right");
            $button->setForm("updateField");
            $button->setContext("success");
            $button->setAttribute("name", "fieldName");
            $button->setValue($definition["Field"]);
            $rowActions = $button;
            $table->addRow(\array_merge([$rowActions], $definition));
        }
        return $table;
    }

    /**
     * 
     * @return GIndie\Framework\View\Table
     * @since 18-08-02
     * @edit 18-08-15
     * - Upgraded code
     * @edit 18-09-28
     * - Added functional create (table) button.
     * @edit 18-09-29
     * - Use View\FormInput::buttonSubmitForm
     * @edit 19-06-30
     * - use of View\FormInput
     */
    private static function dsplyTables(\GIndie\DBHandler\MySQL57\Handler\Database $dbHandler)
    {
        $table = View\Table::selectable();
        $table->addHeader(["", "Class", "Table", "Validator"]);
        $table->addContent(View\FormInput::formPostOnSelf("selectTable"));
        $formTemp = View\FormInput::formPostOnSelf("createTableFromDatabase");
        $formTemp->addInput(View\FormInput::inputHidden("databaseId",
                \urlencode(\get_class($dbHandler->getDatabase()))));
        $table->addContent($formTemp);
        foreach ($dbHandler->getTables() as $classname => $tableHandler) {
            $buttonSelect = View\FormInput::buttonSubmitForm("selectTable", "Select", "tableId",
                    \urlencode($classname));
            try {
                $tableHandler->execValidation();
//                $buttonSelect = new \GIndie\ScriptGenerator\Bootstrap3\Component\Button("Select", "submit");
//                $buttonSelect->addClass("btn-sm");
//                $buttonSelect->setForm("selectTable");
//                $buttonSelect->setAttribute("name", "tableId");
//                $buttonSelect->setValue(\urlencode($classname));
//                $buttonSelect->setContext("primary");
                //$row = $table->addRowGetPointer(static::constructRow($tableHandler));
                $row = $table->addRowGetPointer([$buttonSelect, \get_class($tableHandler->getTable()), $tableHandler->getTable()->name(), "OK"]);
                $row->setAttribute("class", "success");
                //$row->addClass("bg-success");
            } catch (\GIndie\DBHandler\ExceptionDBHandler $exc) {

                //$buttonSelect->setContext("primary");

                $buttonCreateTable = View\FormInput::buttonSubmitForm("createTableFromDatabase",
                        "Create", "tableId", \urlencode($classname));
                $buttonCreateTable->setContext("success");
                $row = $table->addRowGetPointer([[$buttonSelect, $buttonCreateTable], \get_class($tableHandler->getTable()), $tableHandler->getTable()->name(), $exc->getMessage()]);
                $row->setAttribute("class", "danger");
            }
        }

        return $table;
    }

    /**
     * 
     * @param \GIndie\DBHandler\MySQL57\Handler\Table $tableHandler
     * @return type
     * @since 18-08-07
     * @todo
     * - Upgrade row creation
     */
    private static function constructRowDPR(\GIndie\DBHandler\MySQL57\Handler\Table $tableHandler)
    {
        $tableHandler->execValidation();
        return [$tableHandler->getTable()->name(), "@todo"];
    }

    /**
     * @return \GIndie\DBHandler\MySQL57\Instance\Database
     * @since 18-08-02
     */
    abstract protected static function databases();

    /**
     * 
     * @since 18-04-07
     * @return \mysqli_result|boolean <b>FALSE</b> on failure. For successful SELECT, 
     * SHOW, DESCRIBE or EXPLAIN queries <b>mysqli_query</b> will return a 
     * <b>mysqli_result</b> object. For other successful queries <b>mysqli_query</b> 
     * will return <b>TRUE</b>.
     * @edit 18-08-02
     * - Use static::databaseHandler()
     * @edit 18-08-14
     * - Return grid()
     * @edit 18-08-15
     * - Return widgetDatabase()
     * @edit 18-09-29
     * - Return query
     */
    public static function createDatabase()
    {
        $tmpDBclass = \urldecode($_POST["databaseId"]);
        $tmpDBclass = new $tmpDBclass();
        $tmpDBHandler = new \GIndie\DBHandler\MySQL57\Handler\Database($tmpDBclass);
        return \GIndie\DBHandler\MySQL57::query($tmpDBHandler->stmCreate());
//        return static::widgetDatabase();
    }

    /**
     * 
     * @since 18-08-02
     * @return \mysqli_result|boolean <b>FALSE</b> on failure. For successful SELECT, 
     * SHOW, DESCRIBE or EXPLAIN queries <b>mysqli_query</b> will return a 
     * <b>mysqli_result</b> object. For other successful queries <b>mysqli_query</b> 
     * will return <b>TRUE</b>.
     * @edit 18-08-14
     * - Return grid()
     * @edit 18-08-15
     * - Return widgetDatabase()
     * @edit 18-09-29
     * - Return query
     */
    public static function dropDatabase()
    {
        $tmpDBclass = \urldecode($_POST["databaseId"]);
        $tmpDBclass = new $tmpDBclass();
        $tmpDBHandler = new \GIndie\DBHandler\MySQL57\Handler\Database($tmpDBclass);
        return \GIndie\DBHandler\MySQL57::query($tmpDBHandler->stmDrop());
//        return static::widgetDatabase();
    }

}
