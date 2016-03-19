<h2>History</h2>

<table class="wide">
<tr>
	<th width="20%">Nachricht Typ</th>
	<th width="50%">Inhalt</th>
	<th width="20%">Datum</th>
	<th width="30%">Ausl&ouml;ser</th>
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

<table class="legend">
	<tr>
		<td>
			<img src="{$templateDir}/images/icons/bullet_green.png"> Status: Erfassen<br/>
			<img src="{$templateDir}/images/icons/bullet_yellow.png"> Status: Bestellung ausgel&ouml;st<br/>
			<img src="{$templateDir}/images/icons/bullet_blue.png"> Status: In Bearbeitung<br/>
			<img src="{$templateDir}/images/icons/bullet_red.png"> Status: Abgeschlossen<br/>
		</td>
	</tr>
</table>

<table class="wide">
<tr>
	<th witth="2%"</th>
	<th width="29%">Bestelldatum</th>
	<th width="29%">Lizenz</th>
	<th width="40">Kommentar zur Bestellung</th>
</tr>
{foreach item=myorder from=$myorders}
<tr>
	<td>
		{if $order.status == 1}<img src="{$templateDir}/images/icons/bullet_green.png">{/if}
		{if $order.status == 2}<img src="{$templateDir}/images/icons/bullet_yellow.png">{/if}
		{if $order.status == 3}<img src="{$templateDir}/images/icons/bullet_blue.png">{/if}
		{if $order.status == 4}<img src="{$templateDir}/images/icons/bullet_red.png">{/if}
	</td>
	<td>{$myorder.date}</td>
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
