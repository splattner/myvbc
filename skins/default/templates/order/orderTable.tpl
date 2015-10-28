<p class="submenu">
    <a href="#" data-toggle="modal" data-target="#myModal">
        <i class="fa fa-plus-square fa-2x"></i>
    </a>
</p>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">neue Lizenzbestellung</h4>
            </div>
            <div class="modal-body">
                <form id="licenceform" class="form-horizontal" action="index.php?page={$currentPage}&action=new" method="POST">

                    <div class="form-group">
                        <label for="teamid" class="col-sm-2 control-label">Bestellung f&uuml;r Team</label>
                        <div class="col-sm-10">
                            <select class="form-control" onchange='getGames(this.value);' name="teamid">
                                <option value="0">(Team ausw&auml;hlen)</option>
                                {foreach item=team from=$teams}
                                    <option value="{$team.id}">{$team.name}</option>
                                {/foreach}
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="bemerkung" class="col-sm-2 control-label">Bestellung f&uuml;r Team</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" name="comment" id="bemerkung"></textarea>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Schliessen</button>
                <button type="submit" class="btn btn-primary" name="doNew" form="licenceform">weiter</button>

            </div>
        </div>
    </div>
</div>

{include file='messages/info.tpl'}

<table class="legend">
    <tr>
        <td>
            <img src="{$templateDir}/images/icons/bullet_green.png"> Status: Erfassen<br/>
            <img src="{$templateDir}/images/icons/bullet_yellow.png"> Status: Bestellung ausgel&ouml;st<br/>
            <img src="{$templateDir}/images/icons/bullet_blue.png"> Status: In Bearbeitung<br/>
            <img src="{$templateDir}/images/icons/bullet_red.png"> Status: Abgeschlossen<br/>
        </td>
    </tr>
</table>

<table class="wide">
    <tr>
        <th width="2%"></th>
        <th width="20%">Datum</th>
        <th width="20%">letzte &Auml;nderung</th>
        <th width="38%">Kommentar</th>
        <th width="15%">Ausgel&ouml;st durch</th>
        <th width="5%">&nbsp;</th>
    </tr>

    {foreach item=order from=$orders}
        <tr>
            <td>
                {if $order.status == 1}<img src="{$templateDir}/images/icons/bullet_green.png">{/if}
                {if $order.status == 2}<img src="{$templateDir}/images/icons/bullet_yellow.png">{/if}
                {if $order.status == 3}<img src="{$templateDir}/images/icons/bullet_blue.png">{/if}
                {if $order.status == 4}<img src="{$templateDir}/images/icons/bullet_red.png">{/if}
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
                <a data-toggle="tooltip" data-placement="bottom" title="anzeigen &amp; bearbeiten"
                   href="index.php?page={$currentPage}&action=list&orderID={$order.id}">
                    <i class="fa fa-pencil-square-o"></i>
                </a>
                {if (($allowedit && $order.status != 4 )|| ($order.owner == $uid && $order.status == 1))}
                    <a ata-toggle="tooltip" data-placement="bottom" title="l&ouml;schen"
                       onclick="return confirm('Willst du diesen Bestellung wirklich l&ouml;schen?')"
                       href="index.php?page={$currentPage}&action=delete&orderID={$order.id}">
                        <i style="color: red;" class="fa fa-trash-o"></i>
                    </a>
                {/if}
            </td>
        </tr>
    {/foreach}


</table>