<div class="panel panel-default">
	<div class="panel-heading">
		Meine Daten
		<a  data-toggle="tooltip" data-placement="bottom" title="Meine Daten bearbeiten" href="index.php?page=mydata&action=edit">
			<i class="fa fa-pencil-square-o"></i>
		</a>
		<a  data-toggle="modal" data-target="#myModal" title="Meine Password &auml;ndern" href="#">
			<i class="fa fa-key"></i>
		</a>

	</div>
	<div class="panel-body">
		<p class="hightlight">
			{$user.prename} {$user.name}<br />
			{$user.address}<br />
			{$user.plz} {$user.ort}
		</p>

		<p class="hightlight">
			Telephon: {$user.phone}<br />
			Mobile: {$user.mobile}<br />
			E-Mail: {$user.email}<br />
		</p>
	</div>
</div>


<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
							aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Passwort &auml;ndern</h4>
			</div>
			<div class="modal-body">
				<form id="teamform" class="form-horizontal" action="index.php?page=mydata&action=editPassword"
					  method="POST">

					<div class="form-group">
						<label for="password" class="col-sm-3 control-label">Password</label>

						<div class="col-sm-9">
							<input class="form-control" type="password" id="password" name="password">
						</div>
					</div>

					<div class="form-group">
						<label for="confirm" class="col-sm-3 control-label">Passwort best&auml;tigen</label>

						<div class="col-sm-9">
							<input class="form-control" type="password" id="confirm" name="confirm">
						</div>
					</div>

				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Schliessen</button>
				<button type="submit" class="btn btn-primary" name="doEdit" form="teamform">&auml;ndern</button>

			</div>
		</div>
	</div>
</div>