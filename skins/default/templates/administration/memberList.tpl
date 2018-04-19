<h3>Zugangsverwaltung Verwaltung</h3>

<a class="btn btn-outline-dark" data-toggle="tooltip" data-placement="bottom" title="Neue Zugangsberechtigung zum System hinzuf&uuml;gen" href="index.php?page={$currentPage}&action=addAccess">
	<i class="fas fa-plus-square"></i>
</a>


{include file='messages/info.tpl'}

<table class="table table-striped table-sm">
	<thead class="thead-inverse">
        <tr>
            <th>Vorname</th>
            <th>Name</th>
            <th>E-Mail</th>
            <th>Gruppe</th>
            <th>&nbsp;</th>
        </tr>
    </thead>
    <tbody>
        {foreach item=member from=$members}
        <tr>
            <td>{$member.prename}</td>
            <td>{$member.name}</td>
            <td>{$member.email}</td>
            <td><span class="badge badge-pill badge-secondary">{$member.groupName}</span></td>
            <td align="right">
                <a class="btn btn-outline-danger" data-toggle="tooltip" data-placement="bottom" title="Zugangsberechtigung entfernen" class="icons"
                   onclick="return confirm('Willst du diesen Eintrag wirklich l&ouml;schen?')"
                   href="index.php?page={$currentPage}&action=removeAccess&personID={$member.personID}">
                    <i class="fas fa-trash"></i>
                </a>
            </td>
        </tr>
        {/foreach}
    </tbody>
</table>
