<?php /* Smarty version 2.6.22, created on 2012-08-19 21:03:17
         compiled from report/report.tpl */ ?>
<h1>
	<?php echo $this->_tpl_vars['reportTitle']; ?>

</h1>

<?php if ($this->_tpl_vars['subContent1']): ?> 
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => $this->_tpl_vars['subContent1'], 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php endif; ?>
