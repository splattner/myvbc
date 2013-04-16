<?php /* Smarty version 2.6.22, created on 2012-08-19 21:01:26
         compiled from order/orderItemEntrys.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'popup', 'order/orderItemEntrys.tpl', 28, false),)), $this); ?>
<table class="wide">
<tr>
	<th width="2%">&nbsp;</th>
	<th width="25%">Person</th>
	<th width="25%">Lizenz</th>
	<th width="38%">Kommentar</th>
	<th width="10%">&nbsp;</th>
</tr>

<?php $_from = $this->_tpl_vars['orderitems']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['orderitem']):
?>
<tr>
	<td>
		<img src="<?php echo $this->_tpl_vars['templateDir']; ?>
/images/icons/bullet_green.png">
	</td>
	<td>
		<?php echo $this->_tpl_vars['orderitem']['prename']; ?>
 <?php echo $this->_tpl_vars['orderitem']['name']; ?>

	</td>
	<td>
		<?php echo $this->_tpl_vars['orderitem']['licence']; ?>
 
	</td>

	<td>
		<?php echo $this->_tpl_vars['orderitem']['comment']; ?>
 
	</td>

	<td align="right">
		<?php if (( ( $this->_tpl_vars['allowedit'] && $this->_tpl_vars['order'][0]['status'] != 4 ) || ( $this->_tpl_vars['order'][0]['owner'] == $this->_tpl_vars['uid'] && $this->_tpl_vars['order'][0]['status'] == 1 ) )): ?>
			<a onclick="removeLicenceFromOrder(<?php echo $this->_tpl_vars['orderitem']['personID']; ?>
,<?php echo $this->_tpl_vars['orderitem']['orderID']; ?>
)" <?php echo smarty_function_popup(array('caption' => "löschen",'bgcolor' => "#FF0000",'text' => 'Diese Lizenz entfernen'), $this);?>
 href="#"><img src="<?php echo $this->_tpl_vars['templateDir']; ?>
/images/icons/basket_remove.png"></a>
		<?php endif; ?>	
	</td>
</tr>
<?php endforeach; endif; unset($_from); ?>
</table>