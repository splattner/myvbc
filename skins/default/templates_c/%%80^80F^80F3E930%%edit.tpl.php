<?php /* Smarty version 2.6.22, created on 2012-10-07 16:05:37
         compiled from games/edit.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'popup', 'games/edit.tpl', 9, false),array('function', 'html_select_date', 'games/edit.tpl', 19, false),array('function', 'html_select_time', 'games/edit.tpl', 20, false),)), $this); ?>
<?php $_from = $this->_tpl_vars['games']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['game']):
?>
<form action="index.php?page=<?php echo $this->_tpl_vars['currentPage']; ?>
&action=edit&gameID=<?php echo $this->_tpl_vars['game']['id']; ?>
" method="POST">
<table class="edit">
	<tr>
		<th width="30%">
			Spiel bearbeiten
		</th>
		<th width="70%" style="text-align: right;">
			<a <?php echo smarty_function_popup(array('caption' => "zurück",'text' => "Zurück zur Übersicht"), $this);?>
 href="index.php?page=<?php echo $this->_tpl_vars['currentPage']; ?>
&action=main"><img src="<?php echo $this->_tpl_vars['templateDir']; ?>
/images/icons/cross.png" alt="zur&uuml;ck"></a>
		</th>
	</tr>
	<tr>
		<td width="30%">Externe ID</td>
		<td width="70%"><input class="textinput" type="text" name="extid" value="<?php echo $this->_tpl_vars['game']['extid']; ?>
"></td>
	</tr>
	<tr>
		<td width="30%">Datum / Zeit</td>
		<td width="70%">
			<?php echo smarty_function_html_select_date(array('prefix' => 'date','field_order' => 'DMY','time' => $this->_tpl_vars['game']['date'],'start_year' => "+0",'end_year' => "+1"), $this);?>

			<?php echo smarty_function_html_select_time(array('prefix' => 'time','use_24_hours' => true,'display_seconds' => false,'time' => $this->_tpl_vars['game']['date']), $this);?>

		</td>
	</tr>
	<tr>
		<td width="30%">Gegner</td>
		<td width="70%"><input class="textinput" type="text" name="gegner" value="<?php echo $this->_tpl_vars['game']['gegner']; ?>
"></td>
	</tr>
	<tr>
		<td width="30%">Ort</td>
		<td width="70%"><input class="textinput" type="text" name="ort" value="<?php echo $this->_tpl_vars['game']['ort']; ?>
"></td>
	</tr>
	<tr>
		<td width="30%">Halle</td>
		<td width="70%"><input class="textinput" type="text" name="halle" value="<?php echo $this->_tpl_vars['game']['halle']; ?>
"></td>
	</tr>
	<tr>
		<td width="30%">Heimspiel</td>
		<td>
			<?php if ($this->_tpl_vars['game']['heimspiel'] == 1): ?>
				<input type='checkbox' name='heimspiel' value='1' checked="checked">
			<?php else: ?>
				<input type='checkbox' name='heimspiel' value='1'>
			<?php endif; ?>
		</td>
	</tr>
	<tr>
		<td colspan="2">
			<input type="submit" name="doEdit" value="bearbeiten">
		</td>
	</tr>

</table>
</form>
<?php endforeach; endif; unset($_from); ?>