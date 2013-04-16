<?php /* Smarty version 2.6.22, created on 2012-05-23 15:28:46
         compiled from auth/choosePerson.tpl */ ?>
<form action="index.php?page=<?php echo $this->_tpl_vars['currentPage']; ?>
&action=createAccess&step2" method="POST">
<table class="edit">
	<tr>
		<th width="30%">
			Zugang einrichten
		</th>
		<th width="70%" style="text-align: right;">
			<a href="index.php?page=index"><img src="<?php echo $this->_tpl_vars['templateDir']; ?>
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
	<td>
		<td colspan="2">
			<input type="submit" name="doChoose" value="auswählen">
		</td>
	</tr>

</table>
</form>