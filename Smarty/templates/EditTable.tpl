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
			<td class='dvtSelectedCell'>Table</td>
			<td style='width: 10px;'></td>
			<td class='dvtUnSelectedCell'><a href='index.php?action=ListBlock&moduleid={$MODULE->id}'>Block</a></td>
			<td style='width: 10px;'></td>
			<td class='dvtUnSelectedCell'><a href='index.php?action=ListField&moduleid={$MODULE->id}'>Field</a></td>
			<td style='width: 10px;'></td>
			<td class='dvtUnSelectedCell'><a href='index.php?action=ListFilter&moduleid={$MODULE->id}'>Filter</a></td>
			<td style='width: 10px;'></td>
			{if $MODULE->forversion eq '5.1.0'}
			<td class='dvtUnSelectedCell'><a href='index.php?action=ListEvent&moduleid={$MODULE->id}'>Event</a></td>
			<td style='width: 10px;'></td>
			{/if}
		</tr>
		</table>
	</td>
</tr>

<tr>
	<td>
	<form method="POST" action="index.php">
		<input type="hidden" name="action" value="SaveTable">
		<table width=100% cellpadding=3 cellspacing=0 border=0 class=tableHeading>
		<tr>
			<td class="big">Edit Table</td>
		</tr>
		</table>

		<table width=100% cellpadding=5 cellspacing=0 border=0>
		<tr>
			<td class="cellLabel" width='20%'><span class='required'>*</span>Type</td>
			<td class="cellText" width='80%' colspan=3>
				<input type="text" class="small" name="tabletype" value="{$TABLE->tabletype}" readonly>
				<!--select name="tabletype" class="small">
					<option value="">Other</option>
					<option value="BASE">Base</option>
					<option value="GROUP">Group</option>
					<option value="CUSTOM">Custom</option>
				</select-->
			</td>
		</tr>
		<tr>
			<td class="cellLabel" width='20%'><span class='required'>*</span>Tablename</td>
			<td class="cellText" width='30%'><input type='text' class='textBox' size=40 name='tablename' value="{$TABLE->tablename}" onblur="autofill_tbcreate_form(this.form)"></td>

			<td class="cellLabel" width='20%'><span class='required'>*</span>Column</td>
			<td class="cellText" width='30%'><input type='text' class='textBox' size=40 name='refcolumn' value="{$TABLE->refcolumn}" onblur="autofill_tbcreate_form(this.form)"></td>
		</tr>
		
		<tr valign=top>
			<td class="cellLabel" width='20%'><span class='required'>*</span>SQL Query</td>
			<td class="cellText" width='80%' colspan=3>
				<textarea class='textBox' name='sqlquery' rows=5 cols=80>{$TABLE->sqlquery}</textarea></td>
		</tr>
		<tr>
			<td colspan=4 align=center>
				<input type="hidden" name="id" value="{$TABLE->id}">
				<input type="hidden" name="moduleid" value="{$MODULE->id}">
				<input type="submit" class="save" value="Save">
				<input type="button" class="cancel" value="Cancel" onclick="location.href='index.php?action=ListTable&moduleid={$MODULE->id}'">
			</td>
		</tr>
		</table>
	</form>
	</td>
</tr>
</table>
</div>

{include file="Footer.tpl"}
