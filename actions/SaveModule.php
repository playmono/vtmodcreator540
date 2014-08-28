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

$mode = $_REQUEST['mode'];

if($mode == 'delete') {
	$focus = Module::getById($_REQUEST['id']);
	$focus->delete();
	header("Location: index.php");
} else {
	
	$focus = new Module();
	$newfocus = false;
	$newmodule = false;

	if($_REQUEST['id']) {
		$focus = Module::getById($_REQUEST['id']);
		$newfocus = new Module();
		$newfocus->initialize($_REQUEST);
	} else {
		$focus->initialize($_REQUEST);
		$newmodule = true;
	}
	$focus->save($newfocus);

	if($newmodule) {
		if($focus->isextension) header("Location: index.php?action=EditModule&id=$focus->id");
		else header("Location: index.php?action=EditField&moduleid=$focus->id");
	}
	else header('Location: index.php');
}

?>
