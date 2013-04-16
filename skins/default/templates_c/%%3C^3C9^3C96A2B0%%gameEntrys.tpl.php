<?php /* Smarty version 2.6.22, created on 2012-08-20 16:18:53
         compiled from games/gameEntrys.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'games/gameEntrys.tpl', 16, false),array('function', 'popup', 'games/gameEntrys.tpl', 39, false),)), $this); ?>
<table class="wide">
<tr>
	<th width="2%">&nbsp;</th>
	<th width="20%">Datum / Zeit</th>
	<th width="15%">Team</th>
	<th width="20%">Gegner</th>
	<th width="20%">Ort / Halle</th>
	<th width="13%">Schreiber</th>
	<th width="10%">&nbsp;</th>
</tr>


<?php $_from = $this->_tpl_vars['games']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['game']):
?>
<tr>
	<td>
		<?php if (( ((is_array($_tmp=$this->_tpl_vars['game']['date'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d") : smarty_modifier_date_format($_tmp, "%d")) < ((is_array($_tmp=time())) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d") : smarty_modifier_date_format($_tmp, "%d")) && ((is_array($_tmp=$this->_tpl_vars['game']['date'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%m") : smarty_modifier_date_format($_tmp, "%m")) <= ((is_array($_tmp=time())) ? $this->_run_mod_handler('date_format', true, $_tmp, "%m") : smarty_modifier_date_format($_tmp, "%m")) && ((is_array($_tmp=$this->_tpl_vars['game']['date'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%Y") : smarty_modifier_date_format($_tmp, "%Y")) <= ((is_array($_tmp=time())) ? $this->_run_mod_handler('date_format', true, $_tmp, "%Y") : smarty_modifier_date_format($_tmp, "%Y")) ) || ( ((is_array($_tmp=$this->_tpl_vars['game']['date'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%m") : smarty_modifier_date_format($_tmp, "%m")) < ((is_array($_tmp=time())) ? $this->_run_mod_handler('date_format', true, $_tmp, "%m") : smarty_modifier_date_format($_tmp, "%m")) && ((is_array($_tmp=$this->_tpl_vars['game']['date'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%Y") : smarty_modifier_date_format($_tmp, "%Y")) <= ((is_array($_tmp=time())) ? $this->_run_mod_handler('date_format', true, $_tmp, "%Y") : smarty_modifier_date_format($_tmp, "%Y")) ) || ( ((is_array($_tmp=$this->_tpl_vars['game']['date'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%Y") : smarty_modifier_date_format($_tmp, "%Y")) < ((is_array($_tmp=time())) ? $this->_run_mod_handler('date_format', true, $_tmp, "%Y") : smarty_modifier_date_format($_tmp, "%Y")) )): ?>
			<img src="<?php echo $this->_tpl_vars['templateDir']; ?>
/images/icons/bullet_red.png">
		<?php else: ?>
			<img src="<?php echo $this->_tpl_vars['templateDir']; ?>
/images/icons/bullet_green.png">
		<?php endif; ?>	
	</td>
	<td><?php echo ((is_array($_tmp=$this->_tpl_vars['game']['date'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%a, %d %B %y - %H:%M") : smarty_modifier_date_format($_tmp, "%a, %d %B %y - %H:%M")); ?>
</td>
	<td><?php echo $this->_tpl_vars['game']['name']; ?>
</td>
	<td><?php echo $this->_tpl_vars['game']['gegner']; ?>
</td>
	<td><?php echo $this->_tpl_vars['game']['ort']; ?>
 / <?php echo $this->_tpl_vars['game']['halle']; ?>
</td>
	<td>
		<?php if (! empty ( $this->_tpl_vars['game']['schreiber'] )): ?>
			<?php $_from = $this->_tpl_vars['game']['schreiber']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['schreiber']):
?>
			<?php echo $this->_tpl_vars['schreiber']['prename']; ?>
 <?php echo $this->_tpl_vars['schreiber']['name']; ?>
 <br />
			<?php endforeach; endif; unset($_from); ?>
		<?php elseif ($this->_tpl_vars['game']['heimspiel'] == 1): ?>
			<i>Keine Schreiber</i>
		<?php endif; ?>
	</td>
	<td align="right">
		<?php if ($this->_tpl_vars['game']['heimspiel'] == 1): ?>
			<a <?php echo smarty_function_popup(array('caption' => 'Schreiber','text' => "Schreiber für dieses Spiel verwalten"), $this);?>
href="index.php?page=<?php echo $this->_tpl_vars['currentPage']; ?>
&action=editSchreiber&gameID=<?php echo $this->_tpl_vars['game']['id']; ?>
"><img src="<?php echo $this->_tpl_vars['templateDir']; ?>
/images/icons/group.png" alt="Schreiber bearbeiten"></a>
		<?php endif; ?>
		<a <?php echo smarty_function_popup(array('caption' => 'bearbeiten','text' => 'Daten dieses Spiels bearbeiten'), $this);?>
 href="index.php?page=<?php echo $this->_tpl_vars['currentPage']; ?>
&action=edit&gameID=<?php echo $this->_tpl_vars['game']['id']; ?>
"><img src="<?php echo $this->_tpl_vars['templateDir']; ?>
/images/icons/page_edit.png" alt="Spiel bearbeiten"></a>
		<a onclick="return confirm('Willst du diesen Eintrag wirklich löschen?')" <?php echo smarty_function_popup(array('caption' => "löschen",'bgcolor' => "#FF0000",'text' => "Dieses Spiel aus myVBC löschen."), $this);?>
 href="index.php?page=<?php echo $this->_tpl_vars['currentPage']; ?>
&action=delete&gameID=<?php echo $this->_tpl_vars['game']['id']; ?>
"><img src="<?php echo $this->_tpl_vars['templateDir']; ?>
/images/icons/page_delete.png" alt="Spiel l&ouml;schen"></a>
	</td>
</tr>
<?php endforeach; endif; unset($_from); ?>
</table>