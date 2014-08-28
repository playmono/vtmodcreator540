{*+***********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.1
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 *************************************************************************************}

{include file="Header.tpl"}
{include file="MastHead.tpl"}

<p>Edit Module: {$MODULE->modulename}</p>

<div style="width: 60%">

<table width=100% cellpadding=0 cellspacing=0 border=0>
<tr>
	<td>
		<table width=100% cellpadding=3 cellspacing=0 border=0>
		<tr>
			<td style='width: 10px;'></td>
			<td class='dvtUnSelectedCell'><a href='index.php?action=EditModule&id={$MODULE->id}'>Basic</a></td>
			<td style='width: 10px;'></td>
			<td class='dvtUnSelectedCell'><a href='index.php?action=ListTable&moduleid={$MODULE->id}'>Table</a></td>
			<td style='width: 10px;'></td>
			<td class='dvtUnSelectedCell'><a href='index.php?action=ListBlock&moduleid={$MODULE->id}'>Block</a></td>
			<td style='width: 10px;'></td>
			<td class='dvtSelectedCell'>Field</td>
			<td style='width: 10px;'></td>
			<td class='dvtUnSelectedCell'><a href='index.php?action=ListFilter&moduleid={$MODULE->id}'>Filter</a></td>
			<td style='width: 10px;'></td>
			<td class='dvtUnSelectedCell'><a href='index.php?action=ListEvent&moduleid={$MODULE->id}'>Event</a></td>
			<td style='width: 10px;'></td>
		</tr>
		</table>
	</td>
</tr>

<tr>
	<td>
	<form method="POST" action="index.php">
		<input type="hidden" name="action" value="SaveField">
		<table width=100% cellpadding=3 cellspacing=0 border=0 class=tableHeading>
		<tr>
			<td class="big">New Field</td>
		</tr>
		</table>

		<table width=100% cellpadding=5 cellspacing=0 border=0>
		<tr>
			<td class="cellLabel" width='20%'><span class='required'>*</span>Name</td>
			<td class="cellText" width='30%'><input type='text' class='textBox' size=40 name='fieldname' value="{$FIELD->fieldname}" onblur="autofill_fldcreate_form(this.form)"></td>
			<td class="cellLabel" width='20%'><span class='required'>*</span>Table</td>
			<td class="cellText" width='30%'>
				<select name="tableid" class="small">
					{foreach item=TABLE from=$TABLES}
					<option value="{$TABLE->id}">{$TABLE->tablename}</option>
					{/foreach}
				</select>
			</td>
						
		</tr>
		<tr>	
			<td class="cellLabel" width='20%'><span class='required'>*</span>Block</td>
			<td class="cellText" width='30%'>
				<select name="blockid" class="small">
					{foreach item=BLOCK from=$BLOCKS}
					<option value="{$BLOCK->id}">{$BLOCK->trlabel}</option>
					{/foreach}
				</select>
			</td>
			<td class="cellLabel" width='20%'><span class='required'>*</span>Column</td>
			<td class="cellText" width='30%'>
				<input type='text' class='textBox' size=40 name='columnname' value="{$FIELD->trlabel}">
				<small>Should be smallcase</small>
			</td>
		</tr>
		<tr>
			<td class="cellLabel" width='20%'><span class='required'>*</span>Label</td>
			<td class="cellText" width='30%'><input type='text' class='textBox' size=40 name='label' value="{$FIELD->label}"></td>
			<td class="cellLabel" width='20%'><span class='required'>*</span>Translation</td>
			<td class="cellText" width='30%'><input type='text' class='textBox' size=40 name='trlabel' value="{$FIELD->trlabel}"></td>
		</tr>
		<tr>
			<td class="cellLabel" width='20%'><span class='required'>*</span>Type</td>
			<td class="cellText" width='30%'>
				<select name="uitype" class="small">
					{foreach item=UITYPE_KEY key=UITYPE_LBL from=$UITYPES}
					<option value="{$UITYPE_KEY}">{$UITYPE_LBL}</option>
					{/foreach}
				</select>
			</td>
			<td class="cellLabel" width='20%'>Show In</td>
			<td class="cellText" width='30%'>
				<select name="displaytype" class="small">
					<option value="1" {if $FIELD->displaytype eq 1}selected=true{/if}>Create, Edit, Detail</option>
					<option value="2" {if $FIELD->displaytype eq 2}selected=true{/if}>Only Detail</option>
					<option value="3" {if $FIELD->displaytype eq 3}selected=true{/if}>Hide In All</option>
					<option value="4" {if $FIELD->displaytype eq 4}selected=true{/if}>Password</option>
					<option value="5" {if $FIELD->displaytype eq 5}selected=true{/if}>Encrypted</option>
				</select> View
			</td>
		</tr>
		<tr>
			<td class="cellLabel" width='20%'>Entity Field?</td>
			<td class="cellText" width='30%'>
				<input type="checkbox" name="isentityfield" value="1" {if $FIELD->isentityfield eq 1}checked=true{/if}>
			</td>
			<td class="cellLabel" width='20%'>Is Mandatory?</td>
			<td class="cellText" width='30%'>
				<input type="checkbox" name="ismandatory" value="1" {if $FIELD->ismandatory eq 1}checked=true{/if}>
			</td>
		</tr>
		<tr>
			<td class="cellLabel" width='20%'>Information Type</td>
			<td class="cellText" width='30%'>
				<select name="infotype" class="small">
					<option value="BAS" {if $FIELD->infotype eq 'BAS'}selected=true{/if}>Basic</option>
					<option value="ADV" {if $FIELD->infotype eq 'ADV'}selected=true{/if}>Advanced</option>
				</select>
			</td>
			<td class="cellLabel" width='20%'>Mass Edit</td>
			<td class="cellText" width='30%'>
				<input type="text" name="masseditable" class='textBox' size=40 value="1">
				<br><small>0 - Never Allow, 1 - Allow, 2 - Disable</small>
			</td>
		</tr>
		<tr>
			<td class="cellLabel" width='20%'>Help Info</td>
			<td class="cellText" width='30%'>
				<textarea name="helpinfo" rows=1 cols=35 class="textBox">{$FIELD->helpinfo}</textarea>
			</td>
		</tr>
		<tr>
			<td colspan=4 align=center>
				<input type="hidden" name="id" value="{$FIELD->id}">
				<input type="hidden" name="moduleid" value="{$MODULE->id}">
				<input type="submit" class="save" value="Save">
				<input type="button" class="cancel" value="Cancel" onclick="location.href='index.php?action=ListField&moduleid={$MODULE->id}'">
			</td>
		</tr>
		</table>
	</form>
	</td>
</tr>
</table>
</div>

{include file="Footer.tpl"}
