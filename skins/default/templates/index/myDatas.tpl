<div class="card">
	<h4 class="card-header">
		Meine Daten
		<a class="btn btn-outline-dark" data-toggle="tooltip" data-placement="bottom" title="Meine Daten bearbeiten" href="index.php?page=mydata&action=edit">
			<i class="fa fa-pencil-square-o"></i>
		</a>
		<a class="btn btn-outline-dark		" data-tooltip="true" data-placement="bottom" data-toggle="modal" data-target="#myModal" title="Mein Password &auml;ndern" href="#">
			<i class="fa fa-key"></i>
		</a>
	</h4>
	<div class="card-body">
		<p>
			{$user.prename} {$user.name}<br />
			{$user.address}<br />
			{$user.plz} {$user.ort} <br />
			{if $user.phone != ""}<i class="fa fa-phone"></i>  {$user.phone}<br />{/if}
			{if $user.mobile != ""}<i class="fa fa-mobile" ></i> {$user.mobile}<br />{/if}
			E-Mail: {$user.email}<br />
		</p>

		<p>
			Die folgenden Schl&uuml;ssel sind mir zugeordnet:
		</p>

		<ul>
			{foreach item=key from=$keys}
			<li>
				 {$key.label} Schl&uuml;ssel seit {$key.lastUpdate|date_format:"%d.%m.%y"}
			</li>
			{/foreach}
			{if empty($keys)}
			<li>
				Keine Schlüssel
			</li>
			{/if}
		</ul>

		<p>
			F&uuml;r Korrekturen am Schl&uuml;ssel Inventar melde dich bitte beim Chef-TK
		</p>

	</div>
</div>


<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="myModalLabel">Passwort &auml;ndern</h4>
			</div>
			<div class="modal-body">
				<div class="container">
					<form id="teamform" action="index.php?page=mydata&action=editPassword" method="POST">

						<div class="form-group row">
							<label for="password" class="col-sm-3 col-form-label">Password</label>

							<div class="col-sm-9">
								<input class="form-control" type="password" id="password" name="password">
							</div>
						</div>

						<div class="form-group row">
							<label for="confirm" class="col-sm-3 col-form-label">Passwort best&auml;tigen</label>

							<div class="col-sm-9">
								<input class="form-control" type="password" id="confirm" name="confirm">
							</div>
						</div>

					</form>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Schliessen</button>
				<button type="submit" class="btn btn-dark" name="doEdit" form="teamform">&auml;ndern</button>

			</div>
		</div>
	</div>
</div>
