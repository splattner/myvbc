<?php /* Smarty version 2.6.22, created on 2012-08-26 11:44:55
         compiled from address/new.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'popup', 'address/new.tpl', 7, false),)), $this); ?>
<table class="edit">
	<tr>
		<th width="30%">
			Mitglied hinzuf&uuml;gen
		</th>
		<th width="70%" style="text-align: right;">
			<a <?php echo smarty_function_popup(array('caption' => "zur�ck",'text' => "Zur�ck zur �bersicht"), $this);?>
 href="index.php?page=<?php echo $this->_tpl_vars['currentPage']; ?>
&action=main"><img src="<?php echo $this->_tpl_vars['templateDir']; ?>
/images/icons/cross.png" alt="zur&uuml;ck"></a>
		</th>
	</tr>
	<tr>
		<td colspan="2"><?php echo $this->_tpl_vars['plugins']['persondata']; ?>
</td>
	</tr>

</table>