<?php
#LICENSETEXT#
global $mod_strings,$app_strings,$theme,$currentModule,$current_user;

require_once('Smarty_setup.php');
require_once('include/utils/utils.php');

$focus = CRMEntity::getInstance($currentModule);
$focus->mode = '';
$mode = 'mass_edit';

$disp_view = getView($focus->mode);
$idstring = $_REQUEST['idstring'];

$smarty = new vtigerCRM_Smarty;
$smarty->assign('MODULE',$currentModule);
$smarty->assign('APP',$app_strings);
$smarty->assign('THEME', $theme);
$smarty->assign('IMAGE_PATH', "themes/$theme/images/");
$smarty->assign('IDS',$idstring);
$smarty->assign('MASS_EDIT','1');
$smarty->assign('BLOCKS',getBlocks($currentModule,$disp_view,$mode,$focus->column_fields));	
$smarty->assign("CATEGORY",getParentTab());

// Field Validation Information 
$tabid = getTabid($currentModule);
$validationData = getDBValidationData($focus->tab_name,$tabid);
$validationArray = split_validationdataArray($validationData);

$smarty->assign("VALIDATION_DATA_FIELDNAME",$validationArray['fieldname']);
$smarty->assign("VALIDATION_DATA_FIELDDATATYPE",$validationArray['datatype']);
$smarty->assign("VALIDATION_DATA_FIELDLABEL",$validationArray['fieldlabel']);

$smarty->display('MassEditForm.tpl');

?>