<?php /* Smarty version 2.6.22, created on 2012-08-23 16:19:31
         compiled from myTeam/new.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'popup', 'myTeam/new.tpl', 7, false),)), $this); ?>
<table class="edit">
	<tr>
		<th width="30%">
			Mitglied hinzuf&uuml;gen
		</th>
		<th width="70%" style="text-align: right;">
			<a <?php echo smarty_function_popup(array('caption' => "zurück",'text' => "Zurück"), $this);?>
 href="index.php?page=<?php echo $this->_tpl_vars['currentPage']; ?>
&action=addMember&teamID=<?php echo $this->_tpl_vars['teamID']; ?>
"><img src="<?php echo $this->_tpl_vars['templateDir']; ?>
/images/icons/cross.png"></a>
		</th>
	</tr>
	<tr>
		<td colspan="2"><?php echo $this->_tpl_vars['plugins']['persondata']; ?>
</td>
	</tr>

</table>
