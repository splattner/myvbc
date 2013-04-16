<h3>Sonstige Funktionen</h3>

{include file='messages/info.tpl'}

<table class="legend">
<tr>
	<td>
		<a {popup caption="Status aktualisieren" text="Aktiv Status alles Personen aktualisieren"}href="index.php?page={$currentPage}&action=updateStatus"><img src="{$templateDir}/images/icons/control_play.png"> Aktiv Status aktualisieren</a> <br />
		<a {popup caption="Passw&ouml;rter &Auml;ndern" text="Passwort einer Person &Auml;ndern"}href="index.php?page={$currentPage}&action=changePassword"><img src="{$templateDir}/images/icons/control_play.png"> Passw&ouml;rter &auml;ndern</a> <br />
		<a {popup caption="Spiele entfernen" text="Alle Spiele inkl. den dazugeh&ouml;rigen Schreibereinsätze entfernen"} href="index.php?page={$currentPage}&action=clearGames"><img 
src="{$templateDir}/images/icons/control_play.png"> Spiele entfernen</a> <br />
		<a {popup caption="ACL Settings" text="Access Control Listen verwalten"} href="index.php?page={$currentPage}&action=gacl"><img 
src="{$templateDir}/images/icons/control_play.png"> ACL Settings</a> <br />

	</td>
</tr>
</table>
