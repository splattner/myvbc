<div ng-controller="GameController">
<a class="btn btn-outline-dark" data-toggle="tooltip" data-placement="bottom" title="Spiele importieren" href="index.php?page={$currentPage}&action=import"><i class="fas fa-cloud-download-alt"></i></a>


<div class="form-row">
  <div class="form-group col-md-3">
    <label for="team">Team ausw&auml;hlen:</label>
    <select id="team" class="form-control" ng-model="selectedTeam" ng-Change="changeTeam()">
      <option ng-repeat="team in teams" value="[[ team.id ]]">[[ team.name ]]</option>
    </select>
  </div>
</div>


<table class="table table-striped">
    <thead class="thead-inverse">
        <tr>
            <th width="20%">Datum / Zeit</th>
            <th width="15%">Team</th>
            <th width="20%">Gegner</th>
            <th width="20%">Ort / Halle</th>
            <th width="13%">Schreiber</th>
            <th width="10%">&nbsp;</th>
        </tr>
    </thead>
    <tbody>
        <tr ng-repeat="game in games">

            <td>[[ game.date | dateToISO | date : "dd. MMM yyyy - HH:mm" ]]</td>
            <td>[[ game.name ]]</td>
            <td>[[ game.gegner ]]</td>
            <td>[[ game.ort ]] / [[ game.halle ]]</td>
            <td>
                <span ng-if="game.heimspiel == 1" ng-repeat="schreiber in game.schreiber">
                    [[ schreiber.prename ]] [[ schreiber.name ]]
                </span>

                <span ng-if="(game.schreiber).length == 0 && game.heimspiel == 1">
                    <i>Keine Schreiber</i>
                </span>

            </td>
            <td align="right">
                <a class="btn btn-outline-dark" ng-if="game.heimspiel == 1" data-toggle="tooltip" data-placement="bottom" title="Schreiber verwalten"
                   href="index.php?page=games&action=editSchreiber&gameID=[[game.id]]">
                    <i class="fas fa-users"></i>
                </a>

            </td>
        </tr>
    </tbody>
</table>
</div>
