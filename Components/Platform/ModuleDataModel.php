<?php

/**
 * GI-DBHandler-DVLP - ModuleDataModel
 *
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * @copyright (CC) 2020 Angel Sierra Vega. Grupo INDIE.
 * @license file://LICENSE
 *
 * @package GIndie\DBHandler\Components\Platform
 *
 * @version 00.A3
 * @since 18-05-21
 */

namespace GIndie\DBHandler\Components\Platform;

use GIndie\DBHandler\Components\DatabaseDefinitionTest;
use GIndie\Platform\View;

/**
 * Module that handles the administration of predefined classes representing
 * Databases and Tables
 * @edit 18-10-02
 * - Upgraded version
 * @todo
 * - Check implementation
 * 
 */
class ModuleDataModel extends \GIndie\Platform\Controller\Module
{

    /**
     * 
     * @return \GIndie\Platform\View\Widget
     */
    public function wdgtTables()
    {
        $rtnWidget = new View\Widget("@wdgtTables", false, false);
        return $rtnWidget;
    }

    /**
     * @since 18-05-21
     * - Functional method
     * @return \GIndie\Platform\View\Widget
     * @todo 
     * - Validate database model
     * - Upgrade display
     */
    public function wdgtDatabaseModel()
    {
        if (isset($this->currentDatabase)) {
            $rtnWidget = new View\Widget("Database Model - " . $this->currentDatabase->name(),
                                         false, false);
            $table = new \GIndie\ScriptGenerator\Dashboard\Tables\Table();
            $table->addHeader(["name", "charset", "collation"]);
            $table->addRow([$this->currentDatabase->name(),
                $this->currentDatabase->charset(),
                $this->currentDatabase->collation()]);
            $rtnWidget->addContent($table);
        } else {
            $rtnWidget = new View\Widget("Database Model - No database selected",
                                         false, false);
        }
        $rtnWidget->addButtonHeading(\GIndie\Platform\View\Widget\Buttons::Reload());
        return $rtnWidget;
    }

    /**
     * @var GIndie\DBHandler\MySQL57\DataDefinition\Identifiers\Database|null The instance of the
     * currently selected database.
     */
    private $currentDatabase;

    /**
     * 
     * @param string $placeholderId
     * @param string $selectedId
     * @return \GIndie\ScriptGenerator\HTML5\Category\StylesSemantics\Span
     * @since 18-05-21
     * - Functional method
     */
    protected function runActionSelectRow($placeholderId, $selectedId)
    {
        switch ($placeholderId)
        {
            case "i-iii-i":
                $this->currentDatabase = new $selectedId();
                break;
        }
        return parent::runActionSelectRow($placeholderId, $selectedId);
    }

    /**
     * 
     * @return \GIndie\Platform\View\Widget
     * @since 18-05-21
     * - Functional method
     */
    public function wdgtDatabases()
    {
        $this->currentDatabase = null;
        $form = new \GIndie\Platform\View\Form(null, false, false);
        $form->addContent(View\Input::hidden("@placeholderId", "i-iii-i"));
        $form->setAttribute("gip-action", "@selectRow");
        $form->addSubmitOnChange();
        $tableSelectable = new \GIndie\ScriptGenerator\Dashboard\Tables\Selectable();
        $tableSelectable->addHeader(["#", "Database"]);

        foreach (static::databaseClasses() as $databaseClass) {
            $tableSelectable->addSelectableRow($databaseClass,
                                               [$databaseClass::name()]);
        }

        $form->addContent($tableSelectable);
        $rtnWidget = new View\Widget("Databases", $form, false);
        $rtnWidget->addButtonHeading(\GIndie\Platform\View\Widget\Buttons::Reload());
        $rtnWidget->setContext("primary");
        return $rtnWidget;
    }

    /**
     * Defines the required roles for the module
     * @return array
     * @since 18-05-21
     * - Functional method
     */
    public static function requiredRoles()
    {
        return ["AS"];
    }

    /**
     * Defines the array of database classes to be used by the module
     * @return array
     * @since 18-05-21
     * - Functional method
     */
    public static function databaseClasses()
    {
        return [DatabaseDefinitionTest\DBTest::class];
    }

    /**
     * Defines the placeholder structure
     * 
     * @since 18-05-21
     * - Functional method
     * @edit 18-07-16
     * - Use placeholder() instead of configPlaceholder()
     */
    public function config()
    {
        /**
         * [Databases][DatabaseModel][Tables]
         * 
         */
        $this->placeholder("i-iii-i")->typeCallable([$this, "wdgtDatabases"]);
        $this->placeholder("i-iii-ii")->typeCallable([$this, "wdgtDatabaseModel"]);
        $this->placeholder("i-iii-iii")->typeCallable([$this, "wdgtTables"]);

        /**
         * [TableModel              ]
         * [Columns][ColumnModel]
         * [Restrictions][RestrictionModel]
         * protected function wdgtRestrictions()
         * protected function wdgtRestrictionModel()
         */
        $this->placeholder("ii-i-i")->typeCallable([$this, "wdgtTableModel"]);
        $this->placeholder("ii-ii-i")->typeCallable([$this, "wdgtColumns"]);
        $this->placeholder("ii-ii-ii")->typeCallable([$this, "wdgtColumnModel"]);
        $this->placeholder("iii-ii-i")->typeHTMLString("@wdgtRestrictions");
        $this->placeholder("iii-ii-ii")->typeHTMLString("@wdgtRestrictionModel");

        /**
         * Define slaves for [Databases]
         */
        $this->placeholder("i-iii-i")->addSlave("i-iii-ii");
        $this->placeholder("i-iii-i")->addSlave("i-iii-iii");
        /**
         * Define slaves for [Tables]
         */
        $this->placeholder("i-iii-iii")->addSlave("ii-i-i");
        $this->placeholder("i-iii-iii")->addSlave("ii-ii-i");
        $this->placeholder("i-iii-iii")->addSlave("iii-ii-i");
    }

    /**
     * 
     * @return \GIndie\Platform\View\Widget
     */
    public function wdgtTableModel()
    {
        $rtnWidget = new View\Widget("@wdgtTableModel", false, false);
        return $rtnWidget;
    }

    /**
     * 
     * @return \GIndie\Platform\View\Widget
     */
    public function wdgtColumns()
    {
        $rtnWidget = new View\Widget("@wdgtColumns", false, false);
        return $rtnWidget;
    }

    /**
     * 
     * @return \GIndie\Platform\View\Widget
     */
    public function wdgtColumnModel()
    {
        $rtnWidget = new View\Widget("@wdgtColumnModel", false, false);
        return $rtnWidget;
    }

    /**
     * The name of the module
     */
    const NAME = "ModuleDataModel";

}
