<h3>Benachrichtigungs Verwaltung</h3>

<p>
	<a data-toggle="tooltip" data-placement="bottom" title="Person auf einen Nachrichtentype einschreiben" href="index.php?page={$currentPage}&action=addNoteSubscription">
		<i class="fa fa-plus-square"></i>
	</a>
</p>

{include file='messages/info.tpl'}

<table class="table table-striped">
	<thead>
		<tr>
			<th>Benachrichtigungstype</th>
			<th>Person</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
		{foreach item=subscription from=$subscriptions}
		<tr>
			<td>{$subscription.type}</td>
			<td>{$subscription.prename} {$subscription.name}</td>
			<td align="right">
				{if $subscription.email == 1}<i class="fa fa-envelope-o"></i>{/if}
				<a data-toggle="tooltip" data-placement="bottom" title="Subscription entfernen." class="icons"
				   onclick="return confirm('Willst du diesen Eintrag wirklich l&ouml;schen?')"
				   href="index.php?page={$currentPage}&action=deleteNoteSubscription&typeID={$subscription.typeid}&personID={$subscription.personid}">
					<i style="color: red;" class="fa fa-trash-o"></i>
				</a>
			</td>
		</tr>
		{/foreach}
	</tbody>
</table>

<h3>Alle Benachrichtigungen</h3>
<table class="table table-striped">
    <thead>
        <tr>
            <th>Nachrichten-Typ</th>
            <th>Inhalt</th>
            <th>Datum</th>
            <th>Ausl&ouml;ser</th>
            <th>&nbsp</th>
        </tr>
    </thead>
    <tbody>
        {foreach item=allnotification from=$allnotifications}
        <tr>
            <td>{$allnotification.type}</td>
            <td>{$allnotification.message}</td>
            <td>{$allnotification.date|date_format:"%d.%m.%Y - %H:%M"}</td>
            <td>{$allnotification.prename} {$allnotification.name}</td>
                <td align="right">
                    <a data-toggle="tooltip" data-placement="bottom" title="Diese Benachrichtigung global l&ouml;schen. " class="icons"
                       onclick="return confirm('Willst du diesen Eintrag wirklich l&ouml;schen?')"
                       href="index.php?page={$currentPage}&action=deleteNote&notificationID={$allnotification.notificationID}">
                        <i style="color: red;" class="fa fa-trash-o"></i>
                    </a>
                </td>
        </tr>
        {/foreach}
        {if empty($allnotifications)}
        <tr>
            <td colspan="4">
                <i>Keine Benachrichtigungen vorhanden</i>
            </td>
        </tr>
        {/if}
    </tbody>
</table>
