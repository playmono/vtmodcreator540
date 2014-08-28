<?php
/*+***********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.1
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 *************************************************************************************/
function getSelectedFields() {
	$values = Array();
	foreach($_REQUEST as $key=>$value) {
		if(strpos($key, 'fieldid_') === 0) {
			$values[] = $value;
		}
	}
	return $values;
}

include_once('models/Filter.php');

$mode = $_REQUEST['mode'];

if($mode == 'delete') {
	$focus = Filter::getById($_REQUEST['id']);
	$focus->delete();
	header("Location: index.php?action=ListFilter&moduleid=$focus->moduleid");
} else {
	$focus = new Filter();
	$newfocus = false;

	$relfields = getSelectedFields();

	if($_REQUEST['id']) {
		$focus = Filter::getById($_REQUEST['id']);
		$newfocus = new Filter();
		$newfocus->initialize($_REQUEST);
	} else {
		$focus->initialize($_REQUEST);
	}
	$focus->save($newfocus);

	$focus->updateFields($relfields);

	header("Location: index.php?action=ListFilter&moduleid=$focus->moduleid");
}

?>
