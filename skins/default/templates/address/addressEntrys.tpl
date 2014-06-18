<table class="wide">
<tr>
	<th width="2%">&nbsp;</th>
	<th width="10%">Vorname</th>
	<th width="10%">Name</th>
	<th width="21%">Adresse</th>
	<th width="12%">Telefon</th>
	<th width="12%">Mobile</th>
	<th width="23%">E-Mail</th>
	<th width="10%">&nbsp;</th>
</tr>
{foreach item=person from=$persons}
<tr>
	<td>
		{if $person.active == 1}
			<a class="icons" href="index.php?page={$currentPage}&action=setState&state=0&personID={$person.id}" {popup caption="Status bearbeiten" text="Person auf inaktiv setzen"}><img src="{$templateDir}/images/icons/bullet_green.png"></a>
		{else}
			<a class="icons" href="index.php?page={$currentPage}&action=setState&state=1&personID={$person.id}" {popup caption="Status bearbeiten" text="Person auf aktiv setzen"}><img src="{$templateDir}/images/icons/bullet_red.png"></a>
		{/if}
	</td>
	<td>{$person.prename}</td>
	<td>{$person.name}</td>
	<td>
		{$person.address} <br />
		{$person.plz} {$person.ort}
	</td>
	<td>{$person.phone}</td>
	<td>{$person.mobile}</td>
	<td>{$person.email}</td>
	<td align="right">
		{if $person.active == 1 && isset($person.liga)}<a class="icons" {popup caption="Teams" text=$person.liga}><img src="{$templateDir}/images/icons/group.png"</a>{/if}
		<a class="icons" href="index.php?page={$currentPage}&action=edit&personID={$person.id}" {popup caption="bearbeiten" text="Personendaten bearbeiten"}><img src="{$templateDir}/images/icons/book_edit.png"></a>
		<a class="icons" onclick="return confirm('Willst du diesen Eintrag wirklich l&ouml;schen?')" href="index.php?page={$currentPage}&action=delete&personID={$person.id}" {popup caption="l�schen" bgcolor="#FF0000" text="Person aus System entfernen. Achtung: Dies geschieht sofort und kann nicht r�ckg�ngig gemacht werden"}><img src="{$templateDir}/images/icons/book_delete.png" alt="Mitglied l&ouml;schen"></a>
	</td>
</tr>
{/foreach}
</table>
