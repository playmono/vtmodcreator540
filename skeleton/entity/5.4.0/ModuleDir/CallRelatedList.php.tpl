<?php
#LICENSETEXT#
require_once('Smarty_setup.php');
require_once('user_privileges/default_module_view.php');

global $mod_strings, $app_strings, $currentModule, $current_user, $theme, $singlepane_view;

$category = getParentTab();
$action = vtlib_purify($_REQUEST['action']);
$record = vtlib_purify($_REQUEST['record']);
$isduplicate = vtlib_purify($_REQUEST['isDuplicate']);

if($singlepane_view == 'true' && $action == 'CallRelatedList') {
	header("Location:index.php?action=DetailView&module=$currentModule&record=$record&parenttab=$category");
} else {
	
	$tool_buttons = Button_Check($currentModule);

	$focus = CRMEntity::getInstance($currentModule);
	if($record != '') {
	    $focus->retrieve_entity_info($record, $currentModule);
   		$focus->id = $record;
	}

	$smarty = new vtigerCRM_Smarty;

	if($isduplicate == 'true') $focus->id = '';
	if(isset($_REQUEST['mode']) && $_REQUEST['mode'] != ' ') $smarty->assign("OP_MODE",vtlib_purify($_REQUEST['mode']));
	if(!$_SESSION['rlvs'][$currentModule]) unset($_SESSION['rlvs']);

	// Identify this module as custom module.
	$smarty->assign('CUSTOM_MODULE', true);

	$smarty->assign('APP', $app_strings);
	$smarty->assign('MOD', $mod_strings);
	$smarty->assign('MODULE', $currentModule);
	// TODO: Update Single Module Instance name here.
	$smarty->assign('SINGLE_MOD', getTranslatedString('SINGLE_'.$currentModule)); 
	$smarty->assign('CATEGORY', $category);
	$smarty->assign('IMAGE_PATH', "themes/$theme/images/");
	$smarty->assign('THEME', $theme);
	$smarty->assign('ID', $focus->id);
	$smarty->assign('MODE', $focus->mode);
	$smarty->assign('CHECK', $tool_buttons);

	$smarty->assign('NAME', $focus->column_fields[$focus->def_detailview_recname]);
	$smarty->assign('UPDATEINFO',updateInfo($focus->id));
	
	// Module Sequence Numbering
	$mod_seq_field = getModuleSequenceField($currentModule);
	if ($mod_seq_field != null) {
		$mod_seq_id = $focus->column_fields[$mod_seq_field['name']];
	} else {
		$mod_seq_id = $focus->id;
	}
	$smarty->assign('MOD_SEQ_ID', $mod_seq_id);
	// END

	$related_array = getRelatedLists($currentModule, $focus);

	$smarty->assign('RELATEDLISTS', $related_array);
	$smarty->display('RelatedLists.tpl');
}
?>