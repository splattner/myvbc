<div data-gameID="{$gameID}" ng-controller="SchreiberController">
	<div class="card">
		<h4 class="card-header">
			<a class="btn btn-dark" data-toggle="tooltip" data-placement="bottom" title="Zur&uuml;ck zur &Uuml;bersicht" href="index.php?page={$currentPage}&action=main"><i class="fas fa-times"></i></a>
			Schreiber zu Spiel hinzuf&uuml;gen
		</h4>
		<div class="card-body">
			<div class="form-group row">
				<div class="col-sm-2">Spiel</div>
				<div class="col-sm-10">
					[[game.teamname]] : [[ game.gegner]]
				</div>
			</div>
			<div class="form-group row">
				<div class="col-sm-2">Datum / Zeit</div>
				<div class="col-sm-10">
					[[ game.datum ]]
				</div>
			</div>
			<div class="form-group row">
				<div class="col-sm-2">Ort / Halle</div>
				<div class="col-sm-10">
					[[ game.ort ]] - [[ game.halle]]
				</div>
			</div>
			<div class="form-group row">
				<label for="schreiber" class="col-sm-2 col-form-label">Schreiber</label>
				<div class="col-sm-10">
					<table class="table table-sm">
	                    <tr ng-repeat="schreiber in schreibers">
	                        <td>[[ schreiber.prename]] [[ schreiber.name]] <span ng-if="(schreiber.type) == 0" ><i class="fas fa-pen"></i></span><span ng-if="(schreiber.type) > 0"><i class="fas fa-asterisk"></i> / Schiedsrichter</span></td>
	                        <td>
	                        	<a class="btn btn-danger" ng-click="removeSchreiber([[schreiber.id]])" href="#" data-toggle="tooltip" data-placement="bottom" title="Diesen Schreiber vom Spiel entfernen">
	                                <i class="fas fa-trash"></i>
	                            </a>
	                        </td>
	                    </tr>
		                <tr>
		                    <td>
		                        <select data-placeholder-text-single="'Bitte Person ausw&auml;hlen'" ng-change="getSchreiberInfo()" ng-model="selectedSchreiber" ng-options="schreiber.prename + ' ' + schreiber.name for schreiber in allSchreiber track by schreiber.id" >
		                            <option value=""></option>
		                        </select>
								<input type="checkbox" ng-model="selectedTypeSchiri" /> Schiedsrichtereinsatz <i class="fas fa-asterisk"></i>
		                    </td>
		                    <td>
		                        <a class="btn btn-dark" href="#" ng-click="addSchreiber()" data-toggle="tooltip" data-placement="bottom" title="Diesen Schreiber dem Spiel hinzuf&uuml;gen">
		                            <i class="fas fa-plus-square"></i>
		                        </a>
		                    </td>
		            </table>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-2 col-form-label"></label>
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
	                <li ng-repeat="game in (schreiberInfo.games)">[[ game.date ]], [[ game.ort]] - [[game.halle]]</li>
	            </ul>

	            <p ng-if="(schreiberInfo.games).length == 0">Keine anderen Spiele an diesem Tag</p>
			</div>
			<div class="form-group row">
				<div class="col-sm-12">
					<p>
						<b>Vorschl&auml;ge</b>: Personen die an diesem Tag, aber nicht zur gleichen Zeit, Heimspiele haben:
					</p>
					<ul>
						<li ng-repeat="proposal in schreiberproposal">
		                    [[ proposal.prename ]] [[ proposal.name ]], Schreibereins&auml;tze: [[ proposal.anzahl ]] <br />
		                        [[ proposal.date ]], [[ proposal.ort ]] - [[ proposal.halle ]]
		                </li>
						<li ng-if="schreiberproposal.length == 0">Keine Vorschl&auml;ge, da keine anderen Heimspiele an diesem Tag</li>

					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
