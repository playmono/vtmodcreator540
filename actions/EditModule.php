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
if($_REQUEST['id']) {
	$module = Module::getById($_REQUEST['id']);
}
if(!$module) $module = new Module();

$smarty = new ModCreatorSmarty();
$smarty->assign('MODULE', $module);

if($module->id) $smarty->display('EditModule.tpl');
else $smarty->display('CreateModule.tpl');
?>
