<?php /* Smarty version 2.6.22, created on 2012-08-19 20:20:39
         compiled from index/mySchreiber.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'index/mySchreiber.tpl', 11, false),)), $this); ?>
<?php if (! empty ( $this->_tpl_vars['mySchreibers'] )): ?>
<table class="overview">
	<tr>
		<th colspan="4">
			Meine Schreibereinsätze
		</th>
	</tr>
	<?php $_from = $this->_tpl_vars['mySchreibers']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['mySchreiber']):
?>
		<tr>
			<td>
				<?php if (( ((is_array($_tmp=$this->_tpl_vars['mySchreiber']['date'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d") : smarty_modifier_date_format($_tmp, "%d")) < ((is_array($_tmp=time())) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d") : smarty_modifier_date_format($_tmp, "%d")) && ((is_array($_tmp=$this->_tpl_vars['mySchreiber']['date'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%m") : smarty_modifier_date_format($_tmp, "%m")) == ((is_array($_tmp=time())) ? $this->_run_mod_handler('date_format', true, $_tmp, "%m") : smarty_modifier_date_format($_tmp, "%m")) && ((is_array($_tmp=$this->_tpl_vars['mySchreiber']['date'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%Y") : smarty_modifier_date_format($_tmp, "%Y")) == ((is_array($_tmp=time())) ? $this->_run_mod_handler('date_format', true, $_tmp, "%Y") : smarty_modifier_date_format($_tmp, "%Y")) ) || ( ((is_array($_tmp=$this->_tpl_vars['mySchreiber']['date'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%m") : smarty_modifier_date_format($_tmp, "%m")) < ((is_array($_tmp=time())) ? $this->_run_mod_handler('date_format', true, $_tmp, "%m") : smarty_modifier_date_format($_tmp, "%m")) && ((is_array($_tmp=$this->_tpl_vars['mySchreiber']['date'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%Y") : smarty_modifier_date_format($_tmp, "%Y")) <= ((is_array($_tmp=time())) ? $this->_run_mod_handler('date_format', true, $_tmp, "%Y") : smarty_modifier_date_format($_tmp, "%Y")) )): ?>
					<img src="<?php echo $this->_tpl_vars['templateDir']; ?>
/images/icons/bullet_red.png">
				<?php else: ?>
					<img src="<?php echo $this->_tpl_vars['templateDir']; ?>
/images/icons/bullet_green.png">
				<?php endif; ?>				
			</td>
			<td><?php echo ((is_array($_tmp=$this->_tpl_vars['mySchreiber']['date'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%a, %d %B %y - %H:%M") : smarty_modifier_date_format($_tmp, "%a, %d %B %y - %H:%M")); ?>
</td>
			<td><?php echo $this->_tpl_vars['mySchreiber']['name']; ?>
 : <?php echo $this->_tpl_vars['mySchreiber']['gegner']; ?>
</td>
			<td><?php echo $this->_tpl_vars['mySchreiber']['ort']; ?>
 / <?php echo $this->_tpl_vars['mySchreiber']['halle']; ?>
</td>
		</tr>
	<?php endforeach; endif; unset($_from); ?>
</table>
<?php endif; ?>