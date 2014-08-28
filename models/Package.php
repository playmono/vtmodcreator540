<?php
/*+***********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.1
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 *************************************************************************************/
include_once('models/FileTemplate.php');
include_once('models/Module.php');
include_once('models/ZipCreator.php');

class Package {
	var $module = false;
	var $blocks = false;
	var $fields = false;
	var $tables = false;
	var $filters = false;
	var $events  = false;

	var $_tempdir = "temp";
	var $_baseexportdir = false;

	function __construct($module) {
		$this->module = $module;
	}

	function __getExportDir($moduledir=true) {
		if(!$this->_baseexportdir) {
			$this->_baseexportdir = $this->_tempdir. "/" . time();
		}
		$exportdir = $this->_baseexportdir;
		if($moduledir) {
			$exportdir = "$exportdir/modules";
			if(!is_dir($exportdir)) mkdir($exportdir);
			$exportdir = "$exportdir/". $this->module->modulename;
		}
		if(!is_dir($exportdir)) mkdir($exportdir);
		return $exportdir;
	}

	function export() {
		$module = $this->module;
		$this->blocks = $module->getBlocks();
		$this->fields = $module->getFields();
		$this->tables = $module->getTables();
		$this->filters = $module->getFilters();
		$this->events  = $module->getEvents();

		$this->createManifestFile();
		$this->createModuleFiles();
		
		$basedir = $this->__getExportDir(false);
		$zipfilename = "$basedir/$module->modulename";
		if($module->version) $zipfilename .= "-$module->version";
		$zipfilename .= ".zip";

		$zip = new ZipCreator($zipfilename);
		$zip->addFile("$basedir/manifest.xml", "manifest.xml");
		$zip->copyDirectoryFromDisk("$basedir/modules/$module->modulename", "modules/" . $module->modulename);
		$zip->save();
		
		$zip->forceDownload($zipfilename);
		unlink($zipfilename);
		$this->__rmdir($basedir);
	}

	function __lookupTable($tables, $id) {
		foreach($tables as $table) {
			if($table->id == $id) return $table;
		}
		return false;
	}

	function __writeToFile($file, $string, $tabcount=0, $eol="\r\n") {
		$tabprefix = '';
		for($index = 0; $index < $tabcount; ++$index) $tabprefix .= "\t";
		fwrite($file, $tabprefix.$string.$eol);
	}

	/**
	 * Remove directory recursively.
	 */
	function __rmdir($dirname) {
		$dir = opendir($dirname);
		while($file = readdir($dir)) {
			if($file != '.' && $file != '..') {
				$file = "$dirname/$file";
				if(is_dir($file)) {
					$this->__rmdir($file);
				} else if(is_file($file)) {
					unlink($file);
				}
			}
		}
		closedir($dir);
		rmdir($dirname);
	}
	
