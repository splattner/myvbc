<p class="submenu">
	<a {popup caption="zur&uuml;ck" text="Zur&uuml;ck zur &Uuml;bersicht"} href="index.php?page=index"><img src="{$templateDir}/images/icons/cross.png"></a>
	{if $canAddMember}
	<a {popup caption="hinzuf&uuml;gen" text="Person dem Team hinzuf&uuml;gen"} href="index.php?page={$currentPage}&action=addMember&teamID={$teamID}"><img src="{$templateDir}/images/icons/add.png"></a>
	{/if}
	<a href="#" onClick='window.print()' {popup caption="Drucken" text="Diese Liste drucken"}><img src="{$templateDir}/images/icons/printer.png"></a>
</p>

{include file='messages/info.tpl'}

<h2>{$teamName}</h2>

<table class="legend">
<tr>
	<td>
		<img src="{$templateDir}/images/icons/bullet_green.png"> Spieler <br />
		<img src="{$templateDir}/images/icons/bullet_yellow.png"> Captain / Teamverantwortlicher <br />
		<img src="{$templateDir}/images/icons/bullet_red.png"> Trainer <br />
		<img src="{$templateDir}/images/icons/bullet_blue.png"> Sonstige Funktion <br />
	</td>
</tr>
</table>

<table class="wide">
<tr>
	<th>&nbsp;</th>
	<th>Name</th>
	<th>Adresse</th>
	<th>Kontakt-Daten</th>
	<th>Geburtstag</th>
	<th>E-Mail</th>
	<th>&nbsp;</th>
</tr>

{foreach item=person from=$persons}
<tr>
	<td>
		{if $person.typ == 1}<img src="{$templateDir}/images/icons/bullet_green.png">{/if}
		{if $person.typ == 2}<img src="{$templateDir}/images/icons/bullet_yellow.png">{/if}
		{if $person.typ == 3}<img src="{$templateDir}/images/icons/bullet_red.png">{/if}
		{if $person.typ == 4}<img src="{$templateDir}/images/icons/bullet_blue.png">{/if}
	</td>
	<td>
		{$person.prename} {$person.name}
	</td>
	<td>{$person.address}<br />
		{$person.plz} {$person.ort} <br />
	</td>
	<td>
		Telefon: {$person.phone} <br />
		Mobile: {$person.mobile}
	</td>
	<td>{$person.birthday|date_format:"%d.%m.%Y"}</td>
	<td>{if $person.email|count_characters > 0} {mailto address=$person.email}{else}Keine E-Mail Adresse{/if}</td>
	<td align="right">
		{if $canEditMember}
		<a class="icons" {popup caption="bearbeiten" text="Daten dieser Person bearbeiten"} href="index.php?page={$currentPage}&action=edit&teamID={$person.teamID}&personID={$person.personID}"><img src="{$templateDir}/images/icons/group_edit.png"></a>
		{/if}
		{if $canDeleteMember}
		<a onclick="return confirm('Willst du diesen Eintrag wirklich l�schen?')" class="icons" {popup caption="entfernen" bgcolor="#FF0000" text="Diese Person aus dem Team entfernen"} href="index.php?page={$currentPage}&action=deleteMember&teamID={$person.teamID}&personID={$person.personID}"><img src="{$templateDir}/images/icons/group_delete.png"></a>
		{/if}

	</td>
</tr>
{/foreach}
</table>
