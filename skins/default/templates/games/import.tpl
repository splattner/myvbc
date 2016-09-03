<p>
	<a data-toggle="tooltip" data-placement="bottom" title="Zur&uuml;ck zur &Uuml;bersicht" href="index.php?page={$currentPage}&action=main"><i class="fa fa-caret-square-o-left"></i></a>
</p>

<h3>Spiele importieren</h3>

<div ng-controller="GameImportController">
<p>
Team ausw&auml;hlen:
<select ng-change="getGames()" ng-model="selectedTeam" ng-options="team.name for team in teams track by team.id" >
</select>
<a data-toggle="tooltip" ng-click="importGames()" data-placement="bottom" title="Spiele importieren" href="#"><i class="fa fa-plus-square"></i></a>
</p>

<table class="legend">
<tr>
	<td>
		<img src="{$templateDir}/images/icons/bullet_green.png"> Spiel lokal in Datenbank <br />
		<img src="{$templateDir}/images/icons/bullet_orange.png"> Spiel lokal in Datenbank nicht aktuell<br />
		<img src="{$templateDir}/images/icons/bullet_red.png"> Spiel nicht lokal in Datenbank<br />
	</td>
</tr>
</table>

<table class="table table-striped">
    <thead>
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
                <img ng-if="game.local == 1" src="{$templateDir}/images/icons/bullet_green.png">
                <img ng-if="game.local == 2" src="{$templateDir}/images/icons/bullet_orange.png">
                <img ng-if="game.local != 1 && game.local != 2" src="{$templateDir}/images/icons/bullet_red.png">
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