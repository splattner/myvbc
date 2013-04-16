<?php /* Smarty version 2.6.22, created on 2012-08-20 16:12:32
         compiled from myTeam/teamMember.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'popup', 'myTeam/teamMember.tpl', 2, false),array('function', 'mailto', 'myTeam/teamMember.tpl', 54, false),array('modifier', 'date_format', 'myTeam/teamMember.tpl', 53, false),array('modifier', 'count_characters', 'myTeam/teamMember.tpl', 54, false),)), $this); ?>
<p class="submenu">
	<a <?php echo smarty_function_popup(array('caption' => "zur&uuml;ck",'text' => "Zur&uuml;ck zur &Uuml;bersicht"), $this);?>
 href="index.php?page=index"><img src="<?php echo $this->_tpl_vars['templateDir']; ?>
/images/icons/cross.png"></a>
	<?php if ($this->_tpl_vars['canAddMember']): ?>
	<a <?php echo smarty_function_popup(array('caption' => "hinzuf&uuml;gen",'text' => "Person dem Team hinzuf&uuml;gen"), $this);?>
 href="index.php?page=<?php echo $this->_tpl_vars['currentPage']; ?>
&action=addMember&teamID=<?php echo $this->_tpl_vars['teamID']; ?>
"><img src="<?php echo $this->_tpl_vars['templateDir']; ?>
/images/icons/add.png"></a>
	<?php endif; ?>
	<a href="#" onClick='window.print()' <?php echo smarty_function_popup(array('caption' => 'Drucken','text' => 'Diese Liste drucken'), $this);?>
><img src="<?php echo $this->_tpl_vars['templateDir']; ?>
/images/icons/printer.png"></a>
</p>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'messages/info.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<h2><?php echo $this->_tpl_vars['teamName']; ?>
</h2>

<table class="legend">
<tr>
	<td>
		<img src="<?php echo $this->_tpl_vars['templateDir']; ?>
/images/icons/bullet_green.png"> Spieler <br />
		<img src="<?php echo $this->_tpl_vars['templateDir']; ?>
/images/icons/bullet_yellow.png"> Captain / Teamverantwortlicher <br />
		<img src="<?php echo $this->_tpl_vars['templateDir']; ?>
/images/icons/bullet_red.png"> Trainer <br />
		<img src="<?php echo $this->_tpl_vars['templateDir']; ?>
/images/icons/bullet_blue.png"> Sonstige Funktion <br />
	</td>
</tr>
</table>

<table class="wide">
<tr>
	<th>&nbsp;</th>
	<th>Name</th>
	<th>Adresse</th>
	<th>Kontakt-Daten</th>
	<th>Geburtstag</th>
	<th>E-Mail</th>
	<th>&nbsp;</th>
</tr>

<?php $_from = $this->_tpl_vars['persons']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['person']):
?>
<tr>
	<td>
		<?php if ($this->_tpl_vars['person']['typ'] == 1): ?><img src="<?php echo $this->_tpl_vars['templateDir']; ?>
/images/icons/bullet_green.png"><?php endif; ?>
		<?php if ($this->_tpl_vars['person']['typ'] == 2): ?><img src="<?php echo $this->_tpl_vars['templateDir']; ?>
/images/icons/bullet_yellow.png"><?php endif; ?>
		<?php if ($this->_tpl_vars['person']['typ'] == 3): ?><img src="<?php echo $this->_tpl_vars['templateDir']; ?>
/images/icons/bullet_red.png"><?php endif; ?>
		<?php if ($this->_tpl_vars['person']['typ'] == 4): ?><img src="<?php echo $this->_tpl_vars['templateDir']; ?>
/images/icons/bullet_blue.png"><?php endif; ?>
	</td>
	<td>
		<?php echo $this->_tpl_vars['person']['prename']; ?>
 <?php echo $this->_tpl_vars['person']['name']; ?>

	</td>
	<td><?php echo $this->_tpl_vars['person']['address']; ?>
<br />
		<?php echo $this->_tpl_vars['person']['plz']; ?>
 <?php echo $this->_tpl_vars['person']['ort']; ?>
 <br />
	</td>
	<td>
		Telefon: <?php echo $this->_tpl_vars['person']['phone']; ?>
 <br />
		Mobile: <?php echo $this->_tpl_vars['person']['mobile']; ?>

	</td>
	<td><?php echo ((is_array($_tmp=$this->_tpl_vars['person']['birthday'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>
</td>
	<td><?php if (((is_array($_tmp=$this->_tpl_vars['person']['email'])) ? $this->_run_mod_handler('count_characters', true, $_tmp) : smarty_modifier_count_characters($_tmp)) > 0): ?> <?php echo smarty_function_mailto(array('address' => $this->_tpl_vars['person']['email']), $this);?>
<?php else: ?>Keine E-Mail Adresse<?php endif; ?></td>
	<td align="right">
		<?php if ($this->_tpl_vars['canEditMember']): ?>
		<a class="icons" <?php echo smarty_function_popup(array('caption' => 'bearbeiten','text' => 'Daten dieser Person bearbeiten'), $this);?>
 href="index.php?page=<?php echo $this->_tpl_vars['currentPage']; ?>
&action=edit&teamID=<?php echo $this->_tpl_vars['person']['teamID']; ?>
&personID=<?php echo $this->_tpl_vars['person']['personID']; ?>
"><img src="<?php echo $this->_tpl_vars['templateDir']; ?>
/images/icons/group_edit.png"></a>
		<?php endif; ?>
		<?php if ($this->_tpl_vars['canDeleteMember']): ?>
		<a onclick="return confirm('Willst du diesen Eintrag wirklich l�schen?')" class="icons" <?php echo smarty_function_popup(array('caption' => 'entfernen','bgcolor' => "#FF0000",'text' => 'Diese Person aus dem Team entfernen'), $this);?>
 href="index.php?page=<?php echo $this->_tpl_vars['currentPage']; ?>
&action=deleteMember&teamID=<?php echo $this->_tpl_vars['person']['teamID']; ?>
&personID=<?php echo $this->_tpl_vars['person']['personID']; ?>
"><img src="<?php echo $this->_tpl_vars['templateDir']; ?>
/images/icons/group_delete.png"></a>
		<?php endif; ?>

	</td>
</tr>
<?php endforeach; endif; unset($_from); ?>
</table>