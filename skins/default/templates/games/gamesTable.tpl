<div ng-controller="GameController">
<a class="btn btn-outline-dark" data-toggle="tooltip" data-placement="bottom" title="Spiele importieren" href="index.php?page={$currentPage}&action=import"><i class="fas fa-cloud-download-alt"></i></a>


<div class="modal fade" id="gameDetailed" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Details</h4>
            </div>
            <div class="modal-body">
                <div class="container">
                  <table class="table">

                  <tbody>
                    <tr ng-repeat="(key, value) in gameDetailed">
                      <td> [[key]] </td> <td> [[ value ]] </td>
                    </tr>
                  </tbody>
                </table>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Schliessen</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="teamDetailed" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Details</h4>
            </div>
            <div class="modal-body">
                <div class="container">
                  <table class="table">

                  <tbody>
                    <tr ng-repeat="(key, value) in teamDetailed">
                      <td> [[key]] </td> <td> [[ value ]] </td>
                    </tr>
                  </tbody>
                </table>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Schliessen</button>
            </div>
        </div>
    </div>
</div>


<div class="form-row">
  <div class="form-group col-md-3">
    <label for="team">Team ausw&auml;hlen:</label>
    <select id="team" class="form-control" ng-model="selectedTeam" ng-Change="changeTeam()">
      <option ng-repeat="team in teams" value="[[ team.id ]]">[[ team.name ]]</option>
    </select>
    <input type="checkbox" value="1" ng-model="onlyHeimspiele" /> nur Heimspiele
  </div>
</div>


<table class="table table-striped">
    <thead class="thead-inverse">
        <tr>
            <th width="15%">Datum / Zeit</th>
            <th width="15%">Team</th>
            <th width="20%">Gegner </th>
            <th width="20%">Ort / Halle</th>
            <th width="13%">Schreiber/Schiedsrichter</th>
            <th width="15%">&nbsp;</th>
        </tr>
    </thead>
    <tbody>
        <tr ng-repeat="game in games | filter:filterHeimspiele">

            <td>[[ game.date | dateToISO | date : "dd. MMM yyyy - HH:mm" ]]</td>
            <td>
              <span class="badge badge-secondary">[[ game.name ]]</span>
            </td>
            <td>
              <a href="#" ng-click="getAddressesByTeam([[game.extid]], [[game.heimspiel]])" data-target="#teamDetailed" data-toggle="modal" data-tooltip="true" data-placement="bottom" class="badge badge-secondary">[[ game.gegner ]]
                <i class="fas fa-info-circle"></i>
              </a>

            </td>
            <td>[[ game.ort ]] / [[ game.halle ]] </td>
            <td>
                <span ng-if="game.heimspiel == 1" ng-repeat="schreiber in game.schreiber">
                    [[ schreiber.prename ]] [[ schreiber.name ]] <span ng-if="(schreiber.type) == 0" ><i class="fas fa-pen"></i></span><span ng-if="(schreiber.type) > 0" ><i class="fas fa-asterisk"></i> Schiedsrichter </span>
                </span>

                <span ng-if="(game.schreiber).length == 0 && game.heimspiel == 1">
                    <i>Keine Schreiber</i>
                </span>

            </td>
            <td align="right">
              <a class="btn btn-outline-dark" ng-click="getGameDetailed([[game.extid]])" data-target="#gameDetailed" data-toggle="modal" data-tooltip="true" data-placement="bottom" title="Details"
                 href="#">
                  <i class="fas fa-info-circle"></i>
              </a>
              <a class="btn btn-outline-dark" ng-if="game.heimspiel == 1" data-toggle="tooltip" data-placement="bottom" title="Schreiber verwalten"
                 href="index.php?page=games&action=editSchreiber&gameID=[[game.id]]">
                  <i class="fas fa-users"></i>
              </a>
            </td>
        </tr>
    </tbody>
</table>
</div>
