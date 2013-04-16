<?php /* Smarty version 2.6.22, created on 2012-10-20 12:39:26
         compiled from administration/reportTable.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'popup', 'administration/reportTable.tpl', 4, false),)), $this); ?>
<h3>Berichte Verwaltung</h3>

<p>
	<a <?php echo smarty_function_popup(array('caption' => 'neuer Bericht','text' => "Neuer Bericht zum System hinzufügen"), $this);?>
href="index.php?page=<?php echo $this->_tpl_vars['currentPage']; ?>
&action=addReport"><img src="<?php echo $this->_tpl_vars['templateDir']; ?>
/images/icons/report_add.png"></a>
</p>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'messages/info.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<table class="wide">
<tr>
	<th>&nbsp;</th>
	<th>Titel</th>
	<th>&nbsp;</th>
</tr>

<?php $_from = $this->_tpl_vars['reports']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['report']):
?>
<tr>
	<td><img src="<?php echo $this->_tpl_vars['templateDir']; ?>
/images/icons/bullet_green.png""></td>
	<td><?php echo $this->_tpl_vars['report']['title']; ?>
</td>
	<td align="right">
		<a class="icons" href="index.php?page=<?php echo $this->_tpl_vars['currentPage']; ?>
&action=editReport&reportID=<?php echo $this->_tpl_vars['report']['id']; ?>
" <?php echo smarty_function_popup(array('caption' => 'bearbeiten','text' => 'Bericht bearbeiten'), $this);?>
><img src="<?php echo $this->_tpl_vars['templateDir']; ?>
/images/icons/report_edit.png"></a>
		<a class="icons" onclick="return confirm('Willst du diesen Eintrag wirklich löschen?')" href="index.php?page=<?php echo $this->_tpl_vars['currentPage']; ?>
&action=deleteReport&reportID=<?php echo $this->_tpl_vars['report']['id']; ?>
" <?php echo smarty_function_popup(array('caption' => "löschen",'bgcolor' => "#FF0000",'text' => "Bericht aus System entfernen. Achtung: Dies geschieht sofort und kann nicht rückgängig gemacht werden"), $this);?>
><img src="<?php echo $this->_tpl_vars['templateDir']; ?>
/images/icons/report_delete.png"></a>
	</td>
</tr>
<?php endforeach; endif; unset($_from); ?>
</table>