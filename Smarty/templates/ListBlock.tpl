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
			<td class='dvtSelectedCell'>Block</td>
			<td style='width: 10px;'></td>
			<td class='dvtUnSelectedCell'><a href='index.php?action=ListField&moduleid={$MODULE->id}'>Field</a></td>
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
	{if count($BLOCKS)}
		<table width=100% cellpadding=3 cellspacing=0 border=0 class=tableHeading>
		<tr>
			<td class="big">Module Blocks</td>
			<td class="small" align=right>
				<input type='button' class='create' value='Create New' onclick="location.href='index.php?action=EditBlock&moduleid={$MODULE->id}'">
			</td>
		</tr>
		</table>

		<table width=100% cellpadding=5 cellspacing=0 border=0>
		<tr>
			<td class="colHeader">#</td>
			<td class="colHeader">Label</td>
			<td class="colHeader">Translation</td>
			<td class="colHeader">Actions</td>
		</tr>
		{foreach item=BLOCK from=$BLOCKS}
			<tr>
				<td class="cellText">{$BLOCK->id}</td>
				<td class="cellText">{$BLOCK->label}</td>
				<td class="cellText">{$BLOCK->trlabel}</td>
				<td class="cellText">
					<a href='index.php?action=EditBlock&moduleid={$MODULE->id}&id={$BLOCK->id}'>Edit</a> |
					<a href='index.php?action=SaveBlock&moduleid={$MODULE->id}&id={$BLOCK->id}&mode=delete'>Delete</a>
				</td>
			</tr>
		{/foreach}
		</table>
	{else}
		<table width=100% cellpadding=3 cellspacing=0 border=0 class=tableHeading>
		<tr>
			<td>
			<input type='button' class='create' value='Create New Block' onclick="location.href='index.php?action=EditBlock&moduleid={$MODULE->id}'">
			</td>
		</tr>
		</table>
	{/if}
	</td>
</tr>
</table>

</div>

{include file="Footer.tpl"}
