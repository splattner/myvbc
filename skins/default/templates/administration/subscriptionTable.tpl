<h3>Benachrichtigungs Verwaltung</h3>

<a class="btn btn-outline-dark" data-toggle="tooltip" data-placement="bottom" title="Person auf einen Nachrichtentype einschreiben" href="index.php?page={$currentPage}&action=addNoteSubscription">
	<i class="fas fa-plus-square"></i>
</a>

{include file='messages/info.tpl'}

<table class="table table-striped">
	<thead class="thead-inverse">
		<tr>
			<th>Benachrichtigungstype</th>
			<th>Person</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
		{foreach item=subscription from=$subscriptions}
		<tr>
			<td>{$subscription.type}</td>
			<td>{$subscription.prename} {$subscription.name}</td>
			<td align="right">
				{if $subscription.email == 1}<i class="btn btn-outline-dark fas fa-envelope" data-toggle="tooltip" data-placement="bottom" title="inkl. E-Mail"></i>{/if}
				<a class="btn btn-outline-danger" data-toggle="tooltip" data-placement="bottom" title="Subscription entfernen"
				   onclick="return confirm('Willst du diesen Eintrag wirklich l&ouml;schen?')"
				   href="index.php?page={$currentPage}&action=deleteNoteSubscription&typeID={$subscription.typeid}&personID={$subscription.personid}">
					<i style="color: red;" class="fas fa-trash"></i>
				</a>
			</td>
		</tr>
		{/foreach}
	</tbody>
</table>

<h3>Alle Benachrichtigungen</h3>
<table id="notificationTable" class="table table-striped">
    <thead class="thead-inverse">
        <tr>
            <th>Nachrichten-Typ</th>
            <th>Inhalt</th>
            <th>Datum</th>
            <th>Ausl&ouml;ser</th>
            <th>&nbsp</th>
        </tr>
    </thead>
</table>

{literal}
    <script type="text/javascript">
        $(document).ready(function () {
            $('#notificationTable').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/505bef35b56/i18n/German.json"
                },
                "order": [[2, "desc"]],
                "columnDefs": [
                    {"targets": 0, "data": "type"},
                    {"targets": 1, "data": "message"},
                    {"targets": 2, "data": "date"},
                    {"targets": 3, "data": function ( row, type, val, meta ) {
                            return row.prename + " " + row.name;
                        }
                    },
                    {
                        "targets": 4,
                        "data": function ( row, type, val, meta ) { return "" },
                        "orderable": false,
                        "className": "text-right",
                        "render": function( data, type, row, meta) {
                            html = " <a class='btn btn-outline-danger' data-toggle='tooltip' data-placement='bottom' title='Person l&ouml;schen' class='icons'" +
                                    "onclick='return confirm(\"Willst du diesen Eintrag wirklich l&ouml;schen?\")'" +
                                    "href='index.php?page=admin&action=deleteNote&notificationID=" + row.notificationID + "'>" +
                                    "<i class='fas fa-trash'></i></a>";

                            return html;


                        }
                    }
                ],

                "ajax" : {
                    //"serverSide": true,
                    "processing": true,
                    "url" : "index.php/api/notification/getAllNotifications/dt"
                },
                "drawCallback": function(settings) {
                    $('[data-toggle="tooltip"]').tooltip()

                }
            });
        });
    </script>
{/literal}
