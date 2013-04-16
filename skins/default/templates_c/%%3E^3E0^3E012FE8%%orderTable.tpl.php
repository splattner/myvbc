<?php /* Smarty version 2.6.22, created on 2012-08-19 20:58:29
         compiled from order/orderTable.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'popup', 'order/orderTable.tpl', 2, false),array('modifier', 'date_format', 'order/orderTable.tpl', 37, false),)), $this); ?>
<p class="submenu">
	<a href="index.php?page=<?php echo $this->_tpl_vars['currentPage']; ?>
&action=new" <?php echo smarty_function_popup(array('caption' => 'neue Lizenzbestellung','text' => "Eine neue Lizenzbestellung tätigen"), $this);?>
><img src="<?php echo $this->_tpl_vars['templateDir']; ?>
/images/icons/basket_add.png" ></a>
</p>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'messages/info.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<table class="legend">
<tr>
	<td>
		<img src="<?php echo $this->_tpl_vars['templateDir']; ?>
/images/icons/bullet_green.png"> Status: Erfassen<br />
		<img src="<?php echo $this->_tpl_vars['templateDir']; ?>
/images/icons/bullet_yellow.png"> Status: Bestellung ausgelöst<br />
		<img src="<?php echo $this->_tpl_vars['templateDir']; ?>
/images/icons/bullet_blue.png"> Status: In Bearbeitung<br />
		<img src="<?php echo $this->_tpl_vars['templateDir']; ?>
/images/icons/bullet_red.png"> Status: Abgeschlossen<br />
	</td>
</tr>
</table>

<table class="wide">
<tr>
	<th width="2%"></th>
	<th width="20%">Datum</th>
	<th width="20%">letzte Änderung</th>
	<th width="38%">Kommentar</th>
	<th width="15%">Ausgelöst durch</th>
	<th width="5%">&nbsp;</th>
</tr>

<?php $_from = $this->_tpl_vars['orders']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['order']):
?>
<tr>
	<td>
		<?php if ($this->_tpl_vars['order']['status'] == 1): ?><img src="<?php echo $this->_tpl_vars['templateDir']; ?>
/images/icons/bullet_green.png"><?php endif; ?>
		<?php if ($this->_tpl_vars['order']['status'] == 2): ?><img src="<?php echo $this->_tpl_vars['templateDir']; ?>
/images/icons/bullet_yellow.png"><?php endif; ?>
		<?php if ($this->_tpl_vars['order']['status'] == 3): ?><img src="<?php echo $this->_tpl_vars['templateDir']; ?>
/images/icons/bullet_blue.png"><?php endif; ?>
		<?php if ($this->_tpl_vars['order']['status'] == 4): ?><img src="<?php echo $this->_tpl_vars['templateDir']; ?>
/images/icons/bullet_red.png"><?php endif; ?>
	</td>
	<td>
		<?php echo ((is_array($_tmp=$this->_tpl_vars['order']['createdate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%a, %d %B %y - %H:%M") : smarty_modifier_date_format($_tmp, "%a, %d %B %y - %H:%M")); ?>

	</td>
	<td>
		<?php echo ((is_array($_tmp=$this->_tpl_vars['order']['lastupdate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%a, %d %B %y - %H:%M") : smarty_modifier_date_format($_tmp, "%a, %d %B %y - %H:%M")); ?>

	</td>

	<td>
		<?php echo $this->_tpl_vars['order']['comment']; ?>

	</td>
	<td>
		<?php echo $this->_tpl_vars['order']['ownername']; ?>

	</td>
	<td align="right">
		<a <?php echo smarty_function_popup(array('caption' => "Anzeigen & bearbeiten",'text' => "Diese Bestellung anzeigen. Bearbeiten nur möglich bei Status erfassen"), $this);?>
 href="index.php?page=<?php echo $this->_tpl_vars['currentPage']; ?>
&action=list&orderID=<?php echo $this->_tpl_vars['order']['id']; ?>
"><img src="<?php echo $this->_tpl_vars['templateDir']; ?>
/images/icons/basket_edit.png" alt="Spiel bearbeiten"></a>
		<?php if (( ( $this->_tpl_vars['allowedit'] && $this->_tpl_vars['order']['status'] != 4 ) || ( $this->_tpl_vars['order']['owner'] == $this->_tpl_vars['uid'] && $this->_tpl_vars['order']['status'] == 1 ) )): ?>
			<a onclick="return confirm('Willst du diesen Bestellung wirklich löschen?')" <?php echo smarty_function_popup(array('caption' => "löschen",'bgcolor' => "#FF0000",'text' => "Diese Bestellung löschen"), $this);?>
 href="index.php?page=<?php echo $this->_tpl_vars['currentPage']; ?>
&action=delete&orderID=<?php echo $this->_tpl_vars['order']['id']; ?>
"><img src="<?php echo $this->_tpl_vars['templateDir']; ?>
/images/icons/basket_delete.png"></a>
		<?php endif; ?>
	</td>
</tr>
<?php endforeach; endif; unset($_from); ?>


</table>