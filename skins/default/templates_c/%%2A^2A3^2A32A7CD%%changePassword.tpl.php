<?php /* Smarty version 2.6.22, created on 2012-09-01 14:24:15
         compiled from administration/changePassword.tpl */ ?>
<form action="index.php?page=<?php echo $this->_tpl_vars['currentPage']; ?>
&action=changePassword" method="POST">
<table class="edit">
	<tr>
		<th width="30%">
			Passwort &auml;ndern
		</th>
		<th width="70%" style="text-align: right;">
			<a href="index.php?page=<?php echo $this->_tpl_vars['currentPage']; ?>
&action=functions"><img src="<?php echo $this->_tpl_vars['templateDir']; ?>
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
			Passwort
		</td>
		<td width="70%">
			<input type="password" name="password" />
		</td>
	</tr>
	<td>
		<td colspan="2">
			<input type="submit" name="changePassword" value="&auml;ndern">
		</td>
	</tr>

</table>
</form>