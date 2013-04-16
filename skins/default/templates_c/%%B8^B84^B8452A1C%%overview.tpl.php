<?php /* Smarty version 2.6.22, created on 2012-08-19 20:53:28
         compiled from workflow/overview.tpl */ ?>
<table class="wide">
<tr>
	<th>Type</th>
	<th>Betrifft</th>
	<th>Ersteller</th>
	<th>Datum</th>
	<th>Status</th>
	<th>&nbsp;</th>
</tr>

<?php $_from = $this->_tpl_vars['workflows']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['workflow']):
?>
<tr>
	<td><?php echo $this->_tpl_vars['workflow']['type']; ?>
</td>
	<td><?php echo $this->_tpl_vars['workflow']['prename']; ?>
 <?php echo $this->_tpl_vars['workflow']['name']; ?>
</td>
	<td><?php echo $this->_tpl_vars['workflow']['creatorPrename']; ?>
 <?php echo $this->_tpl_vars['workflow']['creatorName']; ?>
</td>
	<td><?php echo $this->_tpl_vars['workflow']['date']; ?>
</td>
	<td><?php echo $this->_tpl_vars['workflow']['state']; ?>
</td>
	<td align="right">
	</td>
</tr>
<?php endforeach; endif; unset($_from); ?>
</table>