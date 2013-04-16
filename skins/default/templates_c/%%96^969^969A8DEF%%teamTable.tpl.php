<?php /* Smarty version 2.6.22, created on 2012-08-19 21:22:34
         compiled from team/teamTable.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'popup', 'team/teamTable.tpl', 2, false),)), $this); ?>
<p>
	<a <?php echo smarty_function_popup(array('caption' => 'Neues Team','text' => 'Neues Team in myVBC eintragen'), $this);?>
 href="index.php?page=<?php echo $this->_tpl_vars['currentPage']; ?>
&action=new"><img src="<?php echo $this->_tpl_vars['templateDir']; ?>
/images/icons/add.png"></a>
</p>

<table class="wide">
<tr>
	<th>Externer Namen</th>
	<th>Team</th>
	<th>Liga</th>
	<th>&nbsp;</th>
</tr>

<?php $_from = $this->_tpl_vars['teams']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['team']):
?>
<tr>
	<td><?php echo $this->_tpl_vars['team']['extname']; ?>
</td>
	<td><?php echo $this->_tpl_vars['team']['name']; ?>
</td>
	<td><?php echo $this->_tpl_vars['team']['liga']; ?>
</td>
	<td align="right">
		<a class="icons" <?php echo smarty_function_popup(array('caption' => 'bearbeiten','text' => 'Daten dieses Teams bearbeiten'), $this);?>
 href="index.php?page=<?php echo $this->_tpl_vars['currentPage']; ?>
&action=edit&teamID=<?php echo $this->_tpl_vars['team']['id']; ?>
"><img src="<?php echo $this->_tpl_vars['templateDir']; ?>
/images/icons/group_gear.png" alt="Team bearbeiten"></a>
		<a class="icons" <?php echo smarty_function_popup(array('caption' => 'Mitglieder bearbeiten','text' => "Personen, die diesem Team zugehören, bearbeiten"), $this);?>
 href="index.php?page=<?php echo $this->_tpl_vars['currentPage']; ?>
&action=member&teamID=<?php echo $this->_tpl_vars['team']['id']; ?>
"><img src="<?php echo $this->_tpl_vars['templateDir']; ?>
/images/icons/group_edit.png" alt="Mitglieder bearbeiten"></a>
		<a onclick="return confirm('Willst du diesen Eintrag wirklich löschen?')" class="icons" <?php echo smarty_function_popup(array('caption' => "löschen",'bgcolor' => "#FF0000",'text' => "Team aus System entfernen. Achtung: Dies geschieht sofort und kann nicht rückgängig gemacht werden"), $this);?>
 href="index.php?page=<?php echo $this->_tpl_vars['currentPage']; ?>
&action=delete&teamID=<?php echo $this->_tpl_vars['team']['id']; ?>
"><img src="<?php echo $this->_tpl_vars['templateDir']; ?>
/images/icons/group_delete.png" alt="Team l&ouml;schen"></a>
	</td>
</tr>
<?php endforeach; endif; unset($_from); ?>
</table>