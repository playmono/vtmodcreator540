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
include_once('models/Block.php');

$module = false;
if($_REQUEST['moduleid']) {
	$module = Module::getById($_REQUEST['moduleid']);
}
if(!$module) $module = new Module();

$field = false;
if($_REQUEST['id']) {
	$field = Field::getById($_REQUEST['id']);
}
if(!$field) $field = new Field();

$smarty = new ModCreatorSmarty();
$smarty->assign('MODULE', $module);
$smarty->assign('BLOCKS', $module->getBlocks());
$smarty->assign('TABLES', $module->getTables());
$smarty->assign('TABLES', $module->getTables());
$smarty->assign('UITYPES', UITypes::getAsMap());
$smarty->assign('FIELD', $field);

if($field->id) $smarty->display('EditField.tpl');
else $smarty->display('CreateField.tpl');
?>
