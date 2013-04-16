<?php /* Smarty version 2.6.22, created on 2012-08-26 11:53:43
         compiled from games/import.tpl */ ?>
<p>
	<a href="index.php?page=<?php echo $this->_tpl_vars['currentPage']; ?>
&action=main"><img src="<?php echo $this->_tpl_vars['templateDir']; ?>
/images/icons/cross.png" alt="zur&uuml;ck"></a>
</p>

<h3>Spiele importieren</h3>
<p>
Team ausw&auml;hlen:
<select onchange="getGamesToImport(this.value);" name="teamid">
	<option value="0">(Bitte ausw&auml;hlen)</option>
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
<a href="#" onClick='importGames()'><img src="<?php echo $this->_tpl_vars['templateDir']; ?>
/images/icons/add.png"></a>
</p>

<table class="legend">
<tr>
	<td>
		<img src="<?php echo $this->_tpl_vars['templateDir']; ?>
/images/icons/bullet_green.png"> Spiel lokal in Datenbank <br />
		<img src="<?php echo $this->_tpl_vars['templateDir']; ?>
/images/icons/bullet_orange.png"> Spiel lokal in Datenbank nicht aktuell<br />
		<img src="<?php echo $this->_tpl_vars['templateDir']; ?>
/images/icons/bullet_red.png"> Spiel nicht lokal in Datenbank<br />
	</td>
</tr>
</table>

<div id="importEntrys">
<table class="wide">
<tr>
	<th>&nbsp;</th>
	<th>Datum / Zeit</th>
	<th>Team</th>
	<th>Gegner</th>
	<th>Ort</th>
	<th>&nbsp;</th>
</tr>
</table>
</div>