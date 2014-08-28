<?php /* Smarty version 2.6.18, created on 2011-12-08 10:48:14
         compiled from ListTable.tpl */ ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "Header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "MastHead.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<p>Edit Module: <?php echo $this->_tpl_vars['MODULE']->modulename; ?>
</p>

<div style="width: 60%">

<table width=100% cellpadding=0 cellspacing=0 border=0>
<tr>
	<td>
		<table width=100% cellpadding=3 cellspacing=0 border=0>
		<tr>
			<td style='width: 10px;'></td>
			<td class='dvtUnSelectedCell'><a href='index.php?action=EditModule&id=<?php echo $this->_tpl_vars['MODULE']->id; ?>
'>Basic</a></td>
			<td style='width: 10px;'></td>
			<td class='dvtSelectedCell'>Table</td>
			<td style='width: 10px;'></td>
			<td class='dvtUnSelectedCell'><a href='index.php?action=ListBlock&moduleid=<?php echo $this->_tpl_vars['MODULE']->id; ?>
'>Block</a></td>
			<td style='width: 10px;'></td>
			<td class='dvtUnSelectedCell'><a href='index.php?action=ListField&moduleid=<?php echo $this->_tpl_vars['MODULE']->id; ?>
'>Field</a></td>
			<td style='width: 10px;'></td>
			<td class='dvtUnSelectedCell'><a href='index.php?action=ListFilter&moduleid=<?php echo $this->_tpl_vars['MODULE']->id; ?>
'>Filter</a></td>
			<td style='width: 10px;'></td>
			<?php if ($this->_tpl_vars['MODULE']->forversion == '5.1.0'): ?>
			<td class='dvtUnSelectedCell'><a href='index.php?action=ListEvent&moduleid=<?php echo $this->_tpl_vars['MODULE']->id; ?>
'>Event</a></td>
			<td style='width: 10px;'></td>
			<?php endif; ?>
		</tr>
		</table>
	</td>
</tr>

<tr>
	<td>
	<?php if (count ( $this->_tpl_vars['TABLES'] )): ?>
		<table width=100% cellpadding=3 cellspacing=0 border=0 class=tableHeading>
		<tr>
			<td class="big">Module Tables</td>
			<td class="small" align=right>
				<input type='button' class='create' value='Create New' onclick="location.href='index.php?action=EditTable&moduleid=<?php echo $this->_tpl_vars['MODULE']->id; ?>
'">
			</td>
		</tr>
		</table>

		<table width=100% cellpadding=5 cellspacing=0 border=0>
		<tr>
			<td class="colHeader">#</td>
			<td class="colHeader">Name</td>
			<td class="colHeader" width=5%>Type</td>
			<td class="colHeader" width=40%>Query</td>
			<td class="colHeader">Actions</td>
		</tr>
		<?php $_from = $this->_tpl_vars['TABLES']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['TABLE']):
?>
			<?php if (! $this->_tpl_vars['TABLE']->isCoreTable()): ?>
			<tr>
				<td class="cellText"><?php echo $this->_tpl_vars['TABLE']->id; ?>
</td>
				<td class="cellText"><?php echo $this->_tpl_vars['TABLE']->tablename; ?>
</td>
				<td class="cellText"><?php echo $this->_tpl_vars['TABLE']->tabletype; ?>
</td>
				<td class="cellText"><?php echo $this->_tpl_vars['TABLE']->sqlquery; ?>
</td>
				<td class="cellText">
					<?php if ($this->_tpl_vars['TABLE']->isOtherTable()): ?>
						<a href='index.php?action=EditTable&moduleid=<?php echo $this->_tpl_vars['MODULE']->id; ?>
&id=<?php echo $this->_tpl_vars['TABLE']->id; ?>
'>Edit</a> |
						<a href='index.php?action=SaveTable&moduleid=<?php echo $this->_tpl_vars['MODULE']->id; ?>
&id=<?php echo $this->_tpl_vars['TABLE']->id; ?>
&mode=delete'>Delete</a>
					<?php else: ?>&nbsp;<?php endif; ?>
				</td>
			</tr>
			<?php endif; ?>
		<?php endforeach; endif; unset($_from); ?>
		</table>
	<?php else: ?>
		<table width=100% cellpadding=3 cellspacing=0 border=0 class=tableHeading>
		<tr>
			<td>
			<input type='button' class='create' value='Create New Table' onclick="location.href='index.php?action=EditTable&moduleid=<?php echo $this->_tpl_vars['MODULE']->id; ?>
'">
			</td>
		</tr>
		</table>
	<?php endif; ?>
	</td>
</tr>
</table>

</div>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "Footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>