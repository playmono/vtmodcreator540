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

class Filter {
	var $id;
	var $moduleid;
	var $filtername;

	var $setdefault = 'false';
	var $setmetrics = 'false';

	// List of all the class fields for easy initialization
	var $fields = Array('id', 'moduleid', 'filtername');

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
			$usefiltername = $otherInstance->filtername? $otherInstance->filtername : $this->filtername;

			$adb->pquery(
				"UPDATE vtiger_mc_filter SET moduleid=?, filtername=? WHERE id=?",
				Array($usemoduleid, $usefiltername, $this->id));

		} else {
			$adb->pquery(
				"INSERT INTO vtiger_mc_filter(moduleid,filtername) VALUES(?,?)",
				Array($this->moduleid, $this->filtername)
			);
			$this->id = $adb->database->Insert_ID();
		}
	}

	function delete() {
		global $adb;
		if($this->id) {
			$adb->pquery("DELETE FROM vtiger_mc_filter WHERE id=?", Array($this->id));
		}
	}

	function getFieldIds() {
		global $adb;
		$ids = Array();
		if($this->id) {
			$result = $adb->pquery("SELECT fieldid FROM vtiger_mc_filterfieldrel WHERE filterid=? ORDER BY fieldid ASC", Array($this->id));
			$rowcount = $adb->num_rows($result);
			if($rowcount) {
				for($index = 0; $index < $rowcount; ++$index) {
					$ids[] = $adb->query_result($result, $index, 'fieldid');
				}
			}
		}
		return $ids;
	}

	function getFields() {
		global $adb;
		$ids = $this->getFieldIds();
		$fields = false;
		if($ids) {
			$fields = Array();
			foreach($ids as $fieldid) {
				$fields[] = Field::getById($fieldid);
			}			
		}
		return $fields;
	}

	function updateFields($fieldids) {
		global $adb;
		if($this->id) {
			$adb->pquery("DELETE FROM vtiger_mc_filterfieldrel WHERE filterid=?", Array($this->id));
			foreach($fieldids as $fieldid) {
				$adb->pquery("INSERT INTO vtiger_mc_filterfieldrel(filterid, fieldid) VALUES(?,?)", Array($this->id, $fieldid));
			}
		}
	}

	static function deleteForModule($moduleid) {
		global $adb;
		if($moduleid) {
			$adb->pquery("DELETE FROM vtiger_mc_filter WHERE moduleid=?", Array($moduleid));
		}
	}

	static function __getAsList($result) {
		global $adb;
		$filters = Array();
		if($adb->num_rows($result)) {
			for($index = 0; $index < $adb->num_rows($result); ++$index) {
				$filter = new Filter();
				$filter->initialize($adb->fetch_array($result, $index));
				$filters[] = $filter;
			}
		}
		return $filters;		
	}

	static function getById($id) {
		global $adb;
		$result = $adb->pquery("SELECT * FROM vtiger_mc_filter WHERE id=?", Array($id));
		$filters = self::__getAsList($result);
		if(!empty($filters)) return $filters[0];
		return false;
	}

	static function getAll($moduleid) {
		global $adb;
		$result = $adb->pquery("SELECT * FROM vtiger_mc_filter WHERE moduleid=? ORDER BY id ASC", Array($moduleid));
		return self::__getAsList($result);
	}
}

?>
