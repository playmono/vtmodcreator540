<?php /* Smarty version 2.6.18, created on 2011-12-08 10:48:12
         compiled from EditModule.tpl */ ?>

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
			<td class='dvtSelectedCell'>Basic</td>
			<td style='width: 10px;'></td>
			<td class='dvtUnSelectedCell'><a href='index.php?action=ListTable&moduleid=<?php echo $this->_tpl_vars['MODULE']->id; ?>
'>Table</a></td>
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
					<option value='My Home Page' <?php if ($this->_tpl_vars['MODULE']->parent == 'My Home Page'): ?>selected=true<?php endif; ?>>My Home Page</option>
					<option value='Marketing'    <?php if ($this->_tpl_vars['MODULE']->parent == 'Marketing'): ?>selected=true<?php endif; ?>>Marketing</option>
					<option value='Sales'        <?php if ($this->_tpl_vars['MODULE']->parent == 'Sales'): ?>selected=true<?php endif; ?>>Sales</option>
					<option value='Support'      <?php if ($this->_tpl_vars['MODULE']->parent == 'Support'): ?>selected=true<?php endif; ?>>Support</option>
					<option value='Tools'        <?php if ($this->_tpl_vars['MODULE']->parent == 'Tools'): ?>selected=true<?php endif; ?>>Tools</option>
					<option value='Inventory'    <?php if ($this->_tpl_vars['MODULE']->parent == 'Inventory'): ?>selected=true<?php endif; ?>>Inventory</option>
					<option value=''    <?php if ($this->_tpl_vars['MODULE']->parent == ''): ?>selected=true<?php endif; ?>>-- Not Under Menu --</option>
				</select>
			</td>
			<td class="cellLabel" width='20%'>For Version</td>
			<td class="cellText" width='30%'>
			<?php echo '
			<select class=\'small\' name=\'forversion\' onchange="if(this.value==\'5.1.0\'){this.form.isextension.disabled=false;}else{this.form.isextension.checked=false;this.form.isextension.disabled=true;}">'; ?>

					<option value='5.0.4' <?php if ($this->_tpl_vars['MODULE']->forversion == '5.0.4'): ?>selected=true<?php endif; ?>>5.0.4</option>
					<option value='5.1.0' <?php if ($this->_tpl_vars['MODULE']->forversion == '5.1.0'): ?>selected=true<?php endif; ?>>5.1.0</option>
				</select>
			</td>
		</tr>		
		<tr>
			<td class="cellLabel" width='20%'>Version</td>
			<td class="cellText" width='30%'><input type='text' class='textBox' size=40 name='version' value="<?php echo $this->_tpl_vars['MODULE']->version; ?>
"></td>

			<td class="cellLabel" width='20%'>Is Extension Module?</td>
			<td class="cellText" width='80%' colspan=3>
				<input type='checkbox' name='isextension' value='1' <?php if ($this->_tpl_vars['MODULE']->isextension): ?>checked=true<?php endif; ?>>
				<?php echo '<small>Select if CRM Record is not created</small>'; ?>

			</td>
		</tr>
		<tr valign=top>
		<td class="cellLabel" width='20%'>License Text</td>
			<td class="cellText" width='80%' colspan=3>
				<textarea name="licensetext" class="small" rows=5 cols=80><?php echo $this->_tpl_vars['MODULE']->licensetext; ?>
</textarea>
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
	</td>
</tr>
</table>

</div>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "Footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>