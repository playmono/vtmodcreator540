<?php
/*+***********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.1
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 *************************************************************************************/
include_once('models/Block.php');
include_once('models/Table.php');
include_once('models/Filter.php');
include_once('models/Event.php');

class Module {
	var $id;
	var $modulename;
	var $label;
	var $parent;
	var $forversion;
	var $licensetext;
	var $isextension;

	// List of all the class fields for easy initialization
	var $fields = Array('id', 'modulename', 'label', 
		'parent', 'forversion', 'licensetext', 'isextension','version');

	function __construct() {		
	}

	function initialize($valuemap) {
		foreach($this->fields as $field) {
			$this->$field = $valuemap[$field];
		}
	}	

	function save($otherInstance=false) {
		global $adb;

		if($this->id) {
			$usemodulename = $otherInstance->modulename? $otherInstance->modulename : $this->modulename;
			$uselabel = $otherInstance->label? $otherInstance->label : $this->label;
			$useparent= $otherInstance->parent;
			$useforversion= $otherInstance->forversion? $otherInstance->forversion : $this->forversion;
			$uselicensetext= $otherInstance->licensetext? $otherInstance->licensetext : $this->licensetext;
			$useversion= $otherInstance->version? $otherInstance->version : $this->version;
			$useisextension= $otherInstance->isextension? 1 : 0;

			$adb->pquery(
				"UPDATE vtiger_mc_module SET modulename=?, label=?, parent=?, forversion=?, licensetext=?, isextension=?, version=? WHERE id=?",
				Array($usemodulename, $uselabel, $useparent, $useforversion, $uselicensetext, $useisextension, $useversion, $this->id));

		} else {
			$adb->pquery(
				"INSERT INTO vtiger_mc_module(modulename,label,parent,forversion,licensetext,isextension,version) VALUES(?,?,?,?,?,?,?)",
				Array($this->modulename, $this->label, $this->parent, $this->forversion,$this->licensetext,$this->isextension, $this->version)
			);
			$this->id = $adb->database->Insert_ID();

			$this->__createModuleComponents();
		}
	}

	function delete() {
		global $adb;
		if($this->id) {
			Block::deleteForModule($this->id);
			Table::deleteForModule($this->id);
			Filter::deleteForModule($this->id);
			Field::deleteForModule($this->id);			
			Event::deleteForModule($this->id);			
			$adb->pquery("DELETE FROM vtiger_mc_module WHERE id=?", Array($this->id));
		}
	}

