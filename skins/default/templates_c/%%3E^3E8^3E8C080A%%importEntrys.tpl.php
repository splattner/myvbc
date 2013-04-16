<?php /* Smarty version 2.6.22, created on 2012-08-26 11:53:44
         compiled from games/importEntrys.tpl */ ?>
<table class="wide">
<tr>
	<th>&nbsp;</th>
	<th>Datum / Zeit</th>
	<th>Begegnung</th>
	<th>Ort</th>
	<th>&nbsp;</th>
</tr>
<?php $_from = $this->_tpl_vars['games']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['game']):
?>
<tr>
	<td>
		<?php if ($this->_tpl_vars['game']['local'] == 1): ?>
			<img src="<?php echo $this->_tpl_vars['templateDir']; ?>
/images/icons/bullet_green.png">
		<?php elseif ($this->_tpl_vars['game']['local'] == 2): ?>
			<img src="<?php echo $this->_tpl_vars['templateDir']; ?>
/images/icons/bullet_orange.png">
		<?php else: ?>
			<img src="<?php echo $this->_tpl_vars['templateDir']; ?>
/images/icons/bullet_red.png">
		<?php endif; ?>
	<td>
		<?php echo $this->_tpl_vars['game']['datum']; ?>

	</td>
	<td>
		<?php echo $this->_tpl_vars['game']['heimteam']; ?>
 - <?php echo $this->_tpl_vars['game']['gastteam']; ?>

	</td>
	<td>
		<?php echo $this->_tpl_vars['game']['ort']; ?>
 / <?php echo $this->_tpl_vars['game']['halle']; ?>

	</td>

</tr>
<?php endforeach; endif; unset($_from); ?>
</table>