	function createManifestFile() {
		$exportdir = $this->__getExportDir(false);
		$manifestfile = fopen("$exportdir/manifest.xml", "w");

		$module = $this->module;

		$this->__writeToFile($manifestfile,'<?xml version="1.0"?>');
		$this->__writeToFile($manifestfile,'<module>');
		$this->__writeToFile($manifestfile,"<version>$module->version</version>",1);

		if($module->isextension) {
			$this->__writeToFile($manifestfile,'<type>extension</type>',1);
		}
		$this->__writeToFile($manifestfile,"<name>$module->modulename</name>",1);
		$this->__writeToFile($manifestfile,"<label>$module->label</label>",1);
		$this->__writeToFile($manifestfile,"<parent>$module->parent</parent>",1);
		$this->__writeToFile($manifestfile,"<dependencies>",1);
		$this->__writeToFile($manifestfile,"<vtiger_version>$module->forversion</vtiger_version>",2);
		$this->__writeToFile($manifestfile,"</dependencies>",1);
		$this->__writeToFile($manifestfile,'<exporttime>' . date('Y-m-d H:i:s') . '</exporttime>',1);

		if(!empty($module->licensetext)) {
			$this->__writeToFile($manifestfile, "<license>", 1);
			$this->__writeToFile($manifestfile, "<inline><![CDATA[$module->licensetext]]></inline>",2);
			$this->__writeToFile($manifestfile, "</license>", 1);
		}

		$basetable = false;
		$tables = $this->tables;
		if(!empty($tables)) {
			$this->__writeToFile($manifestfile,"<tables>",1);
			foreach($tables as $table) {
				// Core tables need not be exported
				if($table->isCoreTable()) continue;

				if($table->isBaseTable()) $basetable = $table;

				$this->__writeToFile($manifestfile,"<table>",2);
				$this->__writeToFile($manifestfile,"<name>$table->tablename</name>",3);
				$this->__writeToFile($manifestfile,"<sql><![CDATA[$table->sqlquery]]></sql>",3);
				$this->__writeToFile($manifestfile,"</table>",2);
			}
			$this->__writeToFile($manifestfile,"</tables>",1);
		}

		$blocks = $this->blocks;
		if(!empty($blocks)) {
			$this->__writeToFile($manifestfile,"<blocks>",1);
			foreach($blocks as $block) {
				$this->__writeToFile($manifestfile,"<block>",2);
				$this->__writeToFile($manifestfile,"<label>$block->label</label>",2);
				$fields = $block->getFields();
				if(!empty($fields)) {
					$this->__writeToFile($manifestfile,"<fields>",3);
					foreach($fields as $field) {
						$this->__writeToFile($manifestfile,"<field>",4);
						$this->__writeToFile($manifestfile,"<fieldname>$field->fieldname</fieldname>",5);
						$this->__writeToFile($manifestfile,"<uitype>$field->uitype</uitype>",5);
						$this->__writeToFile($manifestfile,"<columnname>$field->columnname</columnname>",5);
						$this->__writeToFile($manifestfile,"<tablename>". $this->__lookupTable($tables, $field->tableid)->tablename . "</tablename>",5);
						$this->__writeToFile($manifestfile,"<generatedtype>$field->generatedtype</generatedtype>",5);
						$this->__writeToFile($manifestfile,"<fieldlabel>$field->label</fieldlabel>",5);
						$this->__writeToFile($manifestfile,"<readonly>$field->readonly</readonly>",5);
						$this->__writeToFile($manifestfile,"<presence>$field->presence</presence>",5);
						$this->__writeToFile($manifestfile,"<selected>$field->selected</selected>",5);
						$this->__writeToFile($manifestfile,"<maximumlength>$field->maximumlength</maximumlength>",5);
						$this->__writeToFile($manifestfile,"<columntype>" . $field->getColumnType() . "</columntype>",5);
						$this->__writeToFile($manifestfile,"<typeofdata>" . $field->getTypeOfData() . "</typeofdata>",5);
						$this->__writeToFile($manifestfile,"<quickcreate>$field->quickcreate</quickcreate>",5);
						$this->__writeToFile($manifestfile,"<displaytype>$field->displaytype</displaytype>",5);
						$this->__writeToFile($manifestfile,"<info_type>$field->infotype</info_type>",5);			
						$this->__writeToFile($manifestfile,"<helpinfo><![CDATA[$field->helpinfo]]></helpinfo>",5);		
						$this->__writeToFile($manifestfile,"<masseditable>$field->masseditable</masseditable>",5);			
						if($field->isentityfield) {
							$this->__writeToFile($manifestfile,"<entityidentifier>",5);
							$this->__writeToFile($manifestfile,"<entityidfield>$basetable->refcolumn</entityidfield>",6);
							$this->__writeToFile($manifestfile,"<entityidcolumn>$basetable->refcolumn</entityidcolumn>",6);
							$this->__writeToFile($manifestfile,"</entityidentifier>",5);
						}
						if(UITypes::isPicklist($field->uitype)) {
							$this->__writeToFile($manifestfile,"<picklistvalues>",5);
							$this->__writeToFile($manifestfile,"<picklistvalue>None</picklistvalue>",6);
							$this->__writeToFile($manifestfile,"</picklistvalues>",5);
						}
						$this->__writeToFile($manifestfile,"</field>",4);
					}
					$this->__writeToFile($manifestfile,"</fields>",3);
				}
				$this->__writeToFile($manifestfile,"</block>",2);
			}
			$this->__writeToFile($manifestfile,"</blocks>",1);
		}

		$filters = $this->filters;
		if(!empty($filters)) {
			$this->__writeToFile($manifestfile,"<customviews>",1);

			foreach($filters as $filter) {
				$filterfields = $filter->getFields();
				$filterfieldseq = 0;

				if($filterfields) {
					$this->__writeToFile($manifestfile,"<customview>",2);
					$this->__writeToFile($manifestfile,"<viewname>$filter->filtername</viewname>",3);
					$this->__writeToFile($manifestfile,"<setdefault>$filter->setdefault</setdefault>",3);
					$this->__writeToFile($manifestfile,"<setmetrics>$filter->setmetrics</setmetrics>",3);
					$this->__writeToFile($manifestfile,"<fields>",3);	
					foreach($filterfields as $filterfield) {
						$this->__writeToFile($manifestfile,"<field>",4);
						$this->__writeToFile($manifestfile,"<fieldname>$filterfield->fieldname</fieldname>",5);
						$this->__writeToFile($manifestfile,"<columnindex>$filterfieldseq</columnindex>",5);
						$this->__writeToFile($manifestfile,"</field>",4);
						++$filterfieldseq;
					}
					$this->__writeToFile($manifestfile,"</fields>",3);
					$this->__writeToFile($manifestfile,"</customview>",2);
				}
			}
			$this->__writeToFile($manifestfile,"</customviews>",1);
		}

		$events = $this->events;
		if(!empty($events)) {
			$this->__writeToFile($manifestfile,"<events>",1);

			foreach($events as $event) {
				$this->__writeToFile($manifestfile,"<event>",2);
				$this->__writeToFile($manifestfile,"<eventname>$event->eventname</eventname>",3);
				$this->__writeToFile($manifestfile,"<classname>$event->classname</classname>",3);
				$this->__writeToFile($manifestfile,"<filename>$event->filename</filename>",3);
				$this->__writeToFile($manifestfile,"<cond><![CDATA[$event->cond]]></cond>",3);
				$this->__writeToFile($manifestfile,"</event>",2);
			}
			$this->__writeToFile($manifestfile,"</events>",1);
		}

		$this->__writeToFile($manifestfile,'</module>');
		fclose($manifestfile);
	}

