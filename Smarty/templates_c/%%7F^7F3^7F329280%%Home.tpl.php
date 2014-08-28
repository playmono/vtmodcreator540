<?php /* Smarty version 2.6.18, created on 2011-12-08 10:47:42
         compiled from Home.tpl */ ?>

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

<p>vtiger CRM module developement made easy!</p>

<div style='width: 65%'>

<?php if (count ( $this->_tpl_vars['MODULES'] )): ?>
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
	<?php $_from = $this->_tpl_vars['MODULES']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['MODULE']):
?>
		<tr>
			<td class="cellText"><?php echo $this->_tpl_vars['MODULE']->id; ?>
</td>
			<td class="cellText"><?php echo $this->_tpl_vars['MODULE']->modulename; ?>
</td>
			<td class="cellText"><?php echo $this->_tpl_vars['MODULE']->label; ?>
</td>
			<td class="cellText"><?php echo $this->_tpl_vars['MODULE']->parent; ?>
</td>
			<td class="cellText"><?php echo $this->_tpl_vars['MODULE']->version; ?>
</td>
			<td class="cellText"><?php echo $this->_tpl_vars['MODULE']->forversion; ?>
</td>
			<td class="cellText">
				<a href='index.php?action=EditModule&id=<?php echo $this->_tpl_vars['MODULE']->id; ?>
'>Edit</a> |
				<a href='index.php?action=SaveModule&id=<?php echo $this->_tpl_vars['MODULE']->id; ?>
&mode=delete' onclick="return confirm('Are you sure to delete <?php echo $this->_tpl_vars['MODULE']->modulename; ?>
 Module?')">Delete</a> |
				<a href='index.php?action=ExportModule&id=<?php echo $this->_tpl_vars['MODULE']->id; ?>
'>Export</a>
			</td>
		</tr>
	<?php endforeach; endif; unset($_from); ?>
	</table>
<?php else: ?>
	<input type='button' class='create' value='Create New Module' onclick="location.href='index.php?action=EditModule'">
<?php endif; ?>

</div>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "Footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>