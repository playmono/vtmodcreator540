<?php
/*+***********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.1
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 *************************************************************************************/
include_once('models/Table.php');

$mode = $_REQUEST['mode'];

if($mode == 'delete') {
	$focus = Table::getById($_REQUEST['id']);
	$focus->delete();
	header("Location: index.php?action=ListTable&moduleid=$focus->moduleid");
} else {
	$focus = new Table();
	$newfocus = false;

	if($_REQUEST['id']) {
		$focus = Table::getById($_REQUEST['id']);
		$newfocus = new Table();
		$newfocus->initialize($_REQUEST);
	} else {
		$focus->initialize($_REQUEST);
	}
	$focus->save($newfocus);
	header("Location: index.php?action=ListTable&moduleid=$focus->moduleid");
}

?>
