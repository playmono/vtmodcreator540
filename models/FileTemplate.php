<?php
/*+***********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.1
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 *************************************************************************************/

/**
 * FileTemplate will enable you to replace a merge fields defined in the file
 * with values set dynamically.
 *
 * @author Prasad
 */
class FileTemplate {
	// Template variables set dynamically
	var $tplvars = Array();

	/**
	 * Identify variable with the following pattern
	 * #VARIABLE_KEY#
	 */
	var $_lookfor = "/#([^#]+)#/";

	/**
	 * Constructor
	 */
	function __construct() {
	}

	/**
	 * Assign replacement value for the variable.
	 */
	function assign($key, $value) {
		$this->tplvars[$key] = $value;
	}	

	/**
	 * Get replacement value for the variable.
	 */
	function get($key) {
		$value = false;
		if(isset($this->tplvars[$key])) {
			$value = $this->tplvars[$key];

			if(strpos($key, '@') === 0 && is_array($value)) {
				$valuestr = '';
				foreach($value as $usekey=>$useval) {
					$valuestr .= "'$usekey' => '".preg_replace("/\'/", "\\'", $useval)."'";
					$valuestr .= ",\r\n";
				}
				$value = $valuestr;
			}
		}
		return $value;
	}

	/**
	 * Clear all the assigned variable values.
	 * (except the once in the given list)
	 */
	function clear($exceptvars=false) {
		$restorevars = Array();
		if($exceptvars) {
			foreach($exceptvars as $varkey) {
				$restorevars[$varkey] = $this->get($varkey);
			}
		}		
		unset($this->tplvars);

		$this->tplvars = Array();
		foreach($restorevars as $key=>$val) $this->assign($key, $val);
	}

	/**
	 * Format end-of-line character.
	 */
	function formateol($contents, $eol="\n") {
		return preg_replace("/\\r\\n/", $eol, $contents);
	}

	/**
	 * Merge the given file with variable values assigned.
	 * @param $infile input file template
	 * @param $outfile output file to write [optional]
	 * @param $avoidLookup should be true if only verbatim file copy needs to be done
	 * @returns merged input file contents
	 */
	function merge($infile, $outfile=false, $avoidLookup=false) {
		if(!file_exists($infile)) return;

		$filecontents = file_get_contents($infile);

		if(!$avoidLookup) {
			/** Look for variables */
			$matches = Array();
			preg_match_all($this->_lookfor, $filecontents, $matches);

			/** Replace variables found with value assigned. */
			$matchcount = count($matches[1]);
			for($index = 0; $index < $matchcount; ++$index) {
				$matchstr = $matches[0][$index];
				$matchkey = $matches[1][$index];

				$replacewith = $this->get($matchkey);
				if($replacewith) {
					$filecontents = preg_replace(
						"/$matchstr/", $replacewith, $filecontents);
				}
			}
		}
		/** Format End-of-line **/
		$filecontents = $this->formateol($filecontents);

		/** Write contents to output file. */
		if($outfile) {
			file_put_contents($outfile, $filecontents);
		}
		return $filecontents;
	}
}
?>
