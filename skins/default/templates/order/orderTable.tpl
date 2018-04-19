<a class="btn btn-outline-dark" href="#" data-toggle="modal" data-tooltip="true" data-target="#myModal" title="Neue Lizenzbestelung">
    <i class="fas fa-plus-square"></i>
</a>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">neue Lizenzbestellung</h4>
            </div>
            <div class="modal-body">
                <form id="licenceform" action="index.php?page={$currentPage}&action=new" method="POST">
                    <input type="hidden" name="doNew" value="true" />

                    <div class="form-group row">
                        <label for="teamid" class="col-sm-2 col-form-label">Bestellung f&uuml;r Team</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="teamid">
                                <option value="0">(Team ausw&auml;hlen)</option>
                                {foreach item=team from=$teams}
                                    <option value="{$team.id}">{$team.name}</option>
                                {/foreach}
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="bemerkung" class="col-sm-2 col-form-label">Bemerkung</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" name="comment" id="bemerkung"></textarea>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Schliessen</button>
                <button type="submit" class="btn btn-primary" name="doNew" onClick="document.getElementById('licenceform').submit();">weiter</button>

            </div>
        </div>
    </div>
</div>

{include file='messages/info.tpl'}

<table class="table table-striped">
    <thead class="thead-inverse">
    <tr>
        <th width="2%"></th>
        <th width="20%">Datum</th>
        <th width="20%">letzte &Auml;nderung</th>
        <th width="32%">Kommentar</th>
        <th width="15%">Ausgel&ouml;st durch</th>
        <th width="50%">&nbsp;</th>
    </tr>
    </thead>
    <tbody>
    {foreach item=order from=$orders}
        <tr>
            <td>
                {if $order.status == 1}<a data-tooltip="true" title="Neu" class="btn btn-dark"><i style="color: green" class="fa fa-battery-empty" aria-hidden="true"></i></a>{/if}
                {if $order.status == 2}<a data-tooltip="true" title="Bestellung ausgel&ouml;st" class="btn btn-dark"><i style="color: yellow" class="fa fa-battery-half" aria-hidden="true"></i></a>{/if}
                {if $order.status == 3}<a data-tooltip="true" title="In Bearbeitung" class="btn btn-dark"><i style="color: yellow" class="fa fa-battery-three-quarters" aria-hidden="true"></i></a>{/if}
                {if $order.status == 4}<a data-tooltip="true" title="Abgeschlossen" class="btn btn-dark"><i style="color: white" class="fa fa-battery-full" aria-hidden="true"></i></a>{/if}
            </td>
            <td>
                {$order.createdate|date_format:"%a, %d %B %y - %H:%M"}
            </td>
            <td>
                {$order.lastupdate|date_format:"%a, %d %B %y - %H:%M"}
            </td>

            <td>
                {$order.comment}
            </td>
            <td>
                {$order.ownername}
            </td>
            <td align="right">
                <a class="btn btn-dark" data-toggle="tooltip" data-placement="bottom" title="anzeigen &amp; bearbeiten"
                   href="index.php?page={$currentPage}&action=list&orderID={$order.id}">
                    <i class="fas fa-edit"></i>
                </a>
                {if (($allowedit && $order.status != 4 )|| ($order.owner == $uid && $order.status == 1))}
                    <a class="btn btn-danger" data-toggle="tooltip" data-placement="bottom" title="l&ouml;schen"
                       onclick="return confirm('Willst du diesen Bestellung wirklich l&ouml;schen?')"
                       href="index.php?page={$currentPage}&action=delete&orderID={$order.id}">
                        <i class="fas fa-trash"></i>
                    </a>
                {/if}
            </td>
        </tr>
    {/foreach}
    </tbody>

</table>
