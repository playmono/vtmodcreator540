<?php
/*+***********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.1
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 *************************************************************************************/
class Table {
	var $id;
	var $moduleid;
	var $tablename;
	var $tabletype;
	var $refcolumn;
	var $sqlquery;

	// List of all the class fields for easy initialization
	var $fields = Array('id', 'moduleid', 'tablename', 'tabletype', 'refcolumn', 'sqlquery');

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
			// TODO
			$usemoduleid = $otherInstance->moduleid? $otherInstance->moduleid : $this->moduleid;
			$usetablename= $otherInstance->tablename?$otherInstance->tablename: $this->tablename;
			$usetabletype=$otherInstance->tabletype? $otherInstance->tabletype : $this->tabletype;
			$userefcolumn=$otherInstance->refcolumn? $otherInstance->refcolumn : $this->refcolumn;
			$usesqlquery = $otherInstance->sqlquery? $otherInstance->sqlquery : $this->sqlquery;

			$adb->pquery(
				"UPDATE vtiger_mc_table SET moduleid=?, tablename=?, tabletype=?, refcolumn=?, sqlquery=? WHERE id=?",
				Array($usemoduleid, $usetablename, $usetabletype, $userefcolumn, $usesqlquery, $this->id));

		} else {
			$adb->pquery(
				"INSERT INTO vtiger_mc_table(moduleid,tablename,tabletype,refcolumn,sqlquery) VALUES(?,?,?,?,?)",
				Array($this->moduleid, $this->tablename, $this->tabletype, $this->refcolumn, $this->sqlquery)
			);
			$this->id = $adb->database->Insert_ID();
		}
	}

	function delete() {
		global $adb;
		if($this->id) {
			$adb->pquery("DELETE FROM vtiger_mc_table WHERE id=?", Array($this->id));
		}
	}

	function isBaseTable() {
		return ($this->tabletype == 'BASE');
	}
	function isCustomTable() {
		return ($this->tabletype == 'CUSTOM');
	}
	function isGroupTable() {
		return ($this->tabletype == 'GROUP');
	}
	function isCoreTable() {
		return ($this->tabletype == 'CORE');
	}
	function isOtherTable() {
		return (strtoupper($this->tabletype) == 'OTHER');
	}

	function trimPrefix($prefix) {
		$tablename = $this->tablename;
		if($tablename && strpos($tablename, $prefix) === 0) {
			$tablename = substr($tablename, strlen($prefix));
		}
		return $tablename;
	}

	static function deleteForModule($moduleid) {
		global $adb;
		if($moduleid) {
			$adb->pquery("DELETE FROM vtiger_mc_table WHERE moduleid=?", Array($moduleid));
		}
	}

	static function __getAsList($result) {
		global $adb;
		$tables = Array();
		if($adb->num_rows($result)) {
			for($index = 0; $index < $adb->num_rows($result); ++$index) {
				$table = new Table();
				$table->initialize($adb->fetch_array($result, $index));
				$tables[] = $table;
			}
		}
		return $tables;		
	}

	static function getById($id) {
		global $adb;
		$result = $adb->pquery("SELECT * FROM vtiger_mc_table WHERE id=?", Array($id));
		$tables = self::__getAsList($result);
		if(!empty($tables)) return $tables[0];
		return false;
	}

	static function getAll($moduleid) {
		global $adb;
		$result = $adb->pquery("SELECT * FROM vtiger_mc_table WHERE moduleid=? ORDER BY id ASC", Array($moduleid));
		return self::__getAsList($result);
	}

}

?>
