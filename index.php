<?php
/*+***********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.1
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 *************************************************************************************/
require_once('ModCreatorSmarty.php');
require_once('config.php');

$useaction = $_REQUEST['action'];
if(!$useaction) $useaction = 'Home';

/** We need to strip the extra slashes added by php **/
function vtmodcreator_stripslashes($value) {
	if(is_string($value)) return stripslashes($value);
	return $value;
}
if(get_magic_quotes_gpc() == 1) {
	$_REQUEST = array_map("vtmodcreator_stripslashes", $_REQUEST);
	$_POST    = array_map("vtmodcreator_stripslashes", $_POST);
	$_GET     = array_map("vtmodcreator_stripslashes", $_GET);
}

// TODO Check file access before inclusion
include("actions/$useaction.php");

?>
