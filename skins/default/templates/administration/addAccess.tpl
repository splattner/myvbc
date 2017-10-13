<div class="card">
	<div class="card-header">
		<a class="btn btn-dark" data-toggle="tooltip" data-placement="bottom" title="Zur&uuml;ck zur &Uuml;bersicht" href="index.php?page={$currentPage}&action=access"><i class="fa fa-times"></i></a> Zugang hinzuf&uuml;gen
	</div>
	<div class="card-body">
		<form action="index.php?page={$currentPage}&action=addAccess" method="POST">
		<div class="form-group row">
            <label for="personID" class="col-sm-4 col-form-label">Person ausw&auml;hlen</label>
            <div class="col-sm-8">
				<select style="width:80%;" class="person-select form-control" name="person">
					<option value="0" >(Bitte ausw&auml;hlen)</option>
					{foreach item=user from=$users}
						<option value="{$user.id}">{$user.prename} {$user.name}</option>
					{/foreach}
				</select>
            </div>
        </div>
        <div class="form-group row">
            <label for="group" class="col-sm-4 col-form-label">Gruppe</label>
            <div class="col-sm-8">
				<select class="form-control" name="group">
					<option value="0" >(Bitte ausw&auml;hlen)</option>
					{foreach item=group from=$groups}
						<option value="{$group}">{$group}</option>
					{/foreach}
				</select>
            </div>
        </div>
        <input class="btn btn-dark" type="submit" name="doAdd" value="hinzuf&uuml;gen">
        </form>
	</div>
</div>

<script type="text/javascript">
	$('.person-select').chosen();
</script>

