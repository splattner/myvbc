<?php /* Smarty version 2.6.22, created on 2012-08-19 20:53:30
         compiled from administration/subscriptionTable.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'popup', 'administration/subscriptionTable.tpl', 4, false),array('modifier', 'date_format', 'administration/subscriptionTable.tpl', 44, false),)), $this); ?>
<h3>Benachrichtigungs Verwaltung</h3>

<p>
	<a <?php echo smarty_function_popup(array('caption' => 'neuer Subscription','text' => 'Person auf einen Nachrichtentype einschreiben'), $this);?>
href="index.php?page=<?php echo $this->_tpl_vars['currentPage']; ?>
&action=addNoteSubscription"><img src="<?php echo $this->_tpl_vars['templateDir']; ?>
/images/icons/note_add.png"></a>
</p>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'messages/info.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<table class="wide">
<tr>
	<th>&nbsp;</th>
	<th>Benachrichtigungstype</th>
	<th>Person</th>
	<th>&nbsp;</th>
</tr>

<?php $_from = $this->_tpl_vars['subscriptions']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['subscription']):
?>
<tr>
	<td><img src="<?php echo $this->_tpl_vars['templateDir']; ?>
/images/icons/bullet_green.png""></td>
	<td><?php echo $this->_tpl_vars['subscription']['type']; ?>
</td>
	<td><?php echo $this->_tpl_vars['subscription']['prename']; ?>
 <?php echo $this->_tpl_vars['subscription']['name']; ?>
</td>
	<td align="right">
		<?php if ($this->_tpl_vars['subscription']['email'] == 1): ?><img src="<?php echo $this->_tpl_vars['templateDir']; ?>
/images/icons/email.png"><?php endif; ?>
		<a class="icons" href="index.php?page=<?php echo $this->_tpl_vars['currentPage']; ?>
&action=deleteNoteSubscription&typeID=<?php echo $this->_tpl_vars['subscription']['typeid']; ?>
&personID=<?php echo $this->_tpl_vars['subscription']['personid']; ?>
" <?php echo smarty_function_popup(array('caption' => "löschen",'bgcolor' => "#FF0000",'text' => "Subscription entfernen Achtung: Dies geschieht sofort und kann nicht rückgängig gemacht werden"), $this);?>
><img src="<?php echo $this->_tpl_vars['templateDir']; ?>
/images/icons/note_delete.png"></a>
	</td>
</tr>
<?php endforeach; endif; unset($_from); ?>
</table>

<h3>Alle Benachrichtigungen</h3>
<table class="wide">
<tr>
	<th>Nachrichten-Typ</th>
	<th>Datum</th>
	<th>Inhalt</th>
	<th>Auslöser</th>
	<th>&nbsp</th>
</tr>

<?php $_from = $this->_tpl_vars['allnotifications']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['allnotification']):
?>
<tr>
	<td><?php echo $this->_tpl_vars['allnotification']['type']; ?>
</td>
	<td><?php echo $this->_tpl_vars['allnotification']['message']; ?>
</td>
	<td><?php echo ((is_array($_tmp=$this->_tpl_vars['allnotification']['date'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y - %H:%M") : smarty_modifier_date_format($_tmp, "%d.%m.%Y - %H:%M")); ?>
</td>
	<td><?php echo $this->_tpl_vars['allnotification']['prename']; ?>
 <?php echo $this->_tpl_vars['allnotification']['name']; ?>
</td>
		<td align="right">
		<a class="icons" href="index.php?page=<?php echo $this->_tpl_vars['currentPage']; ?>
&action=deleteNote&notificationID=<?php echo $this->_tpl_vars['allnotification']['notificationID']; ?>
" <?php echo smarty_function_popup(array('caption' => "löschen",'bgcolor' => "#FF0000",'text' => "Diese Benachrichtigung global löschen. Achtung: Dies geschieht sofort und kann nicht rückgängig gemacht werden"), $this);?>
><img src="<?php echo $this->_tpl_vars['templateDir']; ?>
/images/icons/note_delete.png"></a>
	</td>
</tr>
<?php endforeach; endif; unset($_from); ?>
<?php if (empty ( $this->_tpl_vars['allnotifications'] )): ?>
<tr>
	<td colspan="4">
		<i>Keine Benachrichtigungen vorhanden</i>
	</td>
</tr>
<?php endif; ?>
</table>