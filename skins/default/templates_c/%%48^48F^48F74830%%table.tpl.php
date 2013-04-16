<?php /* Smarty version 2.6.22, created on 2012-08-19 20:54:59
         compiled from plugins/history/table.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'plugins/history/table.tpl', 14, false),)), $this); ?>
<h2>History</h2>

<table class="wide">
<tr>
	<th width="20%">Nachricht Typ</th>
	<th width="50%">Inhalt</th>
	<th width="20%">Datum</th>
	<th width="30%">Auslöser</th>
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
</tr>
<?php endforeach; endif; unset($_from); ?>

<?php if (empty ( $this->_tpl_vars['notifications'] )): ?>
<tr>
	<td colspan="4">
		<i>Keine History vorhanden</i>
	</td>
</tr>
<?php endif; ?>

</table>

<h2>Lizenzbestellungen</h2>

<table class="wide">
<tr>
	<th width="20%">Bestelldatum</th>
	<th width="20%">Bestelstatus</th>
	<th width="20%">Lizenz</th>
	<th width="40">Kommentar zur Bestellung</th>
</tr>
<?php $_from = $this->_tpl_vars['myorders']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['myorder']):
?>
<tr>
	<td><?php echo $this->_tpl_vars['myorder']['date']; ?>
</td>
	<td><?php echo $this->_tpl_vars['myorder']['status']; ?>
</td>
	<td><?php echo $this->_tpl_vars['myorder']['licence']; ?>
</td>
	<td><?php echo $this->_tpl_vars['myorder']['order_comment']; ?>
</td>
</tr>
<?php endforeach; endif; unset($_from); ?>

<?php if (empty ( $this->_tpl_vars['myorders'] )): ?>
<tr>
	<td colspan="4">
		<i>Keine Lizenzbestellungen vorhanden</i>
	</td>
</tr>
<?php endif; ?>

</table>