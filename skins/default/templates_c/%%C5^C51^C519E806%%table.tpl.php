<?php /* Smarty version 2.6.22, created on 2012-08-19 21:03:21
         compiled from report/table.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'popup', 'report/table.tpl', 3, false),)), $this); ?>
<p class="submenu">
	<?php if ($this->_tpl_vars['isAuth']): ?>
		<a <?php echo smarty_function_popup(array('caption' => "zurück",'text' => "Zurück zur Team Übersicht"), $this);?>
 href="index.php?page=<?php echo $this->_tpl_vars['currentPage']; ?>
&action=main"><img src="<?php echo $this->_tpl_vars['templateDir']; ?>
/images/icons/cross.png"></a>
	<?php endif; ?>
	<a href="#" onClick='window.print()' <?php echo smarty_function_popup(array('caption' => 'Drucken','text' => 'Diese Liste drucken'), $this);?>
><img src="<?php echo $this->_tpl_vars['templateDir']; ?>
/images/icons/printer.png"></a>
</p>


<?php if ($this->_tpl_vars['reportID'] == 5): ?>
<table class="info">
<tr>
	<td>
		<img src="<?php echo $this->_tpl_vars['templateDir']; ?>
/images/icons/exclamation.png"> Achtung: Nur angemeldete Benutzer sehen die vollst&auml;ndigen Kontaktdaten!
	</td>
</tr>
</table>
<?php endif; ?>
<?php if (! empty ( $this->_tpl_vars['tableContent'] )): ?>
<table class="report">
<tr>
	<?php $_from = $this->_tpl_vars['tableHeader']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['value']):
?>
		<th><?php echo $this->_tpl_vars['value']; ?>
</th>
	<?php endforeach; endif; unset($_from); ?>
</tr>


<?php $_from = $this->_tpl_vars['tableContent']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['line']):
?>
<tr>
	<?php $_from = $this->_tpl_vars['line']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['value']):
?>
		<td><?php echo $this->_tpl_vars['value']; ?>
</td>
	<?php endforeach; endif; unset($_from); ?>
</tr>
<?php endforeach; endif; unset($_from); ?>

</table>
<?php endif; ?>