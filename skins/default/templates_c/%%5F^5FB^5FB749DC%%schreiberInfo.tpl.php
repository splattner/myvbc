<?php /* Smarty version 2.6.22, created on 2012-09-13 16:48:56
         compiled from games/schreiberInfo.tpl */ ?>
<p>
	Anzahl Schreibereinsätze: <?php echo $this->_tpl_vars['countSchreiber']; ?>

</p>

<?php if (! empty ( $this->_tpl_vars['games'] )): ?>
	<p>
		<b>Achtung:</b> Diese Person hat bereits selbst Spiele an diesem Tag:
	</p>
	
	<ul style="list-style-image:url(<?php echo $this->_tpl_vars['templateDir']; ?>
/images/icons/bullet_red.png)">
	<?php $_from = $this->_tpl_vars['games']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['game']):
?>
		<li><?php echo $this->_tpl_vars['game']['date']; ?>
, <?php echo $this->_tpl_vars['game']['ort']; ?>
 - <?php echo $this->_tpl_vars['game']['halle']; ?>
</li>
	<?php endforeach; endif; unset($_from); ?>
	</ul>
<?php else: ?>
	<p>Keine anderen Spiele an diesem Tag</p>
<?php endif; ?>