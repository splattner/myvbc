<div class="card">
	<div class="card-header">
		<a class="btn btn-dark" data-toggle="tooltip" data-placement="bottom" title="Zur&uuml;ck zur &Uuml;bersicht" href="index.php?page={$currentPage}&action=notifications"><i class="fa fa-times"></i></a> Subscription hinzuf&uuml;gen
	</div>
	<div class="card-body">
		<form action="index.php?page={$currentPage}&action=addNoteSubscription" method="POST">
			<div class="form-group row">
	            <label for="personID" class="col-sm-4 col-form-label">Person ausw&auml;hlen</label>
	            <div class="col-sm-8">
	                <select class="form-control person-select" name="personID">
						<option value="0" >(Bitte ausw&auml;hlen)</option>
						{foreach item=user from=$users}
							<option value="{$user.id}">{$user.name} {$user.prename}</option>
						{/foreach}
					</select>
	            </div>
	        </div>
	        <div class="form-group row">
	            <label for="type" class="col-sm-4 col-form-label">Type</label>
	            <div class="col-sm-8">
	                <select class="form-control" name="typeID">
						<option value="0" >(Bitte ausw&auml;hlen)</option>
						{foreach item=type from=$types}
							<option value="{$type.id}">{$type.name}</option>
						{/foreach}
					</select>
	            </div>
	        </div>
	        <div class="form-group row">
	            <label for="email" class="col-sm-4 col-form-label">E-Mail</label>
	            <div class="col-sm-8">
	                <input class="form-control" type="checkbox" name="email" value="1">
	            </div>
	        </div>

	        <input class="btn btn-dark" type="submit" name="doAdd" value="hinzuf&uuml;gen">
    	</form>
	</div>
</div>

<script type="text/javascript">
    $('.person-select').chosen();
</script>