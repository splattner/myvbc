<p>
    <a data-toggle="modal" data-target="#myModal" data-tooltip="true" title="Neue Team erfassen" href="#">
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
                <h4 class="modal-title" id="myModalLabel">neues Team</h4>
            </div>
            <div class="modal-body">
                <form id="teamform" class="form-horizontal" action="index.php?page={$currentPage}&action=new"
                      method="POST">

                    <div class="form-group">
                        <label for="extid" class="col-sm-3 control-label">Externe ID</label>

                        <div class="col-sm-9">
                            <input class="form-control" type="text" id="extid" name="extid">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="name" class="col-sm-3 control-label">Name</label>

                        <div class="col-sm-9">
                            <input class="form-control" type="text" id="name" name="name">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="extname" class="col-sm-3 control-label">Externer Name</label>

                        <div class="col-sm-9">
                            <input class="form-control" type="text" id="extname" name="extname">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="liga" class="col-sm-3 control-label">Liga</label>

                        <div class="col-sm-9">
                            <input class="form-control" type="text" id="liga" name="liga">
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="extliga" class="col-sm-3 control-label">Externe Liga</label>

                        <div class="col-sm-9">
                            <input class="form-control" type="text" id="extliga" name="extliga">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="typ" class="col-sm-3 control-label">Type</label>

                        <div class="col-sm-9">
                            <select class="form-control" name="typ">
                                <option value="1">SwissVolley (National)</option>
                                <option value="2">Swissvolley Region Solothurn</option>

                            </select>
                        </div>
                    </div>


                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Schliessen</button>
                <button type="submit" class="btn btn-primary" name="doNew" form="teamform">weiter</button>

            </div>
        </div>
    </div>
</div>


<table class="wide">
    <tr>
        <th>Externer Namen</th>
        <th>Team</th>
        <th>Liga</th>
        <th>&nbsp;</th>
    </tr>

    {foreach item=team from=$teams}
        <tr>
            <td>{$team.extname}</td>
            <td>{$team.name}</td>
            <td>{$team.liga}</td>
            <td align="right">
                <a class="icons" data-toggle="tooltip" data-placement="bottom" title="Team bearbeiten" href="index.php?page={$currentPage}&action=edit&teamID={$team.id}">
                    <i class="fa fa-pencil-square-o"></i>
                </a>
                <a class="icons" data-toggle="tooltip" data-placement="bottom" title="Team Mitglieder bearbeiten" href="index.php?page={$currentPage}&action=member&teamID={$team.id}">
                    <i class="fa fa-users"></i>
                </a>
                <a onclick="return confirm('Willst du diesen Eintrag wirklich l&ouml;schen?')" data-toggle="tooltip" data-placement="bottom" title="Team löschen" href="index.php?page={$currentPage}&action=delete&teamID={$team.id}">
                    <i style="color: red;" class="fa fa-trash-o"></i>
                </a>
            </td>
        </tr>
    {/foreach}
</table>
