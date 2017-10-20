<a class="btn btn-outline-dark" data-toggle="modal" data-target="#myModal" data-tooltip="true" title="Neue Schl&uuml;ssel erfassen" href="#">
    <i class="fa fa-plus-square"></i>
</a>

{include file='messages/info.tpl'}

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">neuer Schl&uuml;ssel</h4>
            </div>
            <div class="modal-body">
                <div class="container">
                    <form id="keyform" class="form-horizontal" action="index.php?page={$currentPage}&action=new"
                          method="POST">

                        <div class="form-group row">
                            <label for="extid" class="col-sm-3 col-form-label">Person</label>

                            <div class="col-sm-9">
                                <select class="person-select" name="person">
                                    <option value="0" >(Bitte ausw&auml;hlen)</option>
                                    {foreach item=user from=$users}
                                        <option value="{$user.id}">{$user.name} {$user.prename} </option>
                                    {/foreach}
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-sm-3 col-form-label">Bezeichnung</label>

                            <div class="col-sm-9">
                                <input class="form-control" type="text" id="label" name="label">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="extname" class="col-sm-3 col-form-label">Nr</label>

                            <div class="col-sm-9">
                                <input class="form-control" type="text" id="nr" name="nr">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Schliessen</button>
                <button type="submit" class="btn btn-dark" name="doNew" form="keyform">weiter</button>

            </div>
        </div>
    </div>
</div>


<table class="table table-striped table-sm">
    <thead class="thead-inverse">
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
                <a class="btn btn-outline-dark" onclick="return confirm('Willst du diesen Eintrag wirklich l&ouml;schen?')" data-toggle="tooltip" data-placement="bottom" title="Schl&uuml;ssel löschen" href="index.php?page={$currentPage}&action=delete&keyID={$key.id}">
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