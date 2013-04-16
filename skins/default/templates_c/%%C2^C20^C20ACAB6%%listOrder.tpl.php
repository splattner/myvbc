<?php /* Smarty version 2.6.22, created on 2012-08-19 21:01:25
         compiled from order/listOrder.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'popup', 'order/listOrder.tpl', 11, false),array('modifier', 'date_format', 'order/listOrder.tpl', 16, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'messages/info.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php $_from = $this->_tpl_vars['orders']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['order']):
?>
<form action="index.php?page=<?php echo $this->_tpl_vars['currentPage']; ?>
&action=editorder&orderID=<?php echo $this->_tpl_vars['order']['id']; ?>
" method="POST">
<table class="edit">
	<tr>
		<th width="30%">
			Bestellung bearbeiten
		</th>
		<th width="70%" style="text-align: right;">
			<a <?php echo smarty_function_popup(array('caption' => "zurück",'text' => "Zurück zur Übersicht"), $this);?>
 href="index.php?page=<?php echo $this->_tpl_vars['currentPage']; ?>
&action=main"><img src="<?php echo $this->_tpl_vars['templateDir']; ?>
/images/icons/cross.png" ></a>
		</th>
	</tr>
	<tr>
		<td width="30%">Erstelldatum</td>
		<td width="70%"><?php echo ((is_array($_tmp=$this->_tpl_vars['order']['createdate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%a, %d %B %y - %H:%M") : smarty_modifier_date_format($_tmp, "%a, %d %B %y - %H:%M")); ?>
</td>
	</tr>
		<tr>
		<td width="30%">Letze Status Änderung</td>
		<td width="70%"><?php echo ((is_array($_tmp=$this->_tpl_vars['order']['lastupdate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%a, %d %B %y - %H:%M") : smarty_modifier_date_format($_tmp, "%a, %d %B %y - %H:%M")); ?>
</td>
	</tr>
	<tr>
		<td width="30%">Status</td>
		<td width="70%">
			<?php if ($this->_tpl_vars['allowedit']): ?>
				<select name="statusID">
					<option value="0"></option>
					<?php $_from = $this->_tpl_vars['statuslist']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['status']):
?>
					<option <?php if ($this->_tpl_vars['order']['status'] == $this->_tpl_vars['status']['id']): ?> selected="selected" <?php endif; ?> value="<?php echo $this->_tpl_vars['status']['id']; ?>
"><?php echo $this->_tpl_vars['status']['description']; ?>
</option>
					<?php endforeach; endif; unset($_from); ?>
				</select>
			<?php else: ?>
				<?php echo $this->_tpl_vars['order']['statustext']; ?>
&nbsp;
				<?php if (( $this->_tpl_vars['order']['owner'] == $this->_tpl_vars['uid'] && $this->_tpl_vars['order']['status'] == 1 )): ?>
					<a <?php echo smarty_function_popup(array('caption' => 'Bestellung abschliessen','text' => "Sobald sie die Bestellung schliessen, wird der Bestellvorgang eingeleitet. Achtung: Danach können sie an dieser Bestellung nichts mehr ändern!"), $this);?>
 href="index.php?page=<?php echo $this->_tpl_vars['currentPage']; ?>
&action=closeOrder&orderID=<?php echo $this->_tpl_vars['order']['id']; ?>
">
						<img src="<?php echo $this->_tpl_vars['templateDir']; ?>
/images/icons/accept.png" > Bestellung abschliessen
					</a>
				<?php endif; ?>
			<?php endif; ?>
			
		</td>
	</tr>
	<tr>
		<td width="30%">Bemerkung zur Bestellung</td>
		<td width="70%">
			<?php if (( ( $this->_tpl_vars['allowedit'] && $this->_tpl_vars['order']['status'] != 4 ) || ( $this->_tpl_vars['order']['owner'] == $this->_tpl_vars['uid'] && $this->_tpl_vars['order']['status'] == 1 ) )): ?>
				<textarea name="comment" cols="40" rows="6"><?php echo $this->_tpl_vars['order']['comment']; ?>
</textarea>
			<?php else: ?>
				<?php echo $this->_tpl_vars['order']['comment']; ?>

			<?php endif; ?>
			</td>
	</tr>
	
	<tr>
		<td colspan="2">
		<?php if (( $this->_tpl_vars['allowedit'] || ( $this->_tpl_vars['order']['owner'] == $this->_tpl_vars['uid'] && $this->_tpl_vars['order']['status'] == 1 ) )): ?>
			<input type="submit" name="doEdit" value="bearbeiten">
		<?php else: ?>
			<p class="hightlight" >Bearbeiten ist nicht mehr möglich, der Bestellvorgang wurde bereits ausgelöst, oder das ist nich deine Bestellung <br />
			Wenn etwas nicht in Ordnung ist, melde dich beim Chef-TK!</p>
		<?php endif; ?>
		</td>
	</tr>

</table>
</form>


<p class="submenu">
	<?php if (( $this->_tpl_vars['allowedit'] && $this->_tpl_vars['order']['status'] != 4 ) || $this->_tpl_vars['order']['status'] == 1): ?>
	<a onClick="showaddLicenceForm(<?php echo $this->_tpl_vars['orderID']; ?>
)" <?php echo smarty_function_popup(array('caption' => 'neue Lizenz','text' => "Neue Lizenz zu dieser Bestellung hinzufügen"), $this);?>
 href="#"><img src="<?php echo $this->_tpl_vars['templateDir']; ?>
/images/icons/basket_put.png"></a>
	<?php endif; ?>
</p>

<div id="orderitems">
<table class="wide">
<tr>
	<th width="2%">&nbsp;</th>
	<th width="25%">Person</th>
	<th width="25%">Lizenz</th>
	<th width="38%">Kommentar</th>
	<th width="10%">&nbsp;</th>
</tr>
</table>
</div>

<div id="orderitemsnew"></div>
<?php endforeach; endif; unset($_from); ?>
