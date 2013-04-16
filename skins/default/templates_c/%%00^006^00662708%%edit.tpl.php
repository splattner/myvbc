<?php /* Smarty version 2.6.22, created on 2012-08-21 00:12:45
         compiled from myTeam/edit.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'popup', 'myTeam/edit.tpl', 7, false),)), $this); ?>
<table class="edit">
	<tr>
		<th width="30%">
			Mitglied bearbeiten
		</th>
		<th width="70%" style="text-align: right;">
			<a <?php echo smarty_function_popup(array('caption' => "zurück",'text' => "Zurück zur Übersicht"), $this);?>
 href="index.php?page=<?php echo $this->_tpl_vars['currentPage']; ?>
&action=main&teamID=<?php echo $this->_tpl_vars['teamID']; ?>
"><img src="<?php echo $this->_tpl_vars['templateDir']; ?>
/images/icons/cross.png" alt="zur&uuml;ck"></a>
		</th>
	</tr>
	<tr>
		<td colspan="2"><?php echo $this->_tpl_vars['plugins']['persondata']; ?>
</td>
	</tr>

</table>

<?php echo $this->_tpl_vars['plugins']['history']; ?>
