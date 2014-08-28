<?php /* Smarty version 2.6.18, created on 2011-12-08 10:47:59
         compiled from CreateField.tpl */ ?>

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
			<td class='dvtUnSelectedCell'><a href='index.php?action=ListTable&moduleid=<?php echo $this->_tpl_vars['MODULE']->id; ?>
'>Table</a></td>
			<td style='width: 10px;'></td>
			<td class='dvtUnSelectedCell'><a href='index.php?action=ListBlock&moduleid=<?php echo $this->_tpl_vars['MODULE']->id; ?>
'>Block</a></td>
			<td style='width: 10px;'></td>
			<td class='dvtSelectedCell'>Field</td>
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
	<form method="POST" action="index.php">
		<input type="hidden" name="action" value="SaveField">
		<table width=100% cellpadding=3 cellspacing=0 border=0 class=tableHeading>
		<tr>
			<td class="big">New Field</td>
		</tr>
		</table>

		<table width=100% cellpadding=5 cellspacing=0 border=0>
		<tr>
			<td class="cellLabel" width='20%'><span class='required'>*</span>Name</td>
			<td class="cellText" width='30%'><input type='text' class='textBox' size=40 name='fieldname' value="<?php echo $this->_tpl_vars['FIELD']->fieldname; ?>
" onblur="autofill_fldcreate_form(this.form)"></td>
			<td class="cellLabel" width='20%'><span class='required'>*</span>Table</td>
			<td class="cellText" width='30%'>
				<select name="tableid" class="small">
					<?php $_from = $this->_tpl_vars['TABLES']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['TABLE']):
?>
					<option value="<?php echo $this->_tpl_vars['TABLE']->id; ?>
"><?php echo $this->_tpl_vars['TABLE']->tablename; ?>
</option>
					<?php endforeach; endif; unset($_from); ?>
				</select>
			</td>
						
		</tr>
		<tr>	
			<td class="cellLabel" width='20%'><span class='required'>*</span>Block</td>
			<td class="cellText" width='30%'>
				<select name="blockid" class="small">
					<?php $_from = $this->_tpl_vars['BLOCKS']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['BLOCK']):
?>
					<option value="<?php echo $this->_tpl_vars['BLOCK']->id; ?>
"><?php echo $this->_tpl_vars['BLOCK']->trlabel; ?>
</option>
					<?php endforeach; endif; unset($_from); ?>
				</select>
			</td>
			<td class="cellLabel" width='20%'><span class='required'>*</span>Column</td>
			<td class="cellText" width='30%'>
				<input type='text' class='textBox' size=40 name='columnname' value="<?php echo $this->_tpl_vars['FIELD']->trlabel; ?>
">
				<small>Should be smallcase</small>
			</td>
		</tr>
		<tr>
			<td class="cellLabel" width='20%'><span class='required'>*</span>Label</td>
			<td class="cellText" width='30%'><input type='text' class='textBox' size=40 name='label' value="<?php echo $this->_tpl_vars['FIELD']->label; ?>
"></td>
			<td class="cellLabel" width='20%'><span class='required'>*</span>Translation</td>
			<td class="cellText" width='30%'><input type='text' class='textBox' size=40 name='trlabel' value="<?php echo $this->_tpl_vars['FIELD']->trlabel; ?>
"></td>
		</tr>
		<tr>
			<td class="cellLabel" width='20%'><span class='required'>*</span>Type</td>
			<td class="cellText" width='30%'>
				<select name="uitype" class="small">
					<?php $_from = $this->_tpl_vars['UITYPES']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['UITYPE_LBL'] => $this->_tpl_vars['UITYPE_KEY']):
?>
					<option value="<?php echo $this->_tpl_vars['UITYPE_KEY']; ?>
"><?php echo $this->_tpl_vars['UITYPE_LBL']; ?>
</option>
					<?php endforeach; endif; unset($_from); ?>
				</select>
			</td>
			<td class="cellLabel" width='20%'>Show In</td>
			<td class="cellText" width='30%'>
				<select name="displaytype" class="small">
					<option value="1" <?php if ($this->_tpl_vars['FIELD']->displaytype == 1): ?>selected=true<?php endif; ?>>Create, Edit, Detail</option>
					<option value="2" <?php if ($this->_tpl_vars['FIELD']->displaytype == 2): ?>selected=true<?php endif; ?>>Only Detail</option>
					<option value="3" <?php if ($this->_tpl_vars['FIELD']->displaytype == 3): ?>selected=true<?php endif; ?>>Hide In All</option>
					<option value="4" <?php if ($this->_tpl_vars['FIELD']->displaytype == 4): ?>selected=true<?php endif; ?>>Password</option>
					<option value="5" <?php if ($this->_tpl_vars['FIELD']->displaytype == 5): ?>selected=true<?php endif; ?>>Encrypted</option>
				</select> View
			</td>
		</tr>
		<tr>
			<td class="cellLabel" width='20%'>Entity Field?</td>
			<td class="cellText" width='30%'>
				<input type="checkbox" name="isentityfield" value="1" <?php if ($this->_tpl_vars['FIELD']->isentityfield == 1): ?>checked=true<?php endif; ?>>
			</td>
			<td class="cellLabel" width='20%'>Is Mandatory?</td>
			<td class="cellText" width='30%'>
				<input type="checkbox" name="ismandatory" value="1" <?php if ($this->_tpl_vars['FIELD']->ismandatory == 1): ?>checked=true<?php endif; ?>>
			</td>
		</tr>
		<tr>
			<td class="cellLabel" width='20%'>Information Type</td>
			<td class="cellText" width='30%'>
				<select name="infotype" class="small">
					<option value="BAS" <?php if ($this->_tpl_vars['FIELD']->infotype == 'BAS'): ?>selected=true<?php endif; ?>>Basic</option>
					<option value="ADV" <?php if ($this->_tpl_vars['FIELD']->infotype == 'ADV'): ?>selected=true<?php endif; ?>>Advanced</option>
				</select>
			</td>
			<td class="cellLabel" width='20%'>Mass Edit</td>
			<td class="cellText" width='30%'>
				<input type="text" name="masseditable" class='textBox' size=40 value="1">
				<br><small>0 - Never Allow, 1 - Allow, 2 - Disable</small>
			</td>
		</tr>
		<tr>
			<td class="cellLabel" width='20%'>Help Info</td>
			<td class="cellText" width='30%'>
				<textarea name="helpinfo" rows=1 cols=35 class="textBox"><?php echo $this->_tpl_vars['FIELD']->helpinfo; ?>
</textarea>
			</td>
		</tr>
		<tr>
			<td colspan=4 align=center>
				<input type="hidden" name="id" value="<?php echo $this->_tpl_vars['FIELD']->id; ?>
">
				<input type="hidden" name="moduleid" value="<?php echo $this->_tpl_vars['MODULE']->id; ?>
">
				<input type="submit" class="save" value="Save">
				<input type="button" class="cancel" value="Cancel" onclick="location.href='index.php?action=ListField&moduleid=<?php echo $this->_tpl_vars['MODULE']->id; ?>
'">
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