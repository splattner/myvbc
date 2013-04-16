<?php /* Smarty version 2.6.22, created on 2012-08-19 20:54:59
         compiled from plugins/persondata/edit.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'eval', 'plugins/persondata/edit.tpl', 1, false),array('function', 'html_select_date', 'plugins/persondata/edit.tpl', 41, false),)), $this); ?>
<form action="<?php echo smarty_function_eval(array('var' => $this->_tpl_vars['formURL']), $this);?>
" method="POST">
<table width="100%">
	<tr>
		<td width="30%">Vorname</td>
		<td width="70%"><input class="textinput" type="text" name="prename" value="<?php echo $this->_tpl_vars['person'][0]['prename']; ?>
"></td>
	</tr>
	<tr>
		<td width="30%">Name</td>
		<td width="70%"><input class="textinput" type="text" name="name" value="<?php echo $this->_tpl_vars['person'][0]['name']; ?>
"></td>
	</tr>
	<tr>
		<td width="30%">Adresse</td>
		<td width="70%"><input class="textinput" type="text" name="address" value="<?php echo $this->_tpl_vars['person'][0]['address']; ?>
"></td>
	</tr>
	<tr>
		<td width="30%">PLZ</td>
		<td width="70%"><input class="textinput" type="text" name="plz" value="<?php echo $this->_tpl_vars['person'][0]['plz']; ?>
"></td>
	</tr>
	<tr>
		<td width="30%">Ort</td>
		<td width="70%"><input class="textinput" type="text" name="ort" value="<?php echo $this->_tpl_vars['person'][0]['ort']; ?>
"></td>
	</tr>
	<tr>
		<td width="30%">Telefon</td>
		<td width="70%"><input class="textinput" type="text" name="phone" value="<?php echo $this->_tpl_vars['person'][0]['phone']; ?>
"></td>
	</tr>
	<tr>
		<td width="30%">Mobile</td>
		<td width="70%"><input class="textinput" type="text" name="mobile" value="<?php echo $this->_tpl_vars['person'][0]['mobile']; ?>
"></td>
	</tr>
	<tr>
		<td width="30%">E-Mail</td>
		<td width="70%"><input class="textinput" type="text" name="email" value="<?php echo $this->_tpl_vars['person'][0]['email']; ?>
"></td>
	</tr>
	<tr>
		<td width="30%">Schiedsrichter ID (wenn vorhanden)</td>
		<td width="70%"><input class="textinput" type="text" name="refid" value="<?php echo $this->_tpl_vars['person'][0]['refid']; ?>
"></td>
	</tr>
	<tr>
		<td width="30%">Geburtstag</td>
		<td width="70%"><?php echo smarty_function_html_select_date(array('prefix' => 'birthday','start_year' => '1940','field_order' => 'DMY','time' => $this->_tpl_vars['person'][0]['birthday']), $this);?>

	</tr>
	<tr>
		<td width="30%">Geschlecht</td>
		<td>
			<select name="gender">
			<?php if ($this->_tpl_vars['person'][0]['gender'] == 'm'): ?>
				<option value="m" selected="selected">m</option>
				<option value="w" >w</option>
			<?php else: ?>
				<option value="m" >m</option>
				<option value="w" selected="selected">w</option>
			<?php endif; ?>
			</select>
		</td>
	</tr>
	<tr>
		<td width="30%"><b>Zusätzliche Daten</td>
		<td width="70%" >&nbsp;</td>
	</tr>
	<tr>
		<td width="30%">Schreiber</td>
		<td>
			<?php if ($this->_tpl_vars['person'][0]['schreiber'] == 1): ?>
				<input type='checkbox' name='schreiber' value='1' checked="checked">
			<?php else: ?>
				<input type='checkbox' name='schreiber' value='1'>
			<?php endif; ?>
		</td>
	</tr>
	<tr>
		<td width="30%">SMS-Benachrichtigung <br />bei Schreibereinsatz</td>
		<td>
			<?php if ($this->_tpl_vars['person'][0]['sms'] == 1): ?>
				<input type='checkbox' name='sms' value='1' checked="checked">
			<?php else: ?>
				<input type='checkbox' name='sms' value='1'>
			<?php endif; ?>
		</td>
	</tr>
	<tr>
		<td width="30%"><b>Teams</b></td>
		<td width="70%">
			<p><?php if ($this->_tpl_vars['person'][0]['active'] == 1): ?><?php echo $this->_tpl_vars['person'][0]['liga']; ?>
<?php else: ?>Spieler ist nicht aktiv<?php endif; ?></p>
		</td>
	</tr>
	<tr>
		<td width="30%"><b>Lizenz</b></td>
		<td width="70%">
		
			<select name="licence">
			<?php $_from = $this->_tpl_vars['licences']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['licence']):
?>
			
				<?php if ($this->_tpl_vars['person'][0]['licence'] == $this->_tpl_vars['licence']['id']): ?>
					<option value="<?php echo $this->_tpl_vars['licence']['id']; ?>
" selected="selected"><?php echo $this->_tpl_vars['licence']['typ']; ?>
</option>
				<?php else: ?>
					<option value="<?php echo $this->_tpl_vars['licence']['id']; ?>
"><?php echo $this->_tpl_vars['licence']['typ']; ?>
</option>
				<?php endif; ?>
			
			<?php endforeach; endif; unset($_from); ?>
			
			</select>
		
		
		</td>
	</tr>
	<tr>
		<td width="30%"><b>Bemerkung zu Lizenz</b></td>
		<td width="30%">
			<textarea name="licence_comment" rows="10" cols="30"><?php echo $this->_tpl_vars['person'][0]['licence_comment']; ?>
</textarea>
		</td>
	</tr>
	<tr>
		<td colspan="2">
			<input type="submit" name="doEdit" value="bearbeiten">
		</td>
	</tr>
	

</table>
</form>