	function __createModuleComponents() {
		$usename = strtolower($this->modulename);
		// TODO: Knock off spaces, underscores, ... from usename

		if(!$this->isextension) {
			// Create necessary block for the module
			$modblock = new Block();
			$modblock->moduleid = $this->id;
			$modblock->label = 'LBL_' . strtoupper($usename) . '_INFORMATION';
			$modblock->trlabel = ucwords($usename) . ' Information';
			$modblock->save();

			$customblock = new Block();
			$customblock->moduleid = $this->id;
			$customblock->label = 'LBL_CUSTOM_INFORMATION';
			$customblock->trlabel = 'Custom Information';
			$customblock->save();

			// Create necessary table for the module
			$basetable = new Table();
			$basetable->moduleid = $this->id;
			$basetable->tabletype = 'BASE';
			$basetable->tablename = "vtiger_$usename";
			$basetable->refcolumn = $usename . "id";
			$basetable->sqlquery  = "CREATE TABLE " . $basetable->tablename . "(" . $basetable->refcolumn ." INT)";
			$basetable->save();

			$customtable = new Table();
			$customtable->moduleid = $this->id;
			$customtable->tabletype = 'CUSTOM';
			$customtable->tablename = "vtiger_$usename" . "cf";
			$customtable->refcolumn = $usename . "id";
			$customtable->sqlquery  = "CREATE TABLE " . $customtable->tablename . "(" . $customtable->refcolumn ." INT NOT NULL PRIMARY KEY)";
			$customtable->save();

			$grouptable = new Table();
			$grouptable->moduleid = $this->id;
			$grouptable->tabletype = 'GROUP';
			$grouptable->tablename = "vtiger_$usename" . "grouprel";
			$grouptable->refcolumn = $usename . "id";
			$grouptable->sqlquery  = "CREATE TABLE " . $grouptable->tablename . "(" . $grouptable->refcolumn . " INT NOT NULL PRIMARY KEY, groupname VARCHAR(100))";
			$grouptable->save();

			$coretable = new Table();
			$coretable->moduleid = $this->id;
			$coretable->tabletype = 'CORE';
			$coretable->tablename = 'vtiger_crmentity';
			$coretable->refcolumn = 'crmid';
			$coretable->sqlquery  = '';
			$coretable->save();

			// Create basic required fields
			$ownerfield = new Field();
			$ownerfield->moduleid = $this->id;
			$ownerfield->blockid  = $modblock->id;
			$ownerfield->tableid  = $coretable->id;
			$ownerfield->fieldname = 'assigned_user_id';
			$ownerfield->uitype    = 53;
			$ownerfield->columnname= 'smownerid';
			$ownerfield->generatedtype=1;
			$ownerfield->label     = 'Assigned To';
			$ownerfield->trlabel   = $ownerfield->label;
			$ownerfield->readonly  = 1;
			$ownerfield->presence  = 0;
			$ownerfield->selected  = 0;
			$ownerfield->maximumlength = 100;
			$ownerfield->quickcreate= 1;
			$ownerfield->displaytype= 1;
			$ownerfield->infotype  = 'BAS';
			$ownerfield->ismandatory= 1;
			$ownerfield->isentityfield= 0;
			$ownerfield->masseditable=1;
			$ownerfield->save();

			$ctimefield = new Field();
			$ctimefield->moduleid = $this->id;
			$ctimefield->blockid  = $modblock->id;
			$ctimefield->tableid  = $coretable->id;
			$ctimefield->fieldname = 'createdtime';
			$ctimefield->uitype    = 70;
			$ctimefield->columnname= 'createdtime';
			$ctimefield->generatedtype=1;
			$ctimefield->label     = 'Created Time';
			$ctimefield->trlabel   = $ctimefield->label;
			$ctimefield->readonly  = 1;
			$ctimefield->presence  = 0;
			$ctimefield->selected  = 0;
			$ctimefield->maximumlength = 100;
			$ctimefield->quickcreate= 1;
			$ctimefield->displaytype= 2;
			$ctimefield->infotype  = 'BAS';
			$ctimefield->ismandatory= 0;
			$ctimefield->isentityfield= 0;
			$ctimefield->masseditable=0;
			$ctimefield->save();

			$mtimefield = new Field();
			$mtimefield->moduleid = $this->id;
			$mtimefield->blockid  = $modblock->id;
			$mtimefield->tableid  = $coretable->id;		
			$mtimefield->fieldname = 'modifiedtime';
			$mtimefield->uitype    = 70;
			$mtimefield->columnname= 'modifiedtime';
			$mtimefield->generatedtype=1;
			$mtimefield->label     = 'Modified Time';
			$mtimefield->trlabel   = $mtimefield->label;
			$mtimefield->readonly  = 1;
			$mtimefield->presence  = 0;
			$mtimefield->selected  = 0;
			$mtimefield->maximumlength = 100;
			$mtimefield->quickcreate= 1;
			$mtimefield->displaytype= 2;
			$mtimefield->infotype  = 'BAS';
			$mtimefield->ismandatory= 0;
			$mtimefield->isentityfield= 0;
			$mtimefield->masseditable=0;
			$mtimefield->save();

			// Create a default filter for the module
			$allfilter = new Filter();
			$allfilter->moduleid = $this->id;
			$allfilter->filtername = 'All';
			$allfilter->save();
			$allfilter->updateFields(Array($ownerfield->id, $ctimefield->id, $mtimefield->id));
		}
	}

	function getBlocks() {
		return Block::getAll($this->id);
	}

	function getFields() {
		return Field::getAll($this->id);
	}

	function getTables() {
		return Table::getAll($this->id);
	}

	function getFilters() {
		return Filter::getAll($this->id);
	}

	function getEvents() {
		return Event::getAll($this->id);
	}

	function getLicenseText() {
		$licensetext = "/** YOUR LICENSE TEXT HERE **/";
		if($this->licensetext !='') $licensetext = $this->licensetext;
		return $licensetext;
	}

	static function __getAsList($result) {
		global $adb;
		$modules = Array();
		if($adb->num_rows($result)) {
			for($index = 0; $index < $adb->num_rows($result); ++$index) {
				$module = new Module();
				$module->initialize($adb->fetch_array($result, $index));
				$modules[] = $module;
			}
		}
		return $modules;		
	}

	static function getById($id) {
		global $adb;
		$result = $adb->pquery("SELECT * FROM vtiger_mc_module WHERE id=? ORDER BY id ASC", Array($id));
		$modules = self::__getAsList($result);
		if(!empty($modules)) return $modules[0];
		return false;
	}

	static function getByName($modulename) {
		global $adb;
		$result = $adb->pquery("SELECT * FROM vtiger_mc_module WHERE modulename=?", Array($modulename));
		return self::__getAsList($result);
	}

	static function getAll() {
		global $adb;
		$result = $adb->query("SELECT * FROM vtiger_mc_module");
		return self::__getAsList($result);
	}

}

?>
