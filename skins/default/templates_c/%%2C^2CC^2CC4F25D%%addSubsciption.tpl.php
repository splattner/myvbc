<?php /* Smarty version 2.6.22, created on 2012-11-13 10:15:08
         compiled from administration/addSubsciption.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'popup', 'administration/addSubsciption.tpl', 8, false),)), $this); ?>
<form action="index.php?page=<?php echo $this->_tpl_vars['currentPage']; ?>
&action=addNoteSubscription" method="POST">
<table class="edit">
	<tr>
		<th width="30%">
			Subscription hinzuf&uuml;gen
		</th>
		<th width="70%" style="text-align: right">
			<a <?php echo smarty_function_popup(array('caption' => "zurück",'text' => "Zurück zur Übersicht"), $this);?>
 href="index.php?page=<?php echo $this->_tpl_vars['currentPage']; ?>
&action=notifications"><img src="<?php echo $this->_tpl_vars['templateDir']; ?>
/images/icons/cross.png"></a>
		</th>
	</tr>
	<tr>
		<td width="30%">
			Person ausw&auml;hlen
		</td>
		<td width="70%">
			<select name="personID">
				<option value="0" >(Bitte ausw&auml;hlen)</option>
				<?php $_from = $this->_tpl_vars['users']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['user']):
?>
					<option value="<?php echo $this->_tpl_vars['user']['id']; ?>
"><?php echo $this->_tpl_vars['user']['prename']; ?>
 <?php echo $this->_tpl_vars['user']['name']; ?>
</option>
				<?php endforeach; endif; unset($_from); ?>
			</select>
		</td>
	</tr>
	<tr>
		<td width="30%">
			Type
		</td>
		<td width="70%">
			<select name="typeID">
				<option value="0" >(Bitte ausw&auml;hlen)</option>
				<?php $_from = $this->_tpl_vars['types']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['type']):
?>
					<option value="<?php echo $this->_tpl_vars['type']['id']; ?>
"><?php echo $this->_tpl_vars['type']['name']; ?>
</option>
				<?php endforeach; endif; unset($_from); ?>
			</select>
		</td>
	</tr>
		<tr>
		<td width="30%">
			E-Mail
		</td>
		<td width="70%">
			<input type="checkbox" name="email" value="1">
		</td>
	</tr>
	<td>
		<td colspan="2">
			<input type="submit" name="doAdd" value="hinzuf&uuml;gen">
		</td>
	</tr>

</table>
</form>