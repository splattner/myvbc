<p class="submenu">
	<a {popup caption="neue Person hinzuf&uuml;gen" text="Neue Person zu diesem Team hinzuf&uuml;gen"} href="index.php?page={$currentPage}&action=addMember&teamID={$teamID}"><img src="{$templateDir}/images/icons/add.png"></a>
	<a {popup caption="zur&uuml;ck" text="Zur&uuml;ck zur Team &Uuml;bersicht"} href="index.php?page={$currentPage}&action=main"><img src="{$templateDir}/images/icons/cross.png"></a>
	<a href="#" onClick='window.print()' {popup caption="Drucken" text="Diese Liste drucken"}><img src="{$templateDir}/images/icons/printer.png"></a>
</p>

<h3>
	{$teamName}
</h3>

{include file='messages/info.tpl'}

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
	<td>{if $person.email|count_characters > 0}
			{mailto address=$person.email}
		{else}
			Keine E-Mail Adresse
		{/if}
	</td>
	<td style="text-align: right;">
		<a onclick="return confirm('Willst du diesen Eintrag wirklich l�schen?')" class="icons" {popup caption="aus Team entfernen" bgcolor="#FF0000" text="Person aus diesem Team entfernen"} href="index.php?page={$currentPage}&action=deleteMember&teamID={$teamID}&personID={$person.personID}"><img src="{$templateDir}/images/icons/group_delete.png" alt="Mitglied l&oumlschen"></a>
	</td>
</tr>
{/foreach}
</table>
