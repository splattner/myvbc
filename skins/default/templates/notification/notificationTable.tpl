<p>
    <a class="icons" data-toggle="tooltip" data-placement="bottom" title="Alle l&ouml;schen" href="index.php?page={$currentPage}&action=delete&notificationID=0">
        <i style="color: red;" class="fa fa-trash-o"></i>
    </a>
</p>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Nachrichten-Typ</th>
			<th>Inhalt</th>
			<th>Datum</th>
			<th>Ausl&ouml;ser</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
    <tbody>
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
    </tbody>
{if empty($notifications)}
    <tbody>
        <tr>
            <td colspan="5">
                <i>Keine neuen Benachrichtigungen vorhanden</i>
            </td>
        </tr>
    </tbody>
{/if}
</table>
