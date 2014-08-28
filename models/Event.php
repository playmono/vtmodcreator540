<?php
/*+***********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.1
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 *************************************************************************************/
class Event {
	var $id;
	var $moduleid;
	var $eventname;
	var $classname;
	var $filename;
	var $cond;

	// List of all the class fields for easy initialization
	var $fields = Array('id', 'moduleid', 'eventname', 'classname', 'filename', 'cond');

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
			$useeventname = $otherInstance->eventname? $otherInstance->eventname : $this->eventname;
			$useclassname = $otherInstance->classname? $otherInstance->classname : $this->classname;
			$usefilename = $otherInstance->filename? $otherInstance->filename : $this->filename;
			$usecond = $otherInstance->cond;

			$adb->pquery(
				"UPDATE vtiger_mc_event SET moduleid=?, eventname=?, classname=?, filename=?, cond=? WHERE id=?",
				Array($usemoduleid, $useeventname, $useclassname, $usefilename, $usecond, $this->id));

		} else {
			$adb->pquery(
				"INSERT INTO vtiger_mc_event(moduleid,eventname,classname,filename,cond) VALUES(?,?,?,?,?)",
				Array($this->moduleid, $this->eventname, $this->classname, $this->filename, $this->cond)
			);
			$this->id = $adb->database->Insert_ID();
		}
	}

	function delete() {
		global $adb;
		if($this->id) {
			$adb->pquery("DELETE FROM vtiger_mc_event WHERE id=?", Array($this->id));
		}
	}

	function getFields() {
		return Field::getAll($this->moduleid, $this->id);
	}

	static function deleteForModule($moduleid) {
		global $adb;
		if($moduleid) {
			$adb->pquery("DELETE FROM vtiger_mc_event WHERE moduleid=?", Array($moduleid));
		}
	}

	static function __getAsList($result) {
		global $adb;
		$events = Array();
		if($adb->num_rows($result)) {
			for($index = 0; $index < $adb->num_rows($result); ++$index) {
				$event = new Event();
				$event->initialize($adb->fetch_array($result, $index));
				$events[] = $event;
			}
		}
		return $events;		
	}

	static function getById($id) {
		global $adb;
		$result = $adb->pquery("SELECT * FROM vtiger_mc_event WHERE id=?", Array($id));
		$events = self::__getAsList($result);
		if(!empty($events)) return $events[0];
		return false;
	}

	static function getAll($moduleid) {
		global $adb;
		$result = $adb->pquery("SELECT * FROM vtiger_mc_event WHERE moduleid=? ORDER BY id ASC", Array($moduleid));
		return self::__getAsList($result);
	}

}

?>
