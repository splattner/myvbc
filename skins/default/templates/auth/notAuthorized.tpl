<table class="overview">

<tr>
	<td style="width: 200px; height: 200px;">
		<img src="{$templateDir}/images/enter.jpg">
	</td>
	<td style="text-align: center">
		<p>
			<b>Achtung:</b> {$msg}
		</p>
		{if not $isAuth}
		<p>
			Sie m&uuml;ssen sich zuerst anmelden.
		</p>
		<p class="indented">
			<a href="?page=auth"><img src="{$templateDir}/images/icons/key.png"></a>&nbsp;Mit E-Mail Adresse und Passwort anmelden
		</p>
			
		{else}
		<p>
			Sie haben nicht die ben&ouml;tigten Berechtigungen um diese Seite anzuzeigen
		</p>
		{/if}
	</td>

</tr>


</table>

