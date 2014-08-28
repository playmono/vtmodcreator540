<?php
/*+***********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.1
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 *************************************************************************************/
include_once('models/UITypes.php');

class Field {
	var $id;
	var $moduleid;
	var $blockid;
	var $fieldname;
	var $columnname;
	var $tableid;
	var $label;
	var $trlabel;
	var $uitype;
	var $isentityfield;
	var $ismandatory;
	var $infotype;
	var $displaytype = 1;
	var $helpinfo;
	var $masseditable;

	var $readonly = 1;
	var $presence = 0;
	var $selected = 0;
	var $maximumlength = 100;
	var $quickcreate = false;	
	var $generatedtype = 1;	

	// List of all the class fields for easy initialization
	var $fields = Array('id', 'moduleid', 'blockid', 
		'fieldname', 'columnname', 'tableid', 'label', 'trlabel','uitype',
		'displaytype','isentityfield', 'ismandatory', 'infotype','helpinfo', 
		'masseditable');

	function __construct() {
	}

	function initialize($valuemap) {
		foreach($this->fields as $field) {
			if(isset($valuemap[$field])) $this->$field = $valuemap[$field];
		}
	}	

	function save($otherInstance=false) {
		global $adb;

		if($this->id) {
			$usemoduleid  = $otherInstance->moduleid?    $otherInstance->moduleid   : $this->moduleid;
			$useblockid   = $otherInstance->blockid?     $otherInstance->blockid    : $this->blockid;
			$usefieldname = $otherInstance->fieldname?   $otherInstance->fieldname  : $this->fieldname;
			$usecolumnname= $otherInstance->columnname? $otherInstance->columnname  : $this->columnname;
			$usetableid   = $otherInstance->tableid?     $otherInstance->tableid    : $this->tableid;
			$uselabel     = $otherInstance->label?          $otherInstance->label   : $this->label;
			$usetrlabel   = $otherInstance->trlabel?      $otherInstance->trlabel   : $this->trlabel;
			$useuitype    = $otherInstance->uitype?      $otherInstance->uitype   : $this->uitype;
			$usehelpinfo  = $otherInstance->helpinfo?      $otherInstance->helpinfo   : $this->helpinfo;
			$usemasseditable  = $otherInstance->masseditable;
			$useisentityfield = $otherInstance->isentityfield? 1 : 0;
			$useismandatory = $otherInstance->ismandatory? 1 : 0;
			$usedisplaytype  = $otherInstance->displaytype?   $otherInstance->displaytype    : $this->displaytype;
			$useinfotype  = $otherInstance->infotype?   $otherInstance->infotype    : $this->infotype;

			$adb->pquery(
				"UPDATE vtiger_mc_field SET moduleid=?, blockid=?, fieldname=?, columnname=?,
			   tableid=?,label=?,trlabel=?,uitype=?,isentityfield=?,ismandatory=?,displaytype=?,infotype=?,helpinfo=?,masseditable=? WHERE id=?",
			   Array($usemoduleid, $useblockid, $usefieldname, $usecolumnname, $usetableid, 
			   $uselabel, $usetrlabel, $useuitype, $useisentityfield, $useismandatory,$usedisplaytype,
			   $useinfotype,$usehelpinfo,$usemasseditable,$this->id));

		} else {
			$adb->pquery(
				"INSERT INTO vtiger_mc_field(moduleid,blockid,fieldname,columnname,tableid,label,
				trlabel,uitype,isentityfield,ismandatory,displaytype,infotype,helpinfo,masseditable) 
				VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?)",
					Array($this->moduleid, $this->blockid, $this->fieldname, $this->columnname, $this->tableid, 
					$this->label, $this->trlabel, $this->uitype, $this->isentityfield, $this->ismandatory, 
					$this->displaytype,$this->infotype,$this->helpinfo,$this->masseditable));
			$this->id = $adb->database->Insert_ID();
		}
	}

	function delete() {
		global $adb;
		if($this->id) {
			$adb->pquery("DELETE FROM vtiger_mc_filterfieldrel WHERE fieldid in 
				(SELECT fieldid FROM vtiger_mc_field WHERE moduleid=?)", Array($moduleid));
			$adb->pquery("DELETE FROM vtiger_mc_field WHERE id=?", Array($this->id));
		}
	}

	function getBlockName() {
		if($this->blockid) {
			$block = Block::getById($this->blockid);
			return $block->trlabel;
		}
		return false;
	}

	function getUITypeText() {
		return UITypes::translate($this->uitype);
	}

	function getTypeOfData() {
		$tod = UITypes::getDataType($this->uitype, false);
		if($this->ismandatory) $tod = "$tod~M";
		else $tod = "$tod~O";
		return $tod;
	}
	function getColumnType() {
		return UITypes::getDataType($this->uitype);
	}

	static function deleteForModule($moduleid) {
		global $adb;
		if($moduleid) {
			$adb->pquery("DELETE FROM vtiger_mc_field WHERE moduleid=? ORDER BY id ASC", Array($moduleid));
		}
	}

	static function __getAsList($result) {
		global $adb;
		$fields = Array();
		if($adb->num_rows($result)) {
			for($index = 0; $index < $adb->num_rows($result); ++$index) {
				$field = new Field();
				$field->initialize($adb->fetch_array($result, $index));
				$fields[] = $field;
			}
		}
		return $fields;		
	}

	static function getById($id) {
		global $adb;
		$result = $adb->pquery("SELECT * FROM vtiger_mc_field WHERE id=?", Array($id));
		$fields = self::__getAsList($result);
		if(!empty($fields)) return $fields[0];
		return false;
	}

	static function getAll($moduleid, $blockid=false) {
		global $adb;
		if($blockid) $result = $adb->pquery("SELECT * FROM vtiger_mc_field WHERE moduleid=? AND blockid=? ORDER BY id ASC", Array($moduleid, $blockid));
		else $result = $adb->pquery("SELECT * FROM vtiger_mc_field WHERE moduleid=? ORDER BY id ASC", Array($moduleid));
		return self::__getAsList($result);
	}
}

?>
