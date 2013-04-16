<?php /* Smarty version 2.6.22, created on 2012-08-19 20:20:39
         compiled from index/myTeams.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'replace', 'index/myTeams.tpl', 15, false),array('function', 'popup', 'index/myTeams.tpl', 18, false),)), $this); ?>
<table class="overview">
	<tr>
		<th colspan="3">
			Meine Teams
		</th>
	</tr>
	<tr>
	<?php $_from = $this->_tpl_vars['myTeams']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['myTeam']):
?>
		<tr>
			<td style="width: 20px";>
				<img src="<?php echo $this->_tpl_vars['templateDir']; ?>
/images/icons/bullet_green.png">
			</td>
			<td style="text-align: left;">
				<?php echo $this->_tpl_vars['myTeam']['name']; ?>

				als <?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['myTeam']['typ'])) ? $this->_run_mod_handler('replace', true, $_tmp, '1', 'Spieler') : smarty_modifier_replace($_tmp, '1', 'Spieler')))) ? $this->_run_mod_handler('replace', true, $_tmp, '2', "Captain / Teamverantwortlicher") : smarty_modifier_replace($_tmp, '2', "Captain / Teamverantwortlicher")))) ? $this->_run_mod_handler('replace', true, $_tmp, '3', 'Trainer') : smarty_modifier_replace($_tmp, '3', 'Trainer')))) ? $this->_run_mod_handler('replace', true, $_tmp, '4', 'Sonstige Funktion') : smarty_modifier_replace($_tmp, '4', 'Sonstige Funktion')); ?>

			</td>
			<td style="text-align: right;">
				<a href="index.php?page=myteam&action=main&teamID=<?php echo $this->_tpl_vars['myTeam']['id']; ?>
" <?php echo smarty_function_popup(array('caption' => 'Team Liste','text' => "Teamliste mit Kontaktdaten anzeigen. Captain/Teamverantwortliche und Trainer können hier Personen den Teams zuordnen"), $this);?>
><img src="<?php echo $this->_tpl_vars['templateDir']; ?>
/images/icons/group.png"></a>
			</td>
		</tr>
	<?php endforeach; endif; unset($_from); ?>
	</tr>
</table>