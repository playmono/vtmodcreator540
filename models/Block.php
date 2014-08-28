<?php
/*+***********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.1
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 *************************************************************************************/
include_once('models/Field.php');

class Block {
	var $id;
	var $moduleid;
	var $label;
	var $trlabel;

	// List of all the class fields for easy initialization
	var $fields = Array('id', 'moduleid', 'label', 'trlabel');

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
			$usemoduleid = $otherInstance->moduleid? $otherInstance->moduleid : $this->moduleid;
			$uselabel = $otherInstance->label? $otherInstance->label : $this->label;
			$usetrlabel = $otherInstance->trlabel? $otherInstance->trlabel : $this->trlabel;

			$adb->pquery(
				"UPDATE vtiger_mc_block SET moduleid=?, label=?, trlabel=? WHERE id=?",
				Array($usemoduleid, $uselabel, $usetrlabel, $this->id));

		} else {
			$adb->pquery(
				"INSERT INTO vtiger_mc_block(moduleid,label,trlabel) VALUES(?,?,?)",
				Array($this->moduleid, $this->label, $this->trlabel)
			);
			$this->id = $adb->database->Insert_ID();
		}
	}

	function delete() {
		global $adb;
		if($this->id) {
			$adb->pquery("DELETE FROM vtiger_mc_block WHERE id=?", Array($this->id));
		}
	}

	function getFields() {
		return Field::getAll($this->moduleid, $this->id);
	}

	static function deleteForModule($moduleid) {
		global $adb;
		if($moduleid) {
			$adb->pquery("DELETE FROM vtiger_mc_block WHERE moduleid=?", Array($moduleid));
		}
	}

	static function __getAsList($result) {
		global $adb;
		$blocks = Array();
		if($adb->num_rows($result)) {
			for($index = 0; $index < $adb->num_rows($result); ++$index) {
				$block = new Block();
				$block->initialize($adb->fetch_array($result, $index));
				$blocks[] = $block;
			}
		}
		return $blocks;		
	}

	static function getById($id) {
		global $adb;
		$result = $adb->pquery("SELECT * FROM vtiger_mc_block WHERE id=?", Array($id));
		$blocks = self::__getAsList($result);
		if(!empty($blocks)) return $blocks[0];
		return false;
	}

	static function getAll($moduleid) {
		global $adb;
		$result = $adb->pquery("SELECT * FROM vtiger_mc_block WHERE moduleid=? ORDER BY id ASC", Array($moduleid));
		return self::__getAsList($result);
	}

}

?>
