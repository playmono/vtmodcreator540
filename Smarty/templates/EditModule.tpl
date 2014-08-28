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
			<td class='dvtSelectedCell'>Basic</td>
			<td style='width: 10px;'></td>
			<td class='dvtUnSelectedCell'><a href='index.php?action=ListTable&moduleid={$MODULE->id}'>Table</a></td>
			<td style='width: 10px;'></td>
			<td class='dvtUnSelectedCell'><a href='index.php?action=ListBlock&moduleid={$MODULE->id}'>Block</a></td>
			<td style='width: 10px;'></td>
			<td class='dvtUnSelectedCell'><a href='index.php?action=ListField&moduleid={$MODULE->id}'>Field</a></td>
			<td style='width: 10px;'></td>
			<td class='dvtUnSelectedCell'><a href='index.php?action=ListFilter&moduleid={$MODULE->id}'>Filter</a></td>
			<td style='width: 10px;'></td>
			<td class='dvtUnSelectedCell'><a href='index.php?action=ListEvent&moduleid={$MODULE->id}'>Event</a></td>
			<td style='width: 10px;'></td>
			</td>
		</tr>
		</table>
	</td>
</tr>

<tr>
	<td>
	<form method="POST" action="index.php">
		<input type="hidden" name="action" value="SaveModule">
		<table width=100% cellpadding=3 cellspacing=0 border=0 class=tableHeading>
		<tr>
			<td class="big">Edit Module</td>
		</tr>
		</table>

		<table width=100% cellpadding=5 cellspacing=0 border=0>
		<tr>
			<td class="cellLabel" width='20%'><span class='required'>*</span>Module Name</td>
			<td class="cellText" width='30%'><input type='text' class='textBox' size=40 name='modulename' value="{$MODULE->modulename}" onblur="autofill_modcreate_form(this.form);"></td>
			<td class="cellLabel" width='20%'><span class='required'>*</span>Display Label</td>
			<td class="cellText" width='30%'><input type='text' class='textBox' size=40 name='label' value="{$MODULE->label}" onblur="autofill_modcreate_form(this.form);"></td>
		</tr>
		<tr>
			<td class="cellLabel" width='20%'>Add Under</td>
			<td class="cellText" width='30%'>
				<select class='small' name='parent'>
					<option value='My Home Page' {if $MODULE->parent eq 'My Home Page'}selected=true{/if}>My Home Page</option>
					<option value='Marketing'    {if $MODULE->parent eq 'Marketing'}selected=true{/if}>Marketing</option>
					<option value='Sales'        {if $MODULE->parent eq 'Sales'}selected=true{/if}>Sales</option>
					<option value='Support'      {if $MODULE->parent eq 'Support'}selected=true{/if}>Support</option>
					<option value='Tools'        {if $MODULE->parent eq 'Tools'}selected=true{/if}>Tools</option>
					<option value='Inventory'    {if $MODULE->parent eq 'Inventory'}selected=true{/if}>Inventory</option>
					<option value=''    {if $MODULE->parent eq ''}selected=true{/if}>-- Not Under Menu --</option>
				</select>
			</td>
			<td class="cellLabel" width='20%'>For Version</td>
			<td class="cellText" width='30%'>
			{literal}
			<select class='small' name='forversion'>{/literal}
					<option value='5.4.0' selected=true>5.4.0</option>
				</select>
			</td>
		</tr>		
		<tr>
			<td class="cellLabel" width='20%'>Version</td>
			<td class="cellText" width='30%'><input type='text' class='textBox' size=40 name='version' value="{$MODULE->version}"></td>

			<td class="cellLabel" width='20%'>Is Extension Module?</td>
			<td class="cellText" width='80%' colspan=3>
				<input type='checkbox' name='isextension' value='1' {if $MODULE->isextension}checked=true{/if}>
				{literal}<small>Select if CRM Record is not created</small>{/literal}
			</td>
		</tr>
		<tr valign=top>
		<td class="cellLabel" width='20%'>License Text</td>
			<td class="cellText" width='80%' colspan=3>
				<textarea name="licensetext" class="small" rows=5 cols=80>{$MODULE->licensetext}</textarea>
			</td>
		</tr>
		<tr>
			<td colspan=4 align=center>
				<input type="hidden" name="id" value="{$MODULE->id}">
				<input type="submit" class="save" value="Save">
				<input type="button" class="cancel" value="Cancel" onclick="location.href='index.php'">
			</td>
		</tr>
		</table>
	</form>
	</td>
</tr>
</table>

</div>

{include file="Footer.tpl"}
