<h3>Benachrichtigungs Verwaltung</h3>

<p>
	<a {popup caption="neuer Subscription" text="Person auf einen Nachrichtentype einschreiben"}href="index.php?page={$currentPage}&action=addNoteSubscription"><img src="{$templateDir}/images/icons/note_add.png"></a>
</p>

{include file='messages/info.tpl'}

<table class="wide">
<tr>
	<th>&nbsp;</th>
	<th>Benachrichtigungstype</th>
	<th>Person</th>
	<th>&nbsp;</th>
</tr>

{foreach item=subscription from=$subscriptions}
<tr>
	<td><img src="{$templateDir}/images/icons/bullet_green.png""></td>
	<td>{$subscription.type}</td>
	<td>{$subscription.prename} {$subscription.name}</td>
	<td align="right">
		{if $subscription.email == 1}<img src="{$templateDir}/images/icons/email.png">{/if}
		<a class="icons" href="index.php?page={$currentPage}&action=deleteNoteSubscription&typeID={$subscription.typeid}&personID={$subscription.personid}" {popup caption="löschen" bgcolor="#FF0000" text="Subscription entfernen Achtung: Dies geschieht sofort und kann nicht rückgängig gemacht werden"}><img src="{$templateDir}/images/icons/note_delete.png"></a>
	</td>
</tr>
{/foreach}
</table>

<h3>Alle Benachrichtigungen</h3>
<table class="wide">
<tr>
	<th>Nachrichten-Typ</th>
	<th>Datum</th>
	<th>Inhalt</th>
	<th>Auslöser</th>
	<th>&nbsp</th>
</tr>

{foreach item=allnotification from=$allnotifications}
<tr>
	<td>{$allnotification.type}</td>
	<td>{$allnotification.message}</td>
	<td>{$allnotification.date|date_format:"%d.%m.%Y - %H:%M"}</td>
	<td>{$allnotification.prename} {$allnotification.name}</td>
		<td align="right">
		<a class="icons" href="index.php?page={$currentPage}&action=deleteNote&notificationID={$allnotification.notificationID}" {popup caption="löschen" bgcolor="#FF0000" text="Diese Benachrichtigung global löschen. Achtung: Dies geschieht sofort und kann nicht rückgängig gemacht werden"}><img src="{$templateDir}/images/icons/note_delete.png"></a>
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
</table>
