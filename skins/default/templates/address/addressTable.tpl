<p class="submenu">
    <a data-toggle="tooltip" data-tooltip="true" data-placement="bottom" title="Neue Person erfassen"
       href="index.php?page={$currentPage}&action=new">
        <i class="fa fa-plus-square"></i>
    </a>

    <a data-toggle="tooltip" data-placement="bottom" title="Liste drucken" href="#" onClick='window.print()'>
        <i class="fa fa-print"></i>
    </a>
</p>

{include file='messages/info.tpl'}


<table class="legend">
    <tr>
        <td>
            <i class="fa fa-user" style="color:green"></i> Aktiv in einem Team <br/>
            <i class="fa fa-user" style="color: red"></i> Inaktiv (keinem Team zugeordnet) <br/>
        </td>
    </tr>
</table>


<table id="addressTable" class="table table-striped table-condensed">
    <thead>
    <tr>
        <th width="2%">&nbsp;</th>
        <th width="10%">Vorname</th>
        <th width="10%">Name</th>
        <th width="20%">Adresse</th>
        <th width="15%">Telefon</th>
        <th width="15%">Mobile</th>
        <th width="15%">E-Mail</th>
        <th width="15%">&nbsp;</th>
    </tr>

    </thead>

    <tbody>

    </tbody>
</table>


{literal}
    <script type="text/javascript">
        $(document).ready(function () {
            $('#addressTable').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/505bef35b56/i18n/German.json"
                },
                "order": [[2, "asc"], [1, "asc"]],
                "columnDefs": [
                    {
                        "targets": 0,
                        "data": "active",
                        "orderable": false,
                        "render" : function( data, type, row, meta) {
                            if(data == 1){
                                return "<a class='icons' data-toggle='tooltip' data-placement='bottom' title='Person auf inaktiv setzen'" +
                                        " href='index.php?page=address&action=setState&state=0&personID=" + row.id + "' }>" +
                                        "<i class='fa fa-user' style='color:green'></i></a>";
                            } else {
                                return "<a class='icons' data-toggle='tooltip' data-placement='bottom' title='Person auf aktiv setzen'" +
                                        " href='index.php?page=address&action=setState&state=1&personID=" + row.id + "' }>" +
                                        "<i class='fa fa-user' style='color:red'></i></a>";
                            }
                        }
                    },
                    {"targets": 1, "data": "prename"},
                    {"targets": 2, "data": "name"},
                    {"targets": 3, "data": function ( row, type, val, meta ) {
                            return row.address + "<br />" + row.plz + " " + row.ort;
                        }
                    },
                    {"targets": 4, "data": "phone"},
                    {"targets": 5, "data": "mobile"},
                    {"targets": 6, "data": "email"},
                    {
                        "targets": 7,
                        "data": function ( row, type, val, meta ) { return "" },
                        "orderable": false,
                        "className": "text-right",
                        "render": function( data, type, row, meta) {
                            html = "";
                            if(row.signature == 0) {
                                html = html +
                                        "<a data-toggle='tooltip' data-placement='bottom' target='_blank' title='Beitrittsgesuch' class='icons'" +
                                        " href='index.php?page=address&action=requestForm&personID=" + row.id + "'>" +
                                        " <i class='fa fa-file-pdf-o'></i></a>";
                            }

                            if (row.active == 1 && row.liga != "") {
                                html = html +
                                        " <a class='icons' data-toggle='tooltip' data-placement='bottom' title='" + row.liga +"'>" +
                                        "<i class='fa fa-users'></i></a>";
                            }


                            html = html +
                                    " <a data-toggle='tooltip' data-placement='bottom' title='Person bearbeiten' class='icons'" +
                                    " href='index.php?page=address&action=edit&personID=" + row.id +"'>" +
                                    "<i class='fa fa-pencil-square-o'></i></a>";

                            html = html +
                                    " <a data-toggle='tooltip' data-placement='bottom' title='Person l&ouml;schen' class='icons'" +
                                    "onclick='return confirm(\"Willst du diesen Eintrag wirklich l&ouml;schen?\")'" +
                                    "href='index.php?page=addressaction=delete&personID=" + row.id + "'>" +
                                    "<i style='color: red;' class='fa fa-trash-o'></i></a>";

                            return html;


                        }
                    }
                ],

                "ajax" : {
                    //"serverSide": true,
                    "processing": true,
                    "url" : "index.php/api/address/getAddresses/dt/"
                },
                "drawCallback": function(settings) {
                    $('[data-toggle="tooltip"]').tooltip()

                }
            });
        });
    </script>
{/literal}