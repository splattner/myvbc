
{if $canAddTeam}
<a class="btn btn-outline-dark" data-toggle="modal" data-target="#myModal" data-tooltip="true" title="Neue Team erfassen" href="#">
    <i class="fas fa-plus-square"></i>
</a>
{/if}
{include file='messages/info.tpl'}

<div ng-controller="TeamImportController" class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">neues Team</h4>
            </div>
            <div class="modal-body">
                <div class="container">
                    <form id="teamform" action="index.php?page={$currentPage}&action=new"
                          method="POST">

                        <div class="form-group row">
                            <label for="extid" class="col-sm-3 col-form-label">Von SwissVolley importieren</label>

                            <div class="col-sm-9">
                          		<select class="form-control" ng-change="selectTeam()" ng-model="selectedTeam" ng-options="team.Caption + ' - ' + team.LeagueCaption + ' - ' + team.Gender for team in teams track by team.ID_team" >
                          		</select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="extid" class="col-sm-3 col-form-label">Externe ID</label>

                            <div class="col-sm-9">
                                <input ng-readonly="!isEmpty(selectedTeam)" ng-model="selectedTeam.ID_team" class="form-control" type="text" id="extid" name="extid">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-sm-3 col-form-label">Name</label>

                            <div class="col-sm-9">
                                <input class="form-control" type="text" id="name" name="name">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="extname" class="col-sm-3 col-form-label">Externer Name</label>

                            <div class="col-sm-9">
                                <input ng-readonly="!isEmpty(selectedTeam)" ng-model="selectedTeam.Caption" class="form-control" type="text" id="extname" name="extname">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="liga" class="col-sm-3 col-form-label">Liga</label>

                            <div class="col-sm-9">
                                <input class="form-control" type="text" id="liga" name="liga">
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="extliga" class="col-sm-3 col-form-label">Externe Liga</label>

                            <div class="col-sm-9">
                                <input ng-readonly="!isEmpty(selectedTeam)" ng-model="selectedTeam.LeagueCaption" class="form-control" type="text" id="extliga" name="extliga">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="typ" class="col-sm-3 col-form-label">Type</label>

                            <div class="col-sm-9">
                                <select class="form-control" name="typ" readonly>
                                    <option value="1">SwissVolley (Volley-Manager)</option>


                                </select>
                            </div>
                        </div>


                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Schliessen</button>
                <button type="submit" class="btn btn-dark" name="doNew" form="teamform">weiter</button>

            </div>
        </div>
    </div>
</div>


<table class="table table-striped table-sm">
    <thead class="thead-inverse">
        <tr>
            <th>Externer Namen</th>
            <th>Team</th>
            <th>Liga</th>
            <th>&nbsp;</th>
        </tr>
    </thead>
    <tbody>
    {foreach item=team from=$teams}
        <tr>
            <td>{$team.extname}</td>
            <td>{$team.name}</td>
            <td>{$team.liga}</td>
            <td align="right">
              {if $canEditTeam}
                <a class="btn btn-outline-dark" data-toggle="tooltip" data-placement="bottom" title="Team bearbeiten" href="index.php?page={$currentPage}&action=edit&teamID={$team.id}">
                    <i class="fas fa-edit"></i>
                </a>
              {/if}
              {if $canViewTeam}
                <a class="btn btn-outline-dark" data-toggle="tooltip" data-placement="bottom" title="Team Mitglieder bearbeiten" href="index.php?page={$currentPage}&action=member&teamID={$team.id}">
                    <i class="fas fa-users"></i>
                </a>
              {/if}
              {if $canDeleteTeam}
                <a class="btn btn-outline-danger" onclick="return confirm('Willst du diesen Eintrag wirklich l&ouml;schen?')" data-toggle="tooltip" data-placement="bottom" title="Team löschen" href="index.php?page={$currentPage}&action=delete&teamID={$team.id}">
                    <i class="fas fa-trash"></i>
                </a>
              {/if}
            </td>
        </tr>
    {/foreach}
    </tbody>
</table>
