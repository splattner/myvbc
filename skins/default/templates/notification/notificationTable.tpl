
<h3>Deine  Benachrichtigungen</h3>
<table class="wide">
<tr>
	<th>Nachrichten-Typ</th>
	<th>Inhalt</th>
	<th>Datum</th>
	<th>Ausl&ouml;ser</th>
	<th>&nbsp;</th>
</tr>

{foreach item=notification from=$notifications}
<tr>
	<td>{$notification.type}</td>
	<td>{$notification.message}</td>
	<td>{$notification.date|date_format:"%d.%m.%Y - %H:%M"}</td>
	<td>{$notification.prename} {$notification.name}</td>
	<td align="right">
		<a class="icons" data-toggle="tooltip" data-placement="bottom" title="Nachricht löschen" href="index.php?page={$currentPage}&action=delete&notificationID={$notification.notificationID}"><i style="color: red;" class="fa fa-trash-o"></i></a>

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
