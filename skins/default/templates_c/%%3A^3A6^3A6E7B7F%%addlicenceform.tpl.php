<?php /* Smarty version 2.6.22, created on 2012-08-19 21:35:57
         compiled from order/addlicenceform.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'popup', 'order/addlicenceform.tpl', 15, false),)), $this); ?>
<table class="wide">
<tr>
	<td width="2%">
		<img src="<?php echo $this->_tpl_vars['templateDir']; ?>
/images/icons/bullet_yellow.png">
	</td>
	<td width="25%">
		<select id="personID">
			<option value="0"></option>
			<?php $_from = $this->_tpl_vars['persons']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['person']):
?>
				<option value="<?php echo $this->_tpl_vars['person']['id']; ?>
"><?php echo $this->_tpl_vars['person']['prename']; ?>
 <?php echo $this->_tpl_vars['person']['name']; ?>
</option>
			<?php endforeach; endif; unset($_from); ?>
		</select>
	</td>
	<td colspan="3">
		<a href="#" <?php echo smarty_function_popup(array('caption' => "hinzufügen",'text' => "Lizenz für diese Person zur Bestellung hinzufügen"), $this);?>
 onClick="addLicenceToOrder(<?php echo $this->_tpl_vars['orderID']; ?>
)"><img src="<?php echo $this->_tpl_vars['templateDir']; ?>
/images/icons/add.png"></a>
	</td>
</tr>
</table>