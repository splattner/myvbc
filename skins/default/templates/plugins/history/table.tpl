<h2>History</h2>

<table class="wide">
<tr>
	<th width="20%">Nachricht Typ</th>
	<th width="50%">Inhalt</th>
	<th width="20%">Datum</th>
	<th width="30%">Auslöser</th>
</tr>
{foreach item=notification from=$notifications}
<tr>
	<td>{$notification.type}</td>
	<td>{$notification.message}</td>
	<td>{$notification.date|date_format:"%d.%m.%Y - %H:%M"}</td>
	<td>{$notification.prename} {$notification.name}</td>
</tr>
{/foreach}

{if empty($notifications)}
<tr>
	<td colspan="4">
		<i>Keine History vorhanden</i>
	</td>
</tr>
{/if}

</table>

<h2>Lizenzbestellungen</h2>

<table class="wide">
<tr>
	<th width="20%">Bestelldatum</th>
	<th width="20%">Bestelstatus</th>
	<th width="20%">Lizenz</th>
	<th width="40">Kommentar zur Bestellung</th>
</tr>
{foreach item=myorder from=$myorders}
<tr>
	<td>{$myorder.date}</td>
	<td>{$myorder.status}</td>
	<td>{$myorder.licence}</td>
	<td>{$myorder.order_comment}</td>
</tr>
{/foreach}

{if empty($myorders)}
<tr>
	<td colspan="4">
		<i>Keine Lizenzbestellungen vorhanden</i>
	</td>
</tr>
{/if}

</table>
