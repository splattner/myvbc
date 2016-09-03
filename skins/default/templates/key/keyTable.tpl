<script src="libs/chosen/chosen.jquery.js"></script>
<link rel="stylesheet" href="libs/chosen/chosen.css">

<p>
    <a data-toggle="modal" data-target="#myModal" data-tooltip="true" title="Neue Schl&uuml;ssel erfassen" href="#">
        <i class="fa fa-plus-square"></i>
    </a>
</p>



{include file='messages/info.tpl'}



<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">neuer Schl&uuml;ssel</h4>
            </div>
            <div class="modal-body">
                <form id="keyform" class="form-horizontal" action="index.php?page={$currentPage}&action=new"
                      method="POST">

                    <div class="form-group">
                        <label for="extid" class="col-sm-3 control-label">Person</label>

                        <div class="col-sm-9">
                            <select class="person-select" name="person">
                                <option value="0" >(Bitte ausw&auml;hlen)</option>
                                {foreach item=user from=$users}
                                    <option value="{$user.id}">{$user.name} {$user.prename} </option>
                                {/foreach}
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="name" class="col-sm-3 control-label">Bezeichnung</label>

                        <div class="col-sm-9">
                            <input class="form-control" type="text" id="label" name="label">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="extname" class="col-sm-3 control-label">Nr</label>

                        <div class="col-sm-9">
                            <input class="form-control" type="text" id="nr" name="nr">
                        </div>
                    </div>




                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Schliessen</button>
                <button type="submit" class="btn btn-primary" name="doNew" form="keyform">weiter</button>

            </div>
        </div>
    </div>
</div>


<table class="table table-striped">
    <thead>
    <tr>
        <th>Person</th>
        <th>Bezeichnung</th>
        <th>Nummer</th>
        <th>Datum</th>
        <th>&nbsp;</th>
    </tr>
    </thead>
    <tbody>
    {foreach item=key from=$keys}
        <tr>
            <td>{$key.person}</td>
            <td>{$key.label}</td>
            <td>{$key.nr}</td>
            <td>{$key.lastUpdate|date_format:"%d.%m.%y"}</td>
            <td align="right">
                </a>
                <a onclick="return confirm('Willst du diesen Eintrag wirklich l&ouml;schen?')" data-toggle="tooltip" data-placement="bottom" title="Schl&uuml;ssel löschen" href="index.php?page={$currentPage}&action=delete&keyID={$key.id}">
                    <i style="color: red;" class="fa fa-trash-o"></i>
                </a>
            </td>
        </tr>
    {/foreach}
    </tbody>
</table>

{literal}
<script type="text/javascript">

    $('.person-select').chosen({width: "100%"});

</script>
{/literal}