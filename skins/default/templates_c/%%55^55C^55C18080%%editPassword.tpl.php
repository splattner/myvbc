<?php /* Smarty version 2.6.22, created on 2012-09-21 23:35:51
         compiled from myData/editPassword.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'popup', 'myData/editPassword.tpl', 9, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'messages/info.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<form action="index.php?page=<?php echo $this->_tpl_vars['currentPage']; ?>
&action=editPassword" method="POST">
<table class="edit">
	<tr>
		<th width="30%">
			Mein Passwort ändern
		</th>
		<th width="70%" style="text-align: right;">
			<a <?php echo smarty_function_popup(array('caption' => "zurück",'text' => "Zurück zur Übersicht"), $this);?>
 href="index.php?page=index&action=main"><img src="<?php echo $this->_tpl_vars['templateDir']; ?>
/images/icons/cross.png"></a>
		</th>
	</tr>

	<tr>
		<td width="30%">Passwort</td>
		<td width="70%"><input type="password" name="password"></d>
	</tr>
	<tr>
		<td width="30%">Passwort bestätigen</td>
		<td width="70%"><input type="password" name="confirm"></d>
	</tr>
	
	<td>
		<td colspan="2">
			<input type="submit" name="doEdit" value="Passwort ändern">
		</td>
	</tr>

</table>
</form>