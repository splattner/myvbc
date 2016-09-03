<div data-gameID="{$gameID}" ng-controller="SchreiberController">
<table class="edit">
	<tr>
		<th width="30%">
			Schreiber zu Spiel hinzuf&uuml;gen
		</th>
		<th width="70%" style="text-align: right">
			<a data-toggle="tooltip" data-placement="bottom" title="Zur&uuml;ck zur &Uuml;bersicht" href="index.php?page={$currentPage}&action=main"><i style="color:red" class="fa fa-times"></i></a>
		</th>
	</tr>
	<tr>
		<td width="30%">Spiel</td>
		<td width="70%">[[game.teamname]] : [[ game.gegner]]</td>
	</tr>
	<tr>
		<td width="30%">Datum / Zeit</td>
		<td width="70%">[[ game.datum]]</td>
	</tr>
	<tr>
		<td width="30%">Ort / halle</td>
		<td width="70%">[[ game.ort]] - [[ game.halle]]</td>
	</tr>
	<tr>
		<td width="30%">Schreiber</td>
		<td width="70%">
            <table class="schreiber">
                    <tr ng-repeat="schreiber in schreibers">
                        <td><img src="{$templateDir}/images/icons/bullet_green.png"></td>
                        <td>[[ schreiber.prename]] [[ schreiber.name]] </td>
                        <td><a ng-click="removeSchreiber([[schreiber.id]])" href="#" data-toggle="tooltip" data-placement="bottom" title="Diesen Schreiber vom Spiel entfernen">
                                <i style="color: red;" class="fa fa-trash-o"></i>
                            </a>
                        </td>
                    </tr>
                <tr>
                    <td><img src="{$templateDir}/images/icons/bullet_red.png"></td>
                    <td>
                        <select data-placeholder-text-single="'Bitte Person ausw&auml;hlen'" ng-change="getSchreiberInfo()" ng-model="selectedSchreiber" ng-options="schreiber.prename + ' ' + schreiber.name for schreiber in allSchreiber track by schreiber.id" >
                            <option value=""></option>
                        </select>
                    </td>
                    <td>
                        <a href="#" ng-click="addSchreiber()" data-toggle="tooltip" data-placement="bottom" title="Diesen Schreiber dem Spiel hinzuf&uuml;gen">
                            <i class="fa fa-plus-square"></i>
                        </a>
                    </td>
            </table>
		</td>
	</tr>
	<tr>
		<td width="30%"></td>
		<td width="70%">
			<div ng-if="!schreiberInfo" >
				<p>Bitte w&auml;hlen Sie zuerst einen Schreiber aus, <br />anschliessend werden hier die Informationen angezeigt!</p>
			</div>

            <p ng-if="schreiberInfo">
                Anzahl Schreibereins&auml;tze: [[schreiberInfo.count]]
            </p>

            <p ng-if="(schreiberInfo.games).length > 0">
                <b>Achtung:</b> Diese Person hat bereits selbst Spiele an diesem Tag:
            </p>

            <ul ng-if="(schreiberInfo.games).length > 0" style="list-style-image:url({$templateDir}/images/icons/bullet_red.png)">
                <li ng-repeat="game in schreiberinfo.game">[[ game.date ]], [[ game.ort]] - [[game.halle]]</li>
            </ul>

            <p ng-if="(schreiberInfo.games).length == 0">Keine anderen Spiele an diesem Tag</p>

		</td>
	</tr>
	<tr>
		<td colspan="2"><hr /></td>
	</tr>
	<tr>
		<td colspan="2">
			<p>
				<b>Vorschl&aumlge</b>: Personen die an diesem Tag, aber nicht zur gleichen Zeit, Heimspiele haben:
			</p>
			<ul style="list-style-image:url({$templateDir}/images/icons/bullet_green.png)">
				<li ng-repeat="proposal in schreiberproposal">
                    [[ proposal.prename ]] [[ proposal.name ]], Schreibereins&auml;tze: [[ proposal.anzahl ]] <br />
                        [[ proposal.date ]], [[ proposal.ort ]] - [[ proposal.halle ]]
                </li>
				<li ng-if="schreiberproposal.length == 0">Keine Vorschl&auml;ge, da keine anderen Heimspiele an diesem Tag</li>

			</ul>
		</td>

</table>
</div>