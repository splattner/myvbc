<?php /* Smarty version 2.6.22, created on 2012-08-21 00:05:03
         compiled from myData/edit.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'popup', 'myData/edit.tpl', 8, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'messages/info.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<table class="edit">
	<tr>
		<th width="30%">
			Meine Daten bearbeiten
		</th>
		<th width="70%" style="text-align: right;">
			<a <?php echo smarty_function_popup(array('caption' => "zurück",'text' => "Zurück zur Übersicht"), $this);?>
 href="index.php?page=index&action=main"><img src="<?php echo $this->_tpl_vars['templateDir']; ?>
/images/icons/cross.png"></a>
		</th>
	</tr>
	<tr>
		<td colspan="2"><?php echo $this->_tpl_vars['plugins']['persondata']; ?>
</td>
	</tr>
</table>

<?php echo $this->_tpl_vars['plugins']['history']; ?>

