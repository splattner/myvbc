<p>
	<a {popup caption="Neues Team" text="Neues Team in myVBC eintragen"} href="index.php?page={$currentPage}&action=new"><img src="{$templateDir}/images/icons/add.png"></a>
</p>

<table class="wide">
<tr>
	<th>Externer Namen</th>
	<th>Team</th>
	<th>Liga</th>
	<th>&nbsp;</th>
</tr>

{foreach item=team from=$teams}
<tr>
	<td>{$team.extname}</td>
	<td>{$team.name}</td>
	<td>{$team.liga}</td>
	<td align="right">
		<a class="icons" {popup caption="bearbeiten" text="Daten dieses Teams bearbeiten"} href="index.php?page={$currentPage}&action=edit&teamID={$team.id}"><img src="{$templateDir}/images/icons/group_gear.png" alt="Team bearbeiten"></a>
		<a class="icons" {popup caption="Mitglieder bearbeiten" text="Personen, die diesem Team zugehören, bearbeiten"} href="index.php?page={$currentPage}&action=member&teamID={$team.id}"><img src="{$templateDir}/images/icons/group_edit.png" alt="Mitglieder bearbeiten"></a>
		<a onclick="return confirm('Willst du diesen Eintrag wirklich löschen?')" class="icons" {popup caption="löschen" bgcolor="#FF0000" text="Team aus System entfernen. Achtung: Dies geschieht sofort und kann nicht rückgängig gemacht werden"} href="index.php?page={$currentPage}&action=delete&teamID={$team.id}"><img src="{$templateDir}/images/icons/group_delete.png" alt="Team l&ouml;schen"></a>
	</td>
</tr>
{/foreach}
</table>
