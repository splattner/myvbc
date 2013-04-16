<?php /* Smarty version 2.6.22, created on 2012-08-20 16:18:52
         compiled from games/gamesTable.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'popup', 'games/gamesTable.tpl', 2, false),)), $this); ?>
<p>
	<a <?php echo smarty_function_popup(array('caption' => 'Importieren','text' => 'Spiele aus einer externen Quelle importieren'), $this);?>
 href="index.php?page=<?php echo $this->_tpl_vars['currentPage']; ?>
&action=import"><img src="<?php echo $this->_tpl_vars['templateDir']; ?>
/images/icons/basket_put.png" alt="Daten importieren"></a>
</p>

<p>
Team ausw&auml;hlen:
<select onchange='getGames(this.value);' name="teamid">
	<option value="0">Alle Spiele</option>
	<?php $_from = $this->_tpl_vars['teams']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['team']):
?>
		<?php if ($this->_tpl_vars['share']['teamID'] == $this->_tpl_vars['team']['id']): ?>
			<option selected="selected" value="<?php echo $this->_tpl_vars['team']['id']; ?>
"><?php echo $this->_tpl_vars['team']['name']; ?>
</option>
		<?php else: ?>
			<option value="<?php echo $this->_tpl_vars['team']['id']; ?>
"><?php echo $this->_tpl_vars['team']['name']; ?>
</option>
		<?php endif; ?>
	<?php endforeach; endif; unset($_from); ?>
</select>
</p>

<div id="gameEntrys">
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
</table>
</div>