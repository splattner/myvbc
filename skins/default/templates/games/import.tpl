<a class="btn btn-outline-dark" data-toggle="tooltip" data-placement="bottom" title="Zur&uuml;ck zur &Uuml;bersicht" href="index.php?page={$currentPage}&action=main"><i class="fas fa-caret-square-left"></i></a>


<h3>Spiele importieren</h3>

<div ng-controller="GameImportController">
<div class="form-row">
	<div class="form-group col-md-3">
		<label for="team">Team ausw&auml;hlen:</label>
		<select id="team" class="form-control" ng-change="getGames()" ng-model="selectedTeam" ng-options="team.name for team in teams track by team.id" >
		</select>
		<a class="btn btn-outline-dark" data-toggle="tooltip" ng-click="importGames()" data-placement="bottom" title="Spiele importieren" href="#"><i class="fas fa-plus-square"></i></a>
	</div>
</div>

<table class="legend">
<tr>
	<td>
		<i class="fas fa-check-circle"></i> Spiel lokal in Datenbank <br />
		<i class="fas fa-sync"></i> Spiel lokal in Datenbank nicht aktuell<br />
		<i class="fas fa-times-circle"></i> Spiel nicht lokal in Datenbank<br />
	</td>
</tr>
</table>

<table class="table table-striped">
    <thead class="thead-inverse">
	<tr>
		<th>&nbsp;</th>
		<th>Datum / Zeit</th>
		<th>Begegnung</th>
		<th>Ort</th>
		<th>&nbsp;</th>
	</tr>
    </thead>
    <tbody>
		<tr ng-repeat="game in games">
			<td>

								<i ng-if="game.local == 1" class="fas fa-check-circle"></i>
								<i ng-if="game.local == 2"class="fas fa-sync"></i>
								<i ng-if="game.local != 1 && game.local != 2" class="fas fa-times-circle"></i>
			<td>
				[[ game.datum ]]
			</td>
			<td>
				[[ game.heimteam ]] - [[ game.gastteam ]]
			</td>
			<td>
				[[ game.ort ]] / [[ game.halle ]]
			</td>
		</tr>
    </tbody>
</table>
</div>
