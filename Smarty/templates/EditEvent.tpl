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
			<td class='dvtUnSelectedCell'><a href='index.php?action=ListField&moduleid={$MODULE->id}'>Block</a></td>
			<td style='width: 10px;'></td>
			<td class='dvtUnSelectedCell'><a href='index.php?action=ListField&moduleid={$MODULE->id}'>Field</a></td>
			<td style='width: 10px;'></td>
			<td class='dvtUnSelectedCell'><a href='index.php?action=ListField&moduleid={$MODULE->id}'>Filter</a></td>
			<td style='width: 10px;'></td>
			<td class='dvtSelectedCell'>Event</td>
			<td style='width: 10px;'></td>
		</tr>
		</table>
	</td>
</tr>

<tr>
	<td>
	<form method="POST" action="index.php">
		<input type="hidden" name="action" value="SaveEvent">
		<table width=100% cellpadding=3 cellspacing=0 border=0 class=tableHeading>
		<tr>
			<td class="big">Edit Event</td>
		</tr>
		</table>

		<table width=100% cellpadding=5 cellspacing=0 border=0>
		<tr>
			<td class="cellLabel" width='20%'><span class='required'>*</span>Event Name</td>
			<td class="cellText" width='30%'>
				<select name="eventname" class="small">
					<option value="vtiger.entity.aftersave" {if $EVENT->eventname eq 'vtiger.entity.aftersave'}selected=true{/if}>After Save</option>
					<option value="vtiger.entity.beforesave"{if $EVENT->eventname eq 'vtiger.entity.beforesave'}selected=true{/if}>Before Save</option>
				</select>
			</td>
			<td class="cellLabel" width='20%'><span class='required'>*</span>Class</td>
			<td class="cellText" width='30%'><input type='text' class='textBox' size=40 name='classname' value="{$EVENT->classname}" readonly></td>
		</tr>
		<tr>
			<td class="cellLabel" width='20%'><span class='required'>*</span>File</td>
			<td class="cellText" width='80%' colspan=3>
				<input type='text' class='textBox' size=60 name='filename' value="{$EVENT->filename}" readonly>
				<small>Class definition should be present in this.</small>
			</td>
		</tr>
		<tr>
			<td class="cellLabel" width='20%'><span class='required'>*</span>Condition</td>
			<td class="cellText" width='80%' colspan=3>
				<small>Trigger event based on condition, Blank only when you want the trigger for all modules!</small><br>
				<textarea name="cond" class="small" rows=5 cols=80>{$EVENT->cond}</textarea>
			</td>
		</tr>
		<tr>
			<td colspan=4 align=center>
				<input type="hidden" name="id" value="{$EVENT->id}">
				<input type="hidden" name="moduleid" value="{$MODULE->id}">
				<input type="submit" class="save" value="Save">
				<input type="button" class="cancel" value="Cancel" onclick="location.href='index.php?action=ListEvent&moduleid={$MODULE->id}'">
			</td>
		</tr>
		</table>
	</form>
	</td>
</tr>
</table>
</div>

{include file="Footer.tpl"}
