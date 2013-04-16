<?php /* Smarty version 2.6.22, created on 2012-08-19 20:53:27
         compiled from notification/notificationTable.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'notification/notificationTable.tpl', 16, false),array('function', 'popup', 'notification/notificationTable.tpl', 19, false),)), $this); ?>

<h3>Deine  Benachrichtigungen</h3>
<table class="wide">
<tr>
	<th>Nachrichten-Typ</th>
	<th>Inhalt</th>
	<th>Datum</th>
	<th>Auslöser</th>
	<th>&nbsp;</th>
</tr>

<?php $_from = $this->_tpl_vars['notifications']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['notification']):
?>
<tr>
	<td><?php echo $this->_tpl_vars['notification']['type']; ?>
</td>
	<td><?php echo $this->_tpl_vars['notification']['message']; ?>
</td>
	<td><?php echo ((is_array($_tmp=$this->_tpl_vars['notification']['date'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y - %H:%M") : smarty_modifier_date_format($_tmp, "%d.%m.%Y - %H:%M")); ?>
</td>
	<td><?php echo $this->_tpl_vars['notification']['prename']; ?>
 <?php echo $this->_tpl_vars['notification']['name']; ?>
</td>
	<td align="right">
		<a class="icons" <?php echo smarty_function_popup(array('caption' => 'Erledigt','text' => "Diese Nachricht als erledigt markieren. Nachricht wird anschliessend nicht mehr angezeigt"), $this);?>
 href="index.php?page=<?php echo $this->_tpl_vars['currentPage']; ?>
&action=delete&notificationID=<?php echo $this->_tpl_vars['notification']['notificationID']; ?>
"><img src="<?php echo $this->_tpl_vars['templateDir']; ?>
/images/icons/note_delete.png" ></a>

	</td>
</tr>
<?php endforeach; endif; unset($_from); ?>
<?php if (empty ( $this->_tpl_vars['notifications'] )): ?>
<tr>
	<td colspan="5">
		<i>Keine neuen Benachrichtigungen vorhanden</i>
	</td>
</tr>
<?php endif; ?>
</table>