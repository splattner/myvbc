<div class="card">
	<h4 class="card-header">
		Zugang einrichten
	</h4>
	<div class="card-body">
		<form action="index.php?page={$currentPage}&action=createAccess&step2" method="POST">
			<div class="form-group row">
	            <label for="personID" class="col-sm-4 col-form-label">Person ausw&auml;hlen</label>
	            <div class="col-sm-8">
	                <select style="width:80%;" class="form-control person-select" name="personID">
					<option value="0" >(Bitte ausw&auml;hlen)</option>
					{foreach item=user from=$users}
						<option value="{$user.id}">{$user.prename} {$user.name}</option>
					{/foreach}
				</select>
	            </div>
        	</div>
        	<input class="btn btn-dark" type="submit" name="doChoose" value="ausw&auml;hlen">
		</form>

	</div>
</div>

<script type="text/javascript">
	$('.person-select').chosen();
</script>
