<?php /* Smarty version 2.6.22, created on 2012-08-23 16:19:31
         compiled from plugins/persondata/new.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'eval', 'plugins/persondata/new.tpl', 1, false),array('function', 'html_select_date', 'plugins/persondata/new.tpl', 41, false),)), $this); ?>
<form action="<?php echo smarty_function_eval(array('var' => $this->_tpl_vars['formURL']), $this);?>
" method="POST">
<table width="100%">
	<tr>
		<td width="30%">Vorname</td>
		<td width="70%"><input class="textinput" type="text" name="prename"></td>
	</tr>
	<tr>
		<td width="30%">Name</td>
		<td width="70%"><input class="textinput" type="text" name="name"></td>
	</tr>
	<tr>
		<td width="30%">Adresse</td>
		<td width="70%"><input class="textinput" type="text" name="address"></td>
	</tr>
	<tr>
		<td width="30%">PLZ</td>
		<td width="70%"><input class="textinput" type="text" name="plz"></td>
	</tr>
	<tr>
		<td width="30%">Ort</td>
		<td width="70%"><input class="textinput" type="text" name="ort"></td>
	</tr>
	<tr>
		<td width="30%">Telefon</td>
		<td width="70%"><input class="textinput" type="text" name="phone"></td>
	</tr>
	<tr>
		<td width="30%">Mobile</td>
		<td width="70%"><input class="textinput" type="text" name="mobile"></td>
	</tr>
	<tr>
		<td width="30%">E-Mail</td>
		<td width="70%"><input class="textinput" type="text" name="email"></td>
	</tr>
	<tr>
		<td width="30%">Schiedsrichter ID (wenn vorhanden)</td>
		<td width="70%"><input class="textinput" type="text" name="refid"></td>
	</tr>
	<tr>
		<td width="30%">Geburtstag</td>
		<td width="70%"><?php echo smarty_function_html_select_date(array('prefix' => 'birthday','start_year' => '1940','field_order' => 'DMY'), $this);?>

	</tr>
	<tr>
		<td width="30%">Geschlecht</td>
		<td width="70%">
			<select name="gender">
				<option value="m" >m</option>
				<option value="w" >w</option>
			</select>
		</td>
	</tr>
	<tr>
		<td width="30%"><b>Zus�tzliche Daten</td>
		<td width="70%" >&nbsp;</td>
	</tr>
	<td width="30%">Schreiber</td>
		<td width="70%">
				<input  class="textinput"type='checkbox' name='schreiber' value='1' checked="checked">
		</td>
	</tr>
	<tr>
		<td width="30%">SMS-Benachrichtigung <br />bei Schreibereinsatz</td>
		<td width="70%">
				<input  class="textinput"type='checkbox' name='sms' value='1' checked="checked">
		</td>
	</tr>
	<tr>
		<td width="30%"><b>Lizenz</b></td>
		<td width="70%">
		
			<select name="licence">
			<?php $_from = $this->_tpl_vars['licences']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['licence']):
?>
			
				<?php if ($this->_tpl_vars['licence']['id'] == 1): ?>
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
                        <textarea name="licence_comment" rows="10" cols="30"></textarea>
                </td>
        </tr>

	<tr>
		<td colspan="2">
			<input type="submit" name="doNew" value="eintragen">
		</td>
	</tr>

</table>
</form>