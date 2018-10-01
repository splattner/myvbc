<a class="btn btn-outline-dark" data-toggle="tooltip" data-placement="bottom" title="Zur&uuml;ck zur &Uuml;bersicht" href="index.php?page=index">
	<i class="fas fa-caret-square-left"></i>
</a>
{if $canAddMember}
	<a class="btn btn-outline-dark" data-toggle="tooltip" data-tooltip="true" data-placement="bottom" title="Person dem Team hinzuf&uuml;gen"
	   href="index.php?page={$currentPage}&action=addMember&teamID={$teamID}">
		<i class="fas fa-plus-square"></i>
	</a>
{/if}
<a class="btn btn-outline-dark" data-toggle="tooltip" data-placement="bottom" title="Liste drucken" href="#" onClick='window.print()'>
	<i class="fas fa-print"></i>
</a>

<a class="btn btn-outline-dark" data-toggle="tooltip" data-placement="bottom" title="Hilfe" target="_blank" href="https://github.com/splattner/myvbc/wiki/Spieler-zu-Team-hinzuf%C3%BCgen">
	<i class="fas fa-question-circle"></i>
</a>




{include file='messages/info.tpl'}

<h2>{$teamName}</h2>

<table class="table table-striped">
	<thead class="thead-inverse">
		<tr>
			<th></th>
			<th></th>
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
                {if $person.typ == 2}<i data-toggle="tooltip" data-placement="bottom" title="Captain" class="fas fa-copyright"></i>{/if}
                {if $person.typ == 3}<i data-toggle="tooltip" data-placement="bottom" title="Coach" class="fas fa-bookmark"></i>{/if}
                {if $person.typ == 4}<i data-toggle="tooltip" data-placement="bottom" title="Sonstige Funktion" class="fas fa-paperclip"></i>{/if}
            </td>
            <td>
                {if $person.signature == 0}
                    <a class="btn btn-dark" data-toggle="tooltip" data-placement="bottom" target="_blank" title="Beitrittsgesuch" class="icons"
                       href="index.php?page={$currentPage}&action=requestForm&personID={$person.personID}">
                        <i class="fas fa-file-pdf"></i>
                    </a>
                {/if}
            </td>
            <td>
                {$person.prename} {$person.name}
            </td>
            <td>{$person.address}<br />
                {$person.plz} {$person.ort} <br />
            </td>
            <td>
                <i class="fa fa-phone"></i> {$person.phone} <br />
                <i class="fa fa-mobile"></i> {$person.mobile}
            </td>
            <td>{$person.birthday|date_format:"%d.%m.%Y"}</td>
            <td>{if $person.email|count_characters > 0} {mailto address=$person.email}{else}Keine E-Mail Adresse{/if}</td>
            <td align="right">

                {if $canEditMember}
                    <a class="btn btn-dark" data-toggle="tooltip" data-placement="bottom" title="Daten dieser Person bearbeiten" class="icons"
                       href="index.php?page={$currentPage}&action=edit&teamID={$person.teamID}&personID={$person.personID}">
                        <i class="fas fa-edit"></i>
                    </a>
                {/if}
                {if $canDeleteMember}
                    <a class="btn btn-danger" data-toggle="tooltip" data-placement="bottom" title="Diese Person aus dem Team entfernen" class="icons"
                       onclick="return confirm('Willst du diesen Eintrag wirklich l&ouml;schen?')"
                       href="index.php?page={$currentPage}&action=deleteMember&teamID={$person.teamID}&personID={$person.personID}">
                        <i class="fas fa-trash"></i>
                    </a>
                {/if}

            </td>
        </tr>
        {/foreach}
    </tbody>
</table>
