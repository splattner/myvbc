<?php /* Smarty version 2.6.22, created on 2012-08-19 20:54:48
         compiled from address/addressEntrys.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'popup', 'address/addressEntrys.tpl', 31, false),)), $this); ?>
<table class="wide">
<tr>
	<th width="2%">&nbsp;</th>
	<th width="10%">Vorname</th>
	<th width="10%">Name</th>
	<th width="21%">Adresse</th>
	<th width="12%">Telefon</th>
	<th width="12%">Mobile</th>
	<th width="23%">E-Mail</th>
	<th width="10%">&nbsp;</th>
</tr>
<?php $_from = $this->_tpl_vars['persons']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['person']):
?>
<tr>
	<td>
		<?php if ($this->_tpl_vars['person']['active'] == 1): ?>
			<img src="<?php echo $this->_tpl_vars['templateDir']; ?>
/images/icons/bullet_green.png">
		<?php else: ?>
			<img src="<?php echo $this->_tpl_vars['templateDir']; ?>
/images/icons/bullet_red.png">
		<?php endif; ?>
	</td>
	<td><?php echo $this->_tpl_vars['person']['prename']; ?>
</td>
	<td><?php echo $this->_tpl_vars['person']['name']; ?>
</td>
	<td>
		<?php echo $this->_tpl_vars['person']['address']; ?>
 <br />
		<?php echo $this->_tpl_vars['person']['plz']; ?>
 <?php echo $this->_tpl_vars['person']['ort']; ?>

	</td>
	<td><?php echo $this->_tpl_vars['person']['phone']; ?>
</td>
	<td><?php echo $this->_tpl_vars['person']['mobile']; ?>
</td>
	<td><?php echo $this->_tpl_vars['person']['email']; ?>
</td>
	<td align="right">
		<?php if ($this->_tpl_vars['person']['active'] == 1): ?><a class="icons" <?php echo smarty_function_popup(array('caption' => 'Teams','text' => $this->_tpl_vars['person']['liga']), $this);?>
><img src="<?php echo $this->_tpl_vars['templateDir']; ?>
/images/icons/group.png"</a><?php endif; ?>
		<a class="icons" href="index.php?page=<?php echo $this->_tpl_vars['currentPage']; ?>
&action=edit&personID=<?php echo $this->_tpl_vars['person']['id']; ?>
" <?php echo smarty_function_popup(array('caption' => 'bearbeiten','text' => 'Personendaten bearbeiten'), $this);?>
><img src="<?php echo $this->_tpl_vars['templateDir']; ?>
/images/icons/book_edit.png"></a>
		<a class="icons" onclick="return confirm('Willst du diesen Eintrag wirklich löschen?')" href="index.php?page=<?php echo $this->_tpl_vars['currentPage']; ?>
&action=delete&personID=<?php echo $this->_tpl_vars['person']['id']; ?>
" <?php echo smarty_function_popup(array('caption' => "löschen",'bgcolor' => "#FF0000",'text' => "Person aus System entfernen. Achtung: Dies geschieht sofort und kann nicht rückgängig gemacht werden"), $this);?>
><img src="<?php echo $this->_tpl_vars['templateDir']; ?>
/images/icons/book_delete.png" alt="Mitglied l&ouml;schen"></a>
	</td>
</tr>
<?php endforeach; endif; unset($_from); ?>
</table>