<h3>Zugangsverwaltung Verwaltung</h3>

<p>
	<a data-toggle="tooltip" data-placement="bottom" title="Neue Zugangsberechtigung zum System hinzuf&uuml;gen" href="index.php?page={$currentPage}&action=addAccess">
		<i class="fa fa-plus-square"></i>
	</a>
</p>

{include file='messages/info.tpl'}

<table class="table table-striped">
	<thead>
        <tr>
            <th>&nbsp;</th>
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
            <td>
            {if !empty($member.password)}
                <i class="fa fa-user" style="color:green"></i>
            {else}
                <i class="fa fa-user" style="color: red"></i>
            {/if}
            </td>
            <td>{$member.prename}</td>
            <td>{$member.name}</td>
            <td>{$member.email}</td>
            <td>{$member.groupName}</td>
            <td align="right">
                <a data-toggle="tooltip" data-placement="bottom" title="Zugangsberechtigung entfernen" class="icons"
                   onclick="return confirm('Willst du diesen Eintrag wirklich l&ouml;schen?')"
                   href="index.php?page={$currentPage}&action=removeAccess&personID={$member.personID}">
                    <i style="color: red;" class="fa fa-trash-o"></i>
                </a>
            </td>
        </tr>
        {/foreach}
    </tbody>
</table>
