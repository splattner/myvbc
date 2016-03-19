<p class="submenu">
	<a data-toggle="tooltip" data-placement="bottom" title="Zur&uuml;ck zur &Uuml;bersicht" href="index.php?page=index"><i style="color: red" class="fa fa-times"></i></a>
	{if $canAddMember}
		<a data-toggle="tooltip" data-tooltip="true" data-placement="bottom" title="Person dem Team hinzuf&uuml;gen"
		   href="index.php?page={$currentPage}&action=addMember&teamID={$teamID}">
			<i class="fa fa-plus-square"></i>
		</a>
	{/if}
	<a data-toggle="tooltip" data-placement="bottom" title="Liste drucken" href="#" onClick='window.print()'>
		<i class="fa fa-print"></i>
	</a>
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
			<a data-toggle="tooltip" data-placement="bottom" title="Daten dieser Person bearbeiten" class="icons"
			   href="index.php?page={$currentPage}&action=edit&teamID={$person.teamID}&personID={$person.personID}">
				<i class="fa fa-pencil-square-o"></i>
			</a>
		{/if}
		{if $canDeleteMember}
			<a data-toggle="tooltip" data-placement="bottom" title="Diese Person aus dem Team entfernen" class="icons"
			   onclick="return confirm('Willst du diesen Eintrag wirklich l&ouml;schen?')"
			   href="index.php?page={$currentPage}&action=deleteMember&teamID={$person.teamID}&personID={$person.personID}">
				<i style="color: red;" class="fa fa-trash-o"></i>
			</a>
		{/if}

	</td>
</tr>
{/foreach}
</table>
