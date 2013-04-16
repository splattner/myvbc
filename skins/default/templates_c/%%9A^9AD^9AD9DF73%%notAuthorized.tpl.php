<?php /* Smarty version 2.6.22, created on 2012-08-23 09:57:02
         compiled from auth/notAuthorized.tpl */ ?>
<table class="overview">

<tr>
	<td style="width: 200px; height: 200px;">
		<img src="<?php echo $this->_tpl_vars['templateDir']; ?>
/images/enter.jpg">
	</td>
	<td style="text-align: center">
		<p>
			<b>Achtung:</b> <?php echo $this->_tpl_vars['msg']; ?>

		</p>
		<?php if (! $this->_tpl_vars['isAuth']): ?>
		<p>
			Sie m&uuml;ssen sich zuerst anmelden.
		</p>
		<p class="indented">
			<a href="?page=auth"><img src="<?php echo $this->_tpl_vars['templateDir']; ?>
/images/icons/key.png"></a>&nbsp;Mit E-Mail Adresse und Passwort anmelden
		</p>
			
		<?php else: ?>
		<p>
			Sie haben nicht die ben&ouml;tigten Berechtigungen um diese Seite anzuzeigen
		</p>
		<?php endif; ?>
	</td>

</tr>


</table>
