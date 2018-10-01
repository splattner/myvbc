<div ng-controller="MyGamesController" class="card">

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
	
	<h4 class="card-header">
		Meine Spiele
	</h4>
	<div class="card-body">
		<table class="table table-striped">


			<tr ng-repeat="game in myGames">

					<td>[[ game.date | dateToISO | date : "dd. MMM yyyy"]]</td>
					<td>[[ game.date | dateToISO | date : "HH:mm" ]]</td>
					<td>
						<span class="badge badge-secondary">[[ game.name ]]</span> /
						<a href="#" ng-click="getAddressesByTeam([[game.extid]], [[game.heimspiel]])" data-target="#teamDetailed" data-toggle="modal" data-tooltip="true" data-placement="bottom" class="badge badge-secondary">[[ game.gegner ]]
							<i class="fas fa-info-circle"></i>
						</a>

					</td>
					<td>[[ game.ort ]] / [[ game.halle ]] </td>
					<td align="right">
						<a class="btn btn-outline-dark" ng-click="getGameDetailed([[game.extid]])" data-target="#gameDetailed" data-toggle="modal" data-tooltip="true" data-placement="bottom" title="Details"
							 href="#">
								<i class="fas fa-info-circle"></i>
						</a>
					</td>
			</tr>
		</table>

	</div>
</div>
