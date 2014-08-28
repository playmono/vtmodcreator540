<?php
#LICENSETEXT#
require_once('include/database/PearDatabase.php');
@include_once('user_privileges/default_module_view.php');

global $adb, $singlepane_view, $currentModule;
$idlist            = vtlib_purify($_REQUEST['idlist']);
$destinationModule = vtlib_purify($_REQUEST['destination_module']);
$parenttab         = getParentTab();

$forCRMRecord = vtlib_purify($_REQUEST['parentid']);
$mode = $_REQUEST['mode'];

if($singlepane_view == 'true')
	$action = "DetailView";
else
	$action = "CallRelatedList";

$focus = CRMEntity::getInstance($currentModule);

if($mode == 'delete') {
	// Split the string of ids
	$ids = explode (";",$idlist);
	if(!empty($ids)) {
		$focus->delete_related_module($currentModule, $forCRMRecord, $destinationModule, $ids);
	}
} else {
	if(!empty($_REQUEST['idlist'])) {
		// Split the string of ids
		$ids = explode (";",trim($idlist,";"));
	} else if(!empty($_REQUEST['entityid'])){
		$ids = $_REQUEST['entityid'];
	}
	if(!empty($ids)) {
		$focus->save_related_module($currentModule, $forCRMRecord, $destinationModule, $ids);
	}
}
header("Location: index.php?module=$currentModule&record=$forCRMRecord&action=$action&parenttab=$parenttab");
?>