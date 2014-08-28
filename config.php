<?php
/*+***********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.1
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 *************************************************************************************/
include_once('adodb/adodb.inc.php');
include_once('DatabaseConnect.php');

$CONFIG = Array();
$CONFIG['hostname'] = 'localhost:3306';
$CONFIG['database'] = 'DBNAME';
$CONFIG['username'] = 'DBUSER';
$CONFIG['password'] = 'DBPWD';

$adb = new DatabaseConnect($CONFIG);
?>
