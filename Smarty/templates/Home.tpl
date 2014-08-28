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

<p>vtiger CRM module developement made easy!</p>

<div style='width: 65%'>

{if count($MODULES)}
	<table width=100% cellpadding=3 cellspacing=0 border=0 class=tableHeading>
	<tr>
		<td class="big">Your Modules</td>
		<td class="small" align=right>
			<input type='button' class='create' value='Create New' onclick="location.href='index.php?action=EditModule'">
		</td>
	</tr>
	</table>

	<table width=100% cellpadding=5 cellspacing=0 border=0>
	<tr>
		<td class="colHeader">#</td>
		<td class="colHeader">Name</td>
		<td class="colHeader">Label</td>
		<td class="colHeader">Parent</td>
		<td class="colHeader">Version</td>
		<td class="colHeader">For vtiger</td>
		<td class="colHeader">Actions</td>
	</tr>
	{foreach item=MODULE from=$MODULES}
		<tr>
			<td class="cellText">{$MODULE->id}</td>
			<td class="cellText">{$MODULE->modulename}</td>
			<td class="cellText">{$MODULE->label}</td>
			<td class="cellText">{$MODULE->parent}</td>
			<td class="cellText">{$MODULE->version}</td>
			<td class="cellText">{$MODULE->forversion}</td>
			<td class="cellText">
				<a href='index.php?action=EditModule&id={$MODULE->id}'>Edit</a> |
				<a href='index.php?action=SaveModule&id={$MODULE->id}&mode=delete' onclick="return confirm('Are you sure to delete {$MODULE->modulename} Module?')">Delete</a> |
				<a href='index.php?action=ExportModule&id={$MODULE->id}'>Export</a>
			</td>
		</tr>
	{/foreach}
	</table>
{else}
	<input type='button' class='create' value='Create New Module' onclick="location.href='index.php?action=EditModule'">
{/if}

</div>

{include file="Footer.tpl"}
