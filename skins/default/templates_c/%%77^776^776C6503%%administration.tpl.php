<?php /* Smarty version 2.6.22, created on 2012-08-19 20:53:29
         compiled from administration/administration.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'popup', 'administration/administration.tpl', 5, false),)), $this); ?>
<h1>
	Administration
</h1>
<p>
	<a <?php echo smarty_function_popup(array('caption' => 'Zugangsberechtigung','text' => 'Zugangsberechtigun zum System verwalten'), $this);?>
 href="index.php?page=<?php echo $this->_tpl_vars['currentPage']; ?>
&action=access"><img src="<?php echo $this->_tpl_vars['templateDir']; ?>
/images/icons/key.png"></a>
	<a <?php echo smarty_function_popup(array('caption' => 'Berichte','text' => 'Berichte verwalten'), $this);?>
 href="index.php?page=<?php echo $this->_tpl_vars['currentPage']; ?>
&action=report"><img src="<?php echo $this->_tpl_vars['templateDir']; ?>
/images/icons/report.png"></a>
	<a <?php echo smarty_function_popup(array('caption' => 'Benachrichtigungen','text' => 'Benachrichtigungs Subscriptions verwalten'), $this);?>
 href="index.php?page=<?php echo $this->_tpl_vars['currentPage']; ?>
&action=notifications"><img src="<?php echo $this->_tpl_vars['templateDir']; ?>
/images/icons/note.png"></a>
	<a <?php echo smarty_function_popup(array('caption' => 'Sonstiges','text' => 'Sonstige Funktionen'), $this);?>
 href="index.php?page=<?php echo $this->_tpl_vars['currentPage']; ?>
&action=functions"><img src="<?php echo $this->_tpl_vars['templateDir']; ?>
/images/icons/computer.png"></a>
	<a <?php echo smarty_function_popup(array('caption' => 'Workflows','text' => 'Workflows'), $this);?>
 href="index.php?page=<?php echo $this->_tpl_vars['currentPage']; ?>
&action=workflow"><img src="<?php echo $this->_tpl_vars['templateDir']; ?>
/images/icons/cog.png"></a>
</p>


<?php if ($this->_tpl_vars['subContent1']): ?> 
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => $this->_tpl_vars['subContent1'], 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php endif; ?>