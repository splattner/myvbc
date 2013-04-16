<?php /* Smarty version 2.6.22, created on 2012-08-22 11:26:06
         compiled from order/new.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'popup', 'order/new.tpl', 8, false),)), $this); ?>
<form action="index.php?page=<?php echo $this->_tpl_vars['currentPage']; ?>
&action=new" method="POST">
<table class="edit">
	<tr>
		<th width="30%">
			neue Bestellung
		</th>
		<th width="70%" style="text-align: right;">
			<a <?php echo smarty_function_popup(array('caption' => "zurück",'text' => "Zurück zur Übersicht"), $this);?>
 href="index.php?page=<?php echo $this->_tpl_vars['currentPage']; ?>
&action=main"><img src="<?php echo $this->_tpl_vars['templateDir']; ?>
/images/icons/cross.png" alt="zur&uuml;ck"></a>
		</th>
	</tr>
	<tr>
	<tr>
		<td width="30%">Bemerkung zur Bestellung</td>
		<td width="70%"><textarea name="comment" cols="40" rows="6"><?php echo $this->_tpl_vars['order']['comment']; ?>
</textarea></td>
	</tr>
	
	<tr>
		<td colspan="2">
			<input type="submit" name="doNew" value="eintragen">
		</td>
	</tr>

</table>
</form>