<?php /* Smarty version 2.6.22, created on 2012-08-22 10:49:04
         compiled from team/edit.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'popup', 'team/edit.tpl', 9, false),)), $this); ?>
<?php $_from = $this->_tpl_vars['teams']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['team']):
?>
<form action="index.php?page=<?php echo $this->_tpl_vars['currentPage']; ?>
&action=edit&teamID=<?php echo $this->_tpl_vars['team']['id']; ?>
" method="POST">
<table class="edit">
	<tr>
		<th width="30%">
			Team bearbeiten
		</th>
		<th width="70%" style="text-align: right;">
			<a <?php echo smarty_function_popup(array('caption' => "zurück",'text' => "Zurück zur Übersicht"), $this);?>
 href="index.php?page=<?php echo $this->_tpl_vars['currentPage']; ?>
&action=main"><img src="<?php echo $this->_tpl_vars['templateDir']; ?>
/images/icons/cross.png"></a>
		</th>
	</tr>
	<tr>
		<td width="30%">Externe ID</td>
		<td width="70%"><input class="textinput" type="text" name="extid" value="<?php echo $this->_tpl_vars['team']['extid']; ?>
"></d>
	</tr>
	<tr>
		<td width="30%">Name</td>
		<td width="70%"><input class="textinput" type="text" name="name" value="<?php echo $this->_tpl_vars['team']['name']; ?>
"></d>
	</tr>
	<tr>
		<td width="30%">Externer Name</td>
		<td width="70%"><input class="textinput" type="text" name="extname" value="<?php echo $this->_tpl_vars['team']['extname']; ?>
"></d>
	</tr>
	<tr>
		<td width="30%">Liga</td>
		<td width="70%"><input class="textinput" type="text" name="liga" value="<?php echo $this->_tpl_vars['team']['liga']; ?>
"></d>
	</tr>
	<tr>
		<td width="30%">Externe Liga</td>
		<td width="70%"><input class="textinput" type="text" name="extliga" value="<?php echo $this->_tpl_vars['team']['extliga']; ?>
"></d>
	</tr>
	<tr>
		<td width="30%">Type</td>
		<td width="70%">
			<select name="typ">
				<?php if ($this->_tpl_vars['team']['typ'] == 1): ?>
					<option value="1" selected="selected">SwissVolley (National)</option>
					<option value="2">Swissvolley Region Solothurn</option>
				<?php elseif ($this->_tpl_vars['team']['typ'] == 2): ?>
					<option value="1" >SwissVolley (National)</option>
					<option value="2" selected="selected">Swissvolley Region Solothurn</option>
				<?php endif; ?>
			</select>
	</tr>
	<td>
		<td colspan="2">
			<input type="submit" name="doEdit" value="bearbeiten">
		</td>
	</tr>

</table>
</form>
<?php endforeach; endif; unset($_from); ?>