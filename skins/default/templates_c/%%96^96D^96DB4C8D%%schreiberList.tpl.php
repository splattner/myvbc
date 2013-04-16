<?php /* Smarty version 2.6.22, created on 2012-09-13 16:48:49
         compiled from games/schreiberList.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'popup', 'games/schreiberList.tpl', 6, false),)), $this); ?>
<table class="schreiber">
<?php $_from = $this->_tpl_vars['schreibers']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['schreiber']):
?>
<tr>
	<td><img src="<?php echo $this->_tpl_vars['templateDir']; ?>
/images/icons/bullet_green.png"></td>
	<td><?php echo $this->_tpl_vars['schreiber']['prename']; ?>
 <?php echo $this->_tpl_vars['schreiber']['name']; ?>
</td>
	<td><a href="#" <?php echo smarty_function_popup(array('caption' => 'entfernen','bgcolor' => "#FF0000",'text' => 'Diesen Schreiber vom Spiel entfernen'), $this);?>
 onClick="removeSchreiber(<?php echo $this->_tpl_vars['schreiber']['id']; ?>
,<?php echo $this->_tpl_vars['gameID']; ?>
,<?php echo $this->_tpl_vars['teamID']; ?>
)" ><img src="<?php echo $this->_tpl_vars['templateDir']; ?>
/images/icons/delete.png"></a></td>
</tr>
<?php endforeach; endif; unset($_from); ?>
<tr>
	<td><img src="<?php echo $this->_tpl_vars['templateDir']; ?>
/images/icons/bullet_red.png"></td>
	<td>
		<select onchange="getSchreiberInfo(this.value, <?php echo $this->_tpl_vars['gameID']; ?>
);" id="personid">
			<option value="0"></option>
			<?php $_from = $this->_tpl_vars['all_schreibers']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['all_schreiber']):
?>
				<option value="<?php echo $this->_tpl_vars['all_schreiber']['id']; ?>
"><?php echo $this->_tpl_vars['all_schreiber']['prename']; ?>
 <?php echo $this->_tpl_vars['all_schreiber']['name']; ?>
</option>
			<?php endforeach; endif; unset($_from); ?>
		</select>
	</td>
	<td>
		<a href="#" <?php echo smarty_function_popup(array('caption' => "hinzufügen",'text' => "Diesen Schreiber dem Spiel hinzufügen"), $this);?>
 onClick="addSchreiber(<?php echo $this->_tpl_vars['gameID']; ?>
, <?php echo $this->_tpl_vars['teamID']; ?>
)"><img src="<?php echo $this->_tpl_vars['templateDir']; ?>
/images/icons/add.png"></a>
	</td>
</table>