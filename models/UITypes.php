<?php
/*+***********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.1
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 *************************************************************************************/
class UITypes {
	static function translate($uitype) {
		$uimap = self::getAsMap();
		$uimap = array_flip($uimap);
		return $uimap[$uitype];
	}

	static function getAsMap() {
		$uimap = Array(
			'Textbox'      => '1',
			'*Textbox'     => '2',
			'NonEditable Text'=>'3',
			'Auto Numbering'=>'4',
			'Date'         => '5',
			'Time & Date'  => '6',
			'Numeric'      => '7',
			'Percentage'   => '8',
			'Link Module'  => '10',
			'Text (novalidation)'=>'11',
			'Email Address'=>'13',
			'Picklist'     =>'15',
			'Assigned To'  =>'53',
			'Entity Time'  =>'70',
		);
		return $uimap;
	}

	static function getDataType($uitype, $sqltype=true) {
		$datatypemap = Array(
			'1' => Array( 'notation' => 'V', 'sqltype' => 'VARCHAR(100)' ),
			'2' => Array( 'notation' => 'V', 'sqltype' => 'VARCHAR(100)' ),
			'3' => Array( 'notation' => 'V', 'sqltype' => 'VARCHAR(100)' ),
			'4' => Array( 'notation' => 'V', 'sqltype' => 'VARCHAR(100)' ),
			'10'=> Array( 'notation' => 'V', 'sqltype' => 'INTEGER' ),
			'53'=> Array( 'notation' => 'V', 'sqltype' => ''), // Column exists in vtiger_crmentity
			'70'=> Array( 'notation' => 'T', 'sqltype' => ''), // Column exists in vtiger_crmentity
		);
		$datatypeinfo = $datatypemap[$uitype];
		if(!$datatypeinfo) {
			$datatypeinfo = Array('notation'=>'V','sqltype'=>'VARCHAR(100)'); 
		}
		if($sqltype) return $datatypeinfo[sqltype];
		else return $datatypeinfo[notation];
	}

	static function isPicklist($uitype) {
		if($uitype == '15' || $uitype == '111') return true;
		return false;
	}
}
?>
