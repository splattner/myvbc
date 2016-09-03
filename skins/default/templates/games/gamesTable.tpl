<div ng-controller="GameController">
<p>
	<a data-toggle="tooltip" data-placement="bottom" title="Spiele importieren" href="index.php?page={$currentPage}&action=import"><i class="fa fa-cloud-download"></i></a>
</p>

<p>
Team ausw&auml;hlen:
<select ng-model="selectedTeam" ng-Change="changeTeam()">
    <option value="0">Alle Teams</option>
    <option ng-repeat="team in teams" value="[[ team.id ]]">[[ team.name ]]</option>
</select>
</p>


<table class="wide">
<tr>

	<th width="20%">Datum / Zeit</th>
	<th width="15%">Team</th>
	<th width="20%">Gegner</th>
	<th width="20%">Ort / Halle</th>
	<th width="13%">Schreiber</th>
	<th width="10%">&nbsp;</th>
</tr>
    <tr ng-repeat="game in games">

        <td>[[ game.date ]]</td>
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
            <a ng-if="game.heimspiel == 1" data-toggle="tooltip" data-placement="bottom" title="Schreiber verwalten"
               href="index.php?page=games&action=editSchreiber&gameID=[[game.id]]">
                <i class="fa fa-users"></i>
            </a>

        </td>
    </tr>
</table>
</div>
