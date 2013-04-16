{include file='messages/info.tpl'}
<form action="index.php?page={$currentPage}&action=editPassword" method="POST">
<table class="edit">
	<tr>
		<th width="30%">
			Mein Passwort ändern
		</th>
		<th width="70%" style="text-align: right;">
			<a {popup caption="zurück" text="Zurück zur Übersicht"} href="index.php?page=index&action=main"><img src="{$templateDir}/images/icons/cross.png"></a>
		</th>
	</tr>

	<tr>
		<td width="30%">Passwort</td>
		<td width="70%"><input type="password" name="password"></d>
	</tr>
	<tr>
		<td width="30%">Passwort bestätigen</td>
		<td width="70%"><input type="password" name="confirm"></d>
	</tr>
	
	<td>
		<td colspan="2">
			<input type="submit" name="doEdit" value="Passwort ändern">
		</td>
	</tr>

</table>
</form>