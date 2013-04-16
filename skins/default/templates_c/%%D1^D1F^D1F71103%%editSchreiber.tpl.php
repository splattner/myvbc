<?php /* Smarty version 2.6.22, created on 2012-09-13 16:48:49
         compiled from games/editSchreiber.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'popup', 'games/editSchreiber.tpl', 7, false),)), $this); ?>
<table class="edit">
	<tr>
		<th width="30%">
			Schreiber zu Spiel hinzuf&uuml;gen
		</th>
		<th width="70%" style="text-align: right">
			<a <?php echo smarty_function_popup(array('caption' => "zurück",'text' => "Zurück zur Übersicht"), $this);?>
 href="index.php?page=<?php echo $this->_tpl_vars['currentPage']; ?>
&action=main"><img src="<?php echo $this->_tpl_vars['templateDir']; ?>
/images/icons/cross.png" alt="zur&uuml;ck"></a>
		</th>
	</tr>
	<tr>
		<td width="30%">Spiel</td>
		<td width="70%"><?php echo $this->_tpl_vars['game'][0]['teamname']; ?>
 : <?php echo $this->_tpl_vars['game'][0]['gegner']; ?>
</td>
	</tr>
	<tr>
		<td width="30%">Datum / Zeit</td>
		<td width="70%"><?php echo $this->_tpl_vars['game'][0]['datum']; ?>
</td>
	</tr>
	<tr>
		<td width="30%">Ort / halle</td>
		<td width="70%"><?php echo $this->_tpl_vars['game'][0]['ort']; ?>
 - <?php echo $this->_tpl_vars['game'][0]['halle']; ?>
</td>
	</tr>
	<tr>
		<td width="30%">Schreiber</td>
		<td width="70%">
			<div id="schreiberlist">
				
			</div>
		</td>
	</tr>
	<tr>
		<td width="30%"></td>
		<td width="70%">
			<div id="schreiberinfo">
				<p>Bitte wählen Sie zuerst einen Schreiber aus, <br />anschliessend werden hier die Informationen angezeigt!</p>
			</div>
		</td>
	</tr>
	<tr>
		<td colspan="2"><hr /></td>
	</tr>
	<tr>
		<td colspan="2">
			<p>
				<b>Vorschläge</b>: Personen die an diesem Tag, aber nicht zur gleichen Zeit, Heimspiele haben
			</p>
			<ul style="list-style-image:url(<?php echo $this->_tpl_vars['templateDir']; ?>
/images/icons/bullet_green.png)">
			<?php if (! empty ( $this->_tpl_vars['proposals'] )): ?>
				<?php $_from = $this->_tpl_vars['proposals']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['proposal']):
?>
					<li><?php echo $this->_tpl_vars['proposal']['prename']; ?>
 <?php echo $this->_tpl_vars['proposal']['name']; ?>
, Schreibereinsätze: <?php echo $this->_tpl_vars['proposal']['anzahl']; ?>
 <br />
					 	<?php echo $this->_tpl_vars['proposal']['date']; ?>
, <?php echo $this->_tpl_vars['proposal']['ort']; ?>
 - <?php echo $this->_tpl_vars['proposal']['halle']; ?>
</li>
				<?php endforeach; endif; unset($_from); ?>
			<?php else: ?>
				<li>Keine Vorschläge, da keine anderen Heimspiele an diesem Tag</li>
			<?php endif; ?>
			</ul>
		</td>

</table>