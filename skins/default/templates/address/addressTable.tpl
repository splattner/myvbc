<p class="submenu">
    <a data-toggle="tooltip" data-tooltip="true" data-placement="bottom" title="Neue Person erfassen"
       href="index.php?page={$currentPage}&action=new">
        <i class="fa fa-plus-square fa-2x"></i>
    </a>

    <a data-toggle="tooltip" data-placement="bottom" title="Liste drucken" href="#" onClick='window.print()'>
        <i class="fa fa-print fa-2x"></i>
    </a>
</p>

{include file='messages/info.tpl'}


<table class="legend">
    <tr>
        <td>
            <img src="{$templateDir}/images/icons/bullet_green.png"> Aktiv in einem Team <br/>
            <img src="{$templateDir}/images/icons/bullet_red.png"> Inaktiv (keinem Team zugeordnet) <br/>
        </td>
    </tr>
</table>


<table id="addressTable" class="table table-condensed">
    <thead>
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

    </thead>

    <tbody>

    {foreach item=person from=$persons}
        <tr>
            <td>
                {if $person.active == 1}
                    <a class="icons" data-toggle="tooltip" data-placement="bottom" title="Person auf inaktiv setzen"
                       href="index.php?page={$currentPage}&action=setState&state=0&personID={$person.id}" }><img
                                src="{$templateDir}/images/icons/bullet_green.png"></a>
                {else}
                    <a class="icons" data-toggle="tooltip" data-placement="bottom" title="Person auf aktiv setzen"
                       href="index.php?page={$currentPage}&action=setState&state=1&personID={$person.id}"><img
                                src="{$templateDir}/images/icons/bullet_red.png"></a>
                {/if}
            </td>
            <td>{$person.prename}</td>
            <td>{$person.name}</td>
            <td>
                {$person.address} <br/>
                {$person.plz} {$person.ort}
            </td>
            <td>{$person.phone}</td>
            <td>{$person.mobile}</td>
            <td>{$person.email}</td>
            <td align="right">
                {if $person.active == 1 && isset($person.liga)}
                    <a class="icons" data-toggle="tooltip" data-placement="bottom" title="{$person.liga}">
                        <i class="fa fa-users"></i>
                    </a>
                {/if}
                <a data-toggle="tooltip" data-placement="bottom" title="Person bearbeiten" class="icons"
                   href="index.php?page={$currentPage}&action=edit&personID={$person.id}">
                    <i class="fa fa-pencil-square-o"></i>
                </a>
                <a data-toggle="tooltip" data-placement="bottom" title="Person L&ouml;schen" class="icons"
                   onclick="return confirm('Willst du diesen Eintrag wirklich l&ouml;schen?')"
                   href="index.php?page={$currentPage}&action=delete&personID={$person.id}">
                    <i style="color: red;" class="fa fa-trash-o"></i>
                </a>
            </td>
        </tr>
    {/foreach}
    </tbody>
</table>


{literal}
    <script type="text/javascript">
        $(document).ready(function () {
            $('#addressTable').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/505bef35b56/i18n/German.json"
                },
                "order": [[1, "desc"], [2, "desc"]],
                "columnDefs": [
                    {"targets": 0, "orderable": false},
                    {"targets": 7, "orderable": false}
                ]
            });
        });
    </script>
{/literal}