{include file='messages/info.tpl'}

<form action="index.php?page={$currentPage}&action=createAccess&step2" method="POST">
<table class="edit">
	<tr>
		<th width="30%">
			Zugang einrichten
		</th>
		<th width="70%" style="text-align: right;">
			<a href="index.php?page={$currentPage}&action=createAccess"><img src="{$templateDir}/images/icons/cross.png"></a>
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
				müssen Sie dies zuerst per E-Mail an {mailto address=myVBC@vbclangenthal.ch} melden, 
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
			{$persons[0].mobile}
			{if not $persons[0].mobile == ""}
			<br /><b style="color: #FF0000;">Diese Nummer wird für den Passwort versand benutzt!</b>
			{/if}
		</td>
	</tr>
		<td width="30%">
			E-Mail Adresse
		</td>
		<td width="70%">
			{$persons[0].email}
			{if $persons[0].mobile == "" && $person[0].email != ""}
			<br /><b style="color: #FF0000;">Diese E-Mail Adresse wird für den Passwort Versand benutzt!</b>
			{/if}
		</td>
	</tr>
	<td>
		<td colspan="2">
			{if ($persons[0].mobile != "") or ($persons[0].email != "")}
				<input type="submit" name="doAdd" value="Zugang erstellen">
				<input type="hidden" name="personID" value="{$persons[0].id}">
			{else}
				<b style="color: #FF0000;">Keine Telefon Nummer und keine E-Mail Adresse vorhanden</b>
			{/if}
		</td>
	</tr>

</table>
</form>