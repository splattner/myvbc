<?php /* Smarty version 2.6.22, created on 2012-09-01 14:24:07
         compiled from administration/memberList.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'popup', 'administration/memberList.tpl', 4, false),)), $this); ?>
<h3>Zugangsverwaltung Verwaltung</h3>

<p>
	<a <?php echo smarty_function_popup(array('caption' => 'neuer Zugang','text' => "Neue Zugangsberechtigung zum System hinzufügen"), $this);?>
href="index.php?page=<?php echo $this->_tpl_vars['currentPage']; ?>
&action=addAccess"><img src="<?php echo $this->_tpl_vars['templateDir']; ?>
/images/icons/key_add.png"></a>
</p>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'messages/info.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<table class="wide">
<tr>
	<th>&nbsp;</th>
	<th>Vorname</th>
	<th>Name</th>
	<th>E-Mail</th>
	<th>Gruppe</th>
	<th>&nbsp;</th>
</tr>

<?php $_from = $this->_tpl_vars['members']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['member']):
?>
<tr>
	<td>
	<?php if (! empty ( $this->_tpl_vars['member']['password'] )): ?>
		<img src="<?php echo $this->_tpl_vars['templateDir']; ?>
/images/icons/bullet_green.png">
	<?php else: ?>
		<img src="<?php echo $this->_tpl_vars['templateDir']; ?>
/images/icons/bullet_red.png">
	<?php endif; ?>
	</td>
	<td><?php echo $this->_tpl_vars['member']['prename']; ?>
</td>
	<td><?php echo $this->_tpl_vars['member']['name']; ?>
</td>
	<td><?php echo $this->_tpl_vars['member']['email']; ?>
</td>
	<td><?php echo $this->_tpl_vars['member']['groupName']; ?>
</td>
	<td align="right">
		<a <?php echo smarty_function_popup(array('caption' => "löschen",'bgcolor' => "#FF0000",'text' => 'Zugangsberechtigung entfernen'), $this);?>
 href="index.php?page=<?php echo $this->_tpl_vars['currentPage']; ?>
&action=removeAccess&personID=<?php echo $this->_tpl_vars['member']['personID']; ?>
"><img src="<?php echo $this->_tpl_vars['templateDir']; ?>
/images/icons/key_delete.png"></a>
	</td>
</tr>
<?php endforeach; endif; unset($_from); ?>
</table>