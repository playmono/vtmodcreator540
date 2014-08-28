<?php
/*+***********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.1
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 *************************************************************************************/
include_once('models/Module.php');

$module = false;
if($_REQUEST['moduleid']) {
	$module = Module::getById($_REQUEST['moduleid']);
}
if(!$module) $module = new Module();

$table = false;
if($_REQUEST['id']) {
	$table = Table::getById($_REQUEST['id']);
}
if(!$table) $table = new Table();

$smarty = new ModCreatorSmarty();
$smarty->assign('MODULE', $module);
$smarty->assign('TABLE', $table);

if($table->id) $smarty->display('EditTable.tpl');
else $smarty->display('CreateTable.tpl');
?>
