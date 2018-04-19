<a class="btn btn-outline-dark" data-toggle="tooltip" data-tooltip="true" data-placement="bottom" title="Neue Person erfassen"
   href="index.php?page={$currentPage}&action=new">
    <i class="fa fa-plus-square"></i>
</a>

<a class="btn btn-outline-dark" data-toggle="tooltip" data-placement="bottom" title="Liste drucken" href="#" onClick='window.print()'>
    <i class="fas fa-print"></i>
</a>

{include file='messages/info.tpl'}


<table id="addressTable" class="table table-striped table-sm">
    <thead class="thead-inverse">
    <tr>
        <th width="2%">&nbsp;</th>
        <th width="10%">Vorname</th>
        <th width="10%">Name</th>
        <th width="20%">Adresse</th>
        <th width="15%">Telefon</th>
        <th width="23%">E-Mail</th>
        <th width="32%">&nbsp;</th>
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
                                return "<a class='btn btn-outline-dark' data-toggle='tooltip' data-placement='bottom' title='Person auf inaktiv setzen'" +
                                        " href='index.php?page=address&action=setState&state=0&personID=" + row.id + "' }>" +
                                        "<i class='fas fa-user' style='color:green'></i></a>";
                            } else {
                                return "<a class='btn btn-outline-dark' data-toggle='tooltip' data-placement='bottom' title='Person auf aktiv setzen'" +
                                        " href='index.php?page=address&action=setState&state=1&personID=" + row.id + "' }>" +
                                        "<i class='fas fa-user' style='color:red'></i></a>";
                            }
                        }
                    },
                    {"targets": 1, "data": "prename"},
                    {"targets": 2, "data": "name"},
                    {"targets": 3, "data": function ( row, type, val, meta ) {
                            return row.address + "<br />" + row.plz + " " + row.ort;
                        }
                    },
                    {"targets": 4, "data": function ( row, type, val, meta ) {
                            var output = "";
                            var newLine = false;
                            if (row.phone != null && row.phone != "") {
                              output = output + "<i class='fas fa-phone'></i>&nbsp;" + row.phone;
                              newLine = true;
                            }
                            if (row.mobile != null && row.mobile != "") {
                              if (newLine) {
                                output = output + "<br />";
                              }
                              output = output + "<i class='fas fa-mobile'></i>&nbsp;&nbsp;" + row.mobile;
                            }

                            return output;
                        }
                    },
                    {"targets": 5, "data": "email"},
                    {
                        "targets": 6,
                        "data": function ( row, type, val, meta ) { return "" },
                        "orderable": false,
                        "className": "text-right",
                        "render": function( data, type, row, meta) {
                            html = "";
                            if(row.signature == 0) {
                                html = html +
                                        "<a class='btn btn-outline-dark' data-toggle='tooltip' data-placement='bottom' target='_blank' title='Beitrittsgesuch' class='icons'" +
                                        " href='index.php?page=address&action=requestForm&personID=" + row.id + "'>" +
                                        " <i class='fas fa-file-pdf'></i></a>";
                            }

                            if (row.active == 1 && row.liga != null) {
                                html = html +
                                        " <a class='btn btn-outline-dark' data-toggle='tooltip' data-placement='bottom' title='" + row.liga +"'>" +
                                        "<i class='fas fa-users'></i></a>";
                            }


                            html = html +
                                    " <a class='btn btn-outline-dark' data-toggle='tooltip' data-placement='bottom' title='Person bearbeiten' class='icons'" +
                                    " href='index.php?page=address&action=edit&personID=" + row.id +"'>" +
                                    "<i class='fas fa-edit'></i></a>";

                            html = html +
                                    " <a class='btn btn-outline-danger' data-toggle='tooltip' data-placement='bottom' title='Person l&ouml;schen' class='icons'" +
                                    "onclick='return confirm(\"Willst du diesen Eintrag wirklich l&ouml;schen?\")'" +
                                    "href='index.php?page=address&action=delete&personID=" + row.id + "'>" +
                                    "<i class='fas fa-trash'></i></a>";

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
