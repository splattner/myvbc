<?php /* Smarty version 2.6.22, created on 2012-08-19 20:20:39
         compiled from index/myGames.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'index/myGames.tpl', 10, false),)), $this); ?>
<table class="overview">
	<tr>
		<th colspan="6">
			Meine Spiele
		</th>
	</tr>
	<?php $_from = $this->_tpl_vars['myGames']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['myGame']):
?>
		<tr>
			<td>
				<?php if (( ((is_array($_tmp=$this->_tpl_vars['myGame']['date'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d") : smarty_modifier_date_format($_tmp, "%d")) < ((is_array($_tmp=time())) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d") : smarty_modifier_date_format($_tmp, "%d")) && ((is_array($_tmp=$this->_tpl_vars['myGame']['date'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%m") : smarty_modifier_date_format($_tmp, "%m")) <= ((is_array($_tmp=time())) ? $this->_run_mod_handler('date_format', true, $_tmp, "%m") : smarty_modifier_date_format($_tmp, "%m")) && ((is_array($_tmp=$this->_tpl_vars['myGame']['date'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%Y") : smarty_modifier_date_format($_tmp, "%Y")) <= ((is_array($_tmp=time())) ? $this->_run_mod_handler('date_format', true, $_tmp, "%Y") : smarty_modifier_date_format($_tmp, "%Y")) ) || ( ((is_array($_tmp=$this->_tpl_vars['myGame']['date'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%m") : smarty_modifier_date_format($_tmp, "%m")) < ((is_array($_tmp=time())) ? $this->_run_mod_handler('date_format', true, $_tmp, "%m") : smarty_modifier_date_format($_tmp, "%m")) && ((is_array($_tmp=$this->_tpl_vars['myGame']['date'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%Y") : smarty_modifier_date_format($_tmp, "%Y")) <= ((is_array($_tmp=time())) ? $this->_run_mod_handler('date_format', true, $_tmp, "%Y") : smarty_modifier_date_format($_tmp, "%Y")) ) || ( ((is_array($_tmp=$this->_tpl_vars['myGame']['date'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%Y") : smarty_modifier_date_format($_tmp, "%Y")) < ((is_array($_tmp=time())) ? $this->_run_mod_handler('date_format', true, $_tmp, "%Y") : smarty_modifier_date_format($_tmp, "%Y")) )): ?>
					<img src="<?php echo $this->_tpl_vars['templateDir']; ?>
/images/icons/bullet_red.png">
				<?php else: ?>
					<img src="<?php echo $this->_tpl_vars['templateDir']; ?>
/images/icons/bullet_green.png">
				<?php endif; ?>	
			</td>
			<td><?php echo ((is_array($_tmp=$this->_tpl_vars['myGame']['date'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%a, %d. %B %Y") : smarty_modifier_date_format($_tmp, "%a, %d. %B %Y")); ?>
</td>
			<td><?php echo ((is_array($_tmp=$this->_tpl_vars['myGame']['date'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%H:%M") : smarty_modifier_date_format($_tmp, "%H:%M")); ?>
</td>
			<td><?php echo $this->_tpl_vars['myGame']['name']; ?>
</td>
			<td><?php echo $this->_tpl_vars['myGame']['gegner']; ?>
</td>

			<td><?php echo $this->_tpl_vars['myGame']['ort']; ?>
 / <?php echo $this->_tpl_vars['myGame']['halle']; ?>
</td>
		</tr>
	<?php endforeach; endif; unset($_from); ?>
</table>