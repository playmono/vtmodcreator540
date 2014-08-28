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
			<td class='dvtUnSelectedCell'><a href='index.php?action=ListField&moduleid={$MODULE->id}'>Field</a></td>
			<td style='width: 10px;'></td>
			<td class='dvtSelectedCell'>Filter</td>
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
	{if count($FILTERS)}
		<table width=100% cellpadding=3 cellspacing=0 border=0 class=tableHeading>
		<tr>
			<td class="big">Module Filters</td>
			<td class="small" align=right>
				<input type='button' class='create' value='Create New' onclick="location.href='index.php?action=EditFilter&moduleid={$MODULE->id}'">
			</td>
		</tr>
		</table>

		<table width=100% cellpadding=5 cellspacing=0 border=0>
		<tr>
			<td class="colHeader">#</td>
			<td class="colHeader">Name</td>
			<td class="colHeader">Actions</td>
		</tr>
		{foreach item=FILTER from=$FILTERS}
			<tr>
				<td class="cellText">{$FILTER->id}</td>
				<td class="cellText">{$FILTER->filtername}</td>
				<td class="cellText">
					<a href='index.php?action=EditFilter&moduleid={$MODULE->id}&id={$FILTER->id}'>Edit</a> |
					<a href='index.php?action=SaveFilter&moduleid={$MODULE->id}&id={$FILTER->id}&mode=delete'>Delete</a>
				</td>
			</tr>
		{/foreach}
		</table>
	{else}
		<table width=100% cellpadding=3 cellspacing=0 border=0 class=tableHeading>
		<tr>
			<td>
			<input type='button' class='create' value='Create New Filter' onclick="location.href='index.php?action=EditFilter&moduleid={$MODULE->id}'">
			</td>
		</tr>
		</table>
	{/if}
	</td>
</tr>
</table>

</div>

{include file="Footer.tpl"}
