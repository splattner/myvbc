<div class="card">
	<h4 class="card-header">
		Passwort &auml;ndern
	</h4>
	<div class="card-body">
		<form action="index.php?page={$currentPage}&action=changePassword" method="POST">
			<div class="form-group row">
				<div class="col-sm-2">Person ausw&auml;hlen</div>
				<div class="col-sm-10">
					<select class="form-control person-select" name="personID">
						<option value="0" >(Bitte ausw&auml;hlen)</option>
						{foreach item=user from=$users}
							<option value="{$user.id}">{$user.prename} {$user.name}</option>
						{/foreach}
					</select>
				</div>
			</div>
			<div class="form-group row">
				<div class="col-sm-2">Passwort</div>
				<div class="col-sm-10">
					<input class="form-controltype="password" name="password" />
				</div>
			</div>

			<input class="btn btn-dark" type="submit" name="changePassword" value="&auml;ndern">
		</form>
	</div>
</div>

<script type="text/javascript">
	$('.person-select').chosen();
</script>