	function createModuleFiles() {
		$ftemplate = new FileTemplate();

		$module = $this->module;
		$modulename = $module->modulename;
		$blocks = $this->blocks;
		$tables = $this->tables;
		$fields = $this->fields;
		$basetable = $customtalbe = $grouptable = false;
		foreach($tables as $table) {
			if($table->isBaseTable()) $basetable = $table;
			else if($table->isCustomTable()) $customtable = $table;
			else if($table->isGroupTable()) $grouptable = $table;
		}

		$entityfield = false;
		$mandatoryfield = false;
		foreach($fields as $field) {
			if(!$entityfield && $field->isentityfield) {
				$entityfield = $field;
			}
			if(!$mandatoryfield && $field->ismandatory) {
				$mandatoryfield = $field;
			}
		}
		if(!$mandatoryfield) $mandatoryfield = $entityfield;

		$ftemplate->assign('MODULENAME', $modulename);
		$ftemplate->assign('LICENSETEXT', $module->getLicenseText());

		if($basetable) {
			$ftemplate->assign('TABLENAME', $basetable->tablename);
			$ftemplate->assign('TABLEINDEX', $basetable->refcolumn);
		}
		if($grouptable) {
			$ftemplate->assign('GROUP_TABLENAME', $grouptable->tablename);
			$ftemplate->assign('GROUP_TABLEINDEX', $grouptable->refcolumn);
		}
		if($customtable) {
			$ftemplate->assign('CUSTOM_TABLENAME', $customtable->tablename);
			$ftemplate->assign('CUSTOM_TABLEINDEX', $customtable->refcolumn);
		}

		if($entityfield) {
			$entityfield_table = $this->__lookupTable($tables, $entityfield->tableid);
			$ftemplate->assign('ENTITY_FIELDNAME', $entityfield->fieldname);
			$ftemplate->assign('ENTITY_FIELDLABEL', $entityfield->trlabel); // Check if actual label needs to used?
			$ftemplate->assign('ENTITY_FIELDCOLUMN', $entityfield->columnname);
			$ftemplate->assign('ENTITY_FIELDTABLE',$entityfield_table->trimPrefix('vtiger_'));
			$ftemplate->assign('ENTITY_FIELDTABLEINDEX',$entityfield_table->refcolumn);
		}
		if($mandatoryfield) {
			$ftemplate->assign('MANDATORY_FIELDNAME', $mandatoryfield->fieldname);
		}

		$exportdir = $this->__getExportDir();

		$useskeletondir = ($this->module->isextension)? 'skeleton/extension' : ('skeleton/entity/'.$this->module->forversion);

		$ftemplate->merge("$useskeletondir/ModuleDir/Module.php.tpl", "$exportdir/$modulename.php");
		$ftemplate->clear(Array('MODULENAME', 'LICENSETEXT'));

		$ftemplate->merge("$useskeletondir/ModuleDir/Module.js.tpl",  "$exportdir/$modulename.js");
		$ftemplate->merge("$useskeletondir/ModuleDir/ModuleAjax.php.tpl", "$exportdir/$modulename"."Ajax.php");
		$ftemplate->merge("$useskeletondir/ModuleDir/ModuleHandler.php.tpl", "$exportdir/$modulename"."Handler.php");
		
		// Build language strings
		$langstrings = Array( $module->modulename => $module->label );
		foreach($blocks as $block) $langstrings[$block->label] = $block->trlabel;
		foreach($fields as $field) $langstrings[$field->label] = $field->trlabel;

		$ftemplate->assign('@MODSTRINGS', $langstrings);
	
		if(!is_dir("$exportdir/language")) mkdir("$exportdir/language");
		$ftemplate->merge("$useskeletondir/ModuleDir/language/en_us.lang.php.tpl", "$exportdir/language/en_us.lang.php");
		$ftemplate->clear(Array('MODULENAME', 'LICENSETEXT'));

		$verbatimcopy = Array('CallRelatedList.php.tpl', 'CustomView.php.tpl', 'Delete.php.tpl',
			'DetailView.php.tpl', 'DetailViewAjax.php.tpl', 'EditView.php.tpl', 'ExportRecords.php.tpl',
			'FindDuplicateRecords.php.tpl', 'Import.php.tpl', 'index.php.tpl', 'ListView.php.tpl', 
			'ProcessDuplicates.php.tpl', 'Popup.php.tpl', 'Save.php.tpl', 'Settings.php.tpl', 'TagCloud.php.tpl', 
			'MassEdit.php.tpl', 'MassEditSave.php.tpl', 'QuickCreate.php.tpl', 'updateRelations.php.tpl'
		);

		foreach($verbatimcopy as $tplfile) {
			$targetfile = substr($tplfile, 0, strpos($tplfile, '.tpl'));
			$ftemplate->merge("$useskeletondir/ModuleDir/$tplfile", "$exportdir/$targetfile");
		}
	}
}
?>
