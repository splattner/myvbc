<h2>History</h2>

<table class="table table-striped table-sm">
	<thead class="thead-inverse">
		<tr>
			<th width="20%">Nachricht Typ</th>
			<th width="50%">Inhalt</th>
			<th width="20%">Datum</th>
			<th width="30%">Ausl&ouml;ser</th>
		</tr>
	</thead>
	<tbody>
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
	</tbody>
</table>

<h2>Lizenzbestellungen</h2>

<table class="legend">
	<tr>
		<td>
			<i class="fas fa-dot-circle" style="color: green" aria-hidden="true"></i> Erfassen<br/>
			<i class="fas fa-dot-circle" style="color: yellow" aria-hidden="true"></i> Bestellung ausgel&ouml;st<br/>
			<i class="fas fa-dot-circle" style="color: blue" aria-hidden="true"></i> In Bearbeitung<br/>
			<i class="fas fa-dot-circle" style="color: red" aria-hidden="true"></i> Abgeschlossen<br/>
		</td>
	</tr>
</table>

<table class="table table-striped table-sm">
    <thead class="thead-inverse">
        <tr>
            <th width="2%"</th>
            <th width="20%">Bestelldatum</th>
            <th width="20%">Lizenz</th>
            <th width="58">Kommentar zur Bestellung</th>
        </tr>
    </thead>
    <tbody>
        {foreach item=myorder from=$myorders}
        <tr>
            <td>
                {if $myorder.status == 1}<i class="fa fa-dot-circle-o" style="color: green" aria-hidden="true"></i> {/if}
                {if $myorder.status == 2}<i class="fa fa-dot-circle-o" style="color: yellow" aria-hidden="true"></i><{/if}
                {if $myorder.status == 3}<i class="fa fa-dot-circle-o" style="color: blue" aria-hidden="true"></i><{/if}
                {if $myorder.status == 4}<i class="fa fa-dot-circle-o" style="color: red" aria-hidden="true">{/if}
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
    </tbody>
</table>
