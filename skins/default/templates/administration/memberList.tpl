<h3>Zugangsverwaltung Verwaltung</h3>

<p>
	<a {popup caption="neuer Zugang" text="Neue Zugangsberechtigung zum System hinzufügen"}href="index.php?page={$currentPage}&action=addAccess"><img src="{$templateDir}/images/icons/key_add.png"></a>
</p>

{include file='messages/info.tpl'}

<table class="wide">
<tr>
	<th>&nbsp;</th>
	<th>Vorname</th>
	<th>Name</th>
	<th>E-Mail</th>
	<th>Gruppe</th>
	<th>&nbsp;</th>
</tr>

{foreach item=member from=$members}
<tr>
	<td>
	{if !empty($member.password)}
		<img src="{$templateDir}/images/icons/bullet_green.png">
	{else}
		<img src="{$templateDir}/images/icons/bullet_red.png">
	{/if}
	</td>
	<td>{$member.prename}</td>
	<td>{$member.name}</td>
	<td>{$member.email}</td>
	<td>{$member.groupName}</td>
	<td align="right">
		<a {popup caption="löschen" bgcolor="#FF0000" text="Zugangsberechtigung entfernen"} href="index.php?page={$currentPage}&action=removeAccess&personID={$member.personID}"><img src="{$templateDir}/images/icons/key_delete.png"></a>
	</td>
</tr>
{/foreach}
</table>
