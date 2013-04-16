<?php /* Smarty version 2.6.22, created on 2012-08-19 21:03:17
         compiled from report/overview.tpl */ ?>
<form action="index.php" method="GET">
<input type="hidden" name="page" value="<?php echo $this->_tpl_vars['currentPage']; ?>
" />
<input type="hidden" name="action" value="getReport" />
<p>
Bericht ausw&auml;hlen:
<select name="reportID">
	<?php $_from = $this->_tpl_vars['reports']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['report']):
?>
		<option value="<?php echo $this->_tpl_vars['report']['id']; ?>
"><?php echo $this->_tpl_vars['report']['title']; ?>
</option>
	<?php endforeach; endif; unset($_from); ?>
</select>
<input type="submit" value="anzeigen" />

</p>
</form>