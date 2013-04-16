<?php /* Smarty version 2.6.22, created on 2012-10-20 12:40:22
         compiled from administration/newReport.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'popup', 'administration/newReport.tpl', 8, false),)), $this); ?>
<form action="index.php?page=<?php echo $this->_tpl_vars['currentPage']; ?>
&action=addReport" method="POST">
<table class="edit">
	<tr>
		<th width="30%">
			Bericht hinzuf&uuml;gen
		</th>
		<th width="70%" style="text-align: right;">
			<a <?php echo smarty_function_popup(array('caption' => "zurück",'text' => "Zurück zur Übersicht"), $this);?>
 href="index.php?page=<?php echo $this->_tpl_vars['currentPage']; ?>
&action=report"><img src="<?php echo $this->_tpl_vars['templateDir']; ?>
/images/icons/cross.png" alt="zur&uuml;ck"></a>
		</th>
	</tr>
	<tr>
		<td width="30%">Titel</td>
		<td width="70%"><input class="textinput" type="text" name="title""></td>
	</tr>
	<tr>
		<td width="30%">Query</td>
		<td width="70%">
			<textarea name="query" rows="20" cols="40"></textarea>
			</td>
	</tr>

	<td>
		<td colspan="2">
			<input type="submit" name="doNew" value="eintragen">
		</td>
	</tr>

</table>
</form>