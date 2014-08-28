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

<p>Create new module for vtiger CRM</p>

<div style="width: 60%">

<form method="POST" action="index.php">
	<input type="hidden" name="action" value="SaveModule">
	<table width=100% cellpadding=3 cellspacing=0 border=0 class=tableHeading>
	<tr>
		<td class="big">New Module</td>
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
				<option value='My Home Page'>My Home Page</option>
				<option value='Marketing'>Marketing</option>
				<option value='Sales'>Sales</option>
				<option value='Support'>Support</option>
				<option value='Tools' selected=true>Tools</option>
				<option value='Inventory'>Inventory</option>
				<option value=''>-- Not Under Menu --</option>
			</select>
		</td>
		<td class="cellLabel" width='20%'>For Version</td>
		<td class="cellText" width='30%'>
			{literal}
			<select class='small' name='forversion'>{/literal}
				<option value='5.4.0'>5.4.0</option>
			</select>
		</td>
	</tr>
	<tr>
		<td class="cellLabel" width='20%'>Version</td>
		<td class="cellText" width='30%'><input type='text' class='textBox' size=40 name='version' value="1.0"></td>

		<td class="cellLabel" width='20%'>Is Extension Module?</td>
		<td class="cellText" width='30%' colspan=3>
			<input type='checkbox' name='isextension' value='1'>
			{literal}<small>Select if CRM Record is not created</small>{/literal}
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

</div>

{include file="Footer.tpl"}
