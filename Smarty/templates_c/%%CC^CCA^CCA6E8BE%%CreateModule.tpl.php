<?php /* Smarty version 2.6.18, created on 2011-12-08 10:47:45
         compiled from CreateModule.tpl */ ?>

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
		<td class="cellText" width='30%'><input type='text' class='textBox' size=40 name='modulename' value="<?php echo $this->_tpl_vars['MODULE']->modulename; ?>
" onblur="autofill_modcreate_form(this.form);"></td>
		<td class="cellLabel" width='20%'><span class='required'>*</span>Display Label</td>
		<td class="cellText" width='30%'><input type='text' class='textBox' size=40 name='label' value="<?php echo $this->_tpl_vars['MODULE']->label; ?>
" onblur="autofill_modcreate_form(this.form);"></td>
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
			<?php echo '
			<select class=\'small\' name=\'forversion\' onchange="if(this.value==\'5.1.0\'){this.form.isextension.disabled=false;}else{this.form.isextension.checked=false;this.form.isextension.disabled=true;}">'; ?>

				<option value='5.0.4'>5.0.4</option>
				<option value='5.1.0'>5.1.0</option>
			</select>
		</td>
	</tr>
	<tr>
		<td class="cellLabel" width='20%'>Version</td>
		<td class="cellText" width='30%'><input type='text' class='textBox' size=40 name='version' value="1.0"></td>

		<td class="cellLabel" width='20%'>Is Extension Module?</td>
		<td class="cellText" width='30%' colspan=3>
			<input type='checkbox' name='isextension' value='1' disabled=true>
			<?php echo '<small>Select if CRM Record is not created</small>'; ?>

		</td>
	</tr>
	<tr>
		<td colspan=4 align=center>
			<input type="hidden" name="id" value="<?php echo $this->_tpl_vars['MODULE']->id; ?>
">
			<input type="submit" class="save" value="Save">
			<input type="button" class="cancel" value="Cancel" onclick="location.href='index.php'">
		</td>
	</tr>
	</table>
</form>

</div>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "Footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>