<?php /* Smarty version 2.6.22, created on 2012-05-23 23:51:05
         compiled from auth/createAccess.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'mailto', 'auth/createAccess.tpl', 27, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'messages/info.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<form action="index.php?page=<?php echo $this->_tpl_vars['currentPage']; ?>
&action=createAccess&step2" method="POST">
<table class="edit">
	<tr>
		<th width="30%">
			Zugang einrichten
		</th>
		<th width="70%" style="text-align: right;">
			<a href="index.php?page=<?php echo $this->_tpl_vars['currentPage']; ?>
&action=createAccess"><img src="<?php echo $this->_tpl_vars['templateDir']; ?>
/images/icons/cross.png"></a>
		</th>
	</tr>
	<tr>
		<td width="30%">
			Information
		</td>
		<td width="70%">
			<p>
				Ihr Passwort wird Ihnen per SMS oder E-Mail zugestellt. 
				Deshalb ist es wichtig, dass Ihre Angaben stimmen. <br/>
				Wenn keine Mobile-Nummer hinterlegt ist, wird Ihnen dass Passwort per E-Mail zugestellt.<br />
				Prüfen Sie deshalb bitte ob 1. Ihre Mobile Nummer simmt, wenn keine Mobile Nummer vorhanden ist,
				prüfen Sie bitte Ihre E-Mail Adresse.
			</p>
			<p>
				<b style="color: #FF0000;">Achtung:</b> Wenn die hier angezeigten Daten nicht stimmen, 
				müssen Sie dies zuerst per E-Mail an <?php echo smarty_function_mailto(array('address' => "myVBC@vbclangenthal.ch"), $this);?>
 melden, 
				damit die korrekte Adresse eingetragen werden kann!
				<br /> <br /><b>Erst danach kann Ihr Zugang erstellt werden!</b>
			</p>
		</td>
	</tr>
	<tr>
	<tr>
		<td width="30%">
			Mobile
		</td>
		<td width="70%">
			<?php echo $this->_tpl_vars['persons'][0]['mobile']; ?>

			<?php if (! $this->_tpl_vars['persons'][0]['mobile'] == ""): ?>
			<br /><b style="color: #FF0000;">Diese Nummer wird für den Passwort versand benutzt!</b>
			<?php endif; ?>
		</td>
	</tr>
		<td width="30%">
			E-Mail Adresse
		</td>
		<td width="70%">
			<?php echo $this->_tpl_vars['persons'][0]['email']; ?>

			<?php if ($this->_tpl_vars['persons'][0]['mobile'] == "" && $this->_tpl_vars['person'][0]['email'] != ""): ?>
			<br /><b style="color: #FF0000;">Diese E-Mail Adresse wird für den Passwort Versand benutzt!</b>
			<?php endif; ?>
		</td>
	</tr>
	<td>
		<td colspan="2">
			<?php if (( $this->_tpl_vars['persons'][0]['mobile'] != "" ) || ( $this->_tpl_vars['persons'][0]['email'] != "" )): ?>
				<input type="submit" name="doAdd" value="Zugang erstellen">
				<input type="hidden" name="personID" value="<?php echo $this->_tpl_vars['persons'][0]['id']; ?>
">
			<?php else: ?>
				<b style="color: #FF0000;">Keine Telefon Nummer und keine E-Mail Adresse vorhanden</b>
			<?php endif; ?>
		</td>
	</tr>

</table>
</form>