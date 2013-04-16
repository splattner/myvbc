
<h3>Deine  Benachrichtigungen</h3>
<table class="wide">
<tr>
	<th>Nachrichten-Typ</th>
	<th>Inhalt</th>
	<th>Datum</th>
	<th>Auslöser</th>
	<th>&nbsp;</th>
</tr>

{foreach item=notification from=$notifications}
<tr>
	<td>{$notification.type}</td>
	<td>{$notification.message}</td>
	<td>{$notification.date|date_format:"%d.%m.%Y - %H:%M"}</td>
	<td>{$notification.prename} {$notification.name}</td>
	<td align="right">
		<a class="icons" {popup caption="Erledigt" text="Diese Nachricht als erledigt markieren. Nachricht wird anschliessend nicht mehr angezeigt"} href="index.php?page={$currentPage}&action=delete&notificationID={$notification.notificationID}"><img src="{$templateDir}/images/icons/note_delete.png" ></a>

	</td>
</tr>
{/foreach}
{if empty($notifications)}
<tr>
	<td colspan="5">
		<i>Keine neuen Benachrichtigungen vorhanden</i>
	</td>
</tr>
{/if}
</table>
