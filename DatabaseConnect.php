<?php
/*+***********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.1
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 *************************************************************************************/
class DatabaseConnect {
	var $dieOnError = true;
	var $database;

	function __construct($config) {
		$this->database = ADONewConnection('mysql');
		$this->database->PConnect(
			$config['hostname'], $config['username'],
			$config['password'], $config['database']);
	}

	function query($sql) {
		$result = $this->database->Execute($sql);
		if(!$result && $this->dieOnError) die($this->database->ErrorMsg());
		return $result;
	}

	function pquery($sql, $params) {
		$result = $this->database->Execute($sql, $params);
		if(!$result && $this->dieOnError) die($this->database->ErrorMsg());
		return $result;		
	}

	function query_result($result, $row, $column) {
		$rowdata = $this->fetch_array($result, $row);
		return $rowdata? $rowdata[$column] : false;
	}

	function fetch_array($result, $row=0) {
		$result->Move($row);
		if($result->EOF) return false;
		$rowdata = $result->FetchRow();
		return $rowdata;
	}

	function num_rows($result) {
		if($result) return $result->RecordCount();
		return false;
	}

	function __destruct() {
		$this->database->disconnect();
		unset($this->database);
	}
}

?>
