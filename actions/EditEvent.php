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
include_once('models/Event.php');

$module = false;
if($_REQUEST['moduleid']) {
	$module = Module::getById($_REQUEST['moduleid']);
}
if(!$module) $module = new Module();

$event = false;
if($_REQUEST['id']) {
	$event = Event::getById($_REQUEST['id']);
}
if(!$event) $event = new Event();

$smarty = new ModCreatorSmarty();
$smarty->assign('MODULE', $module);
$smarty->assign('EVENT', $event);

if($event->id) $smarty->display('EditEvent.tpl');
else $smarty->display('CreateEvent.tpl');
?>
