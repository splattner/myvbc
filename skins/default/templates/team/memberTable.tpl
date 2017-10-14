<p	>
	<a class="btn btn-outline-dark" data-toggle="tooltip" data-placement="bottom" title="neue Person hinzuf&uuml;gen" href="index.php?page={$currentPage}&action=addMember&teamID={$teamID}"><i class="fa fa-plus-square"></i></a>
	<a class="btn btn-outline-dark" data-toggle="tooltip" data-placement="bottom" title="Zur&uuml;ck zur &Uuml;bersicht" href="index.php?page={$currentPage}&action=main"><i class="fa fa-caret-square-o-left"></i></a>
	<a class="btn btn-outline-dark" href="#" onClick='window.print()' data-toggle="tooltip" data-placement="bottom" title="Drucken"><i class="fa fa-print"></i></a>
</p>

<h3>
	{$teamName}
</h3>

{include file='messages/info.tpl'}

<table class="table table-striped">
	<thead class="thead-inverse">
	<tr>
		<th>&nbsp;</th>
		<th>Name</th>
		<th>Adresse</th>
		<th>Kontakt-Daten</th>
		<th>Geburtstag</th>
		<th>E-Mail</th>
		<th>&nbsp;</th>
	</tr>
	</thead>
	<tbody>
	{foreach item=person from=$persons}
		<tr>
			<td>
				{if $person.typ == 1}{/if}
				{if $person.typ == 2}Teamverantwortlicher{/if}
				{if $person.typ == 3}Trainer{/if}
				{if $person.typ == 4}Sonstige Funktion{/if}
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
				<a class="btn btn-danger" onclick="return confirm('Willst du diesen Eintrag wirklich l&ouml;schen?')" class="icons" data-toggle="tooltip" data-placement="bottom" title="aus Team entfernen" href="index.php?page={$currentPage}&action=deleteMember&teamID={$teamID}&personID={$person.personID}"><i class="fa fa-trash-o"></i></a>
			</td>
		</tr>
	{/foreach}
	</tbody>


</table>
