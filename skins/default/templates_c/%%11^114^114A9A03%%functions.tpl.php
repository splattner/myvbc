<?php /* Smarty version 2.6.22, created on 2012-09-01 14:24:10
         compiled from administration/functions.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'popup', 'administration/functions.tpl', 8, false),)), $this); ?>
<h3>Sonstige Funktionen</h3>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'messages/info.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<table class="legend">
<tr>
	<td>
		<a <?php echo smarty_function_popup(array('caption' => 'Status aktualisieren','text' => 'Aktiv Status alles Personen aktualisieren'), $this);?>
href="index.php?page=<?php echo $this->_tpl_vars['currentPage']; ?>
&action=updateStatus"><img src="<?php echo $this->_tpl_vars['templateDir']; ?>
/images/icons/control_play.png"> Aktiv Status aktualisieren</a> <br />
		<a <?php echo smarty_function_popup(array('caption' => "Passw&ouml;rter &Auml;ndern",'text' => "Passwort einer Person &Auml;ndern"), $this);?>
href="index.php?page=<?php echo $this->_tpl_vars['currentPage']; ?>
&action=changePassword"><img src="<?php echo $this->_tpl_vars['templateDir']; ?>
/images/icons/control_play.png"> Passw&ouml;rter &auml;ndern</a> <br />
		<a <?php echo smarty_function_popup(array('caption' => 'Spiele entfernen','text' => "Alle Spiele inkl. den dazugeh&ouml;rigen Schreibereinsätze entfernen"), $this);?>
 href="index.php?page=<?php echo $this->_tpl_vars['currentPage']; ?>
&action=clearGames"><img 
src="<?php echo $this->_tpl_vars['templateDir']; ?>
/images/icons/control_play.png"> Spiele entfernen</a> <br />
		<a <?php echo smarty_function_popup(array('caption' => 'ACL Settings','text' => 'Access Control Listen verwalten'), $this);?>
 href="index.php?page=<?php echo $this->_tpl_vars['currentPage']; ?>
&action=gacl"><img 
src="<?php echo $this->_tpl_vars['templateDir']; ?>
/images/icons/control_play.png"> ACL Settings</a> <br />

	</td>
</tr>
</table>