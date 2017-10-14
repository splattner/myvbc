{include file='messages/info.tpl'}

<div class="card">
    <div class="card-header">
        <a class="btn btn-dark" data-toggle="tooltip" data-placement="bottom" title="Zur&uuml;ck zur &Uuml;bersicht" href="index.php?page={$currentPage}&action=member&teamID={$teamID}"><i class="fa fa-times"></i></a> Mitglied zu Team hinzuf&uuml;gen
    </div>
    <div class="card-body">
    	<form action="index.php?page={$currentPage}&action=addMember&teamID={$teamID}" method="POST">
	    	<div class="form-group row">
	            <label for="person" class="col-sm-3 col-form-label">Person ausw&auml;hlen</label>

	            <div class="col-sm-9">
	                <select style="form-control" class="form-control person-select" name="person">
						<option value="0" >(Bitte ausw&auml;hlen)</option>
						{foreach item=user from=$users}
							<option value="{$user.id}">{$user.name} {$user.prename}</option>
						{/foreach}
					</select>
	            </div>
	        </div>
	        <div class="form-group row">
	            <label for="typ" class="col-sm-3 col-form-label">Funktion</label>

	            <div class="col-sm-9">
	                <select class="form-control" name="typ">
						<option value="1">Spieler</option>
						<option value="2">Captain / Teamverantwortlicher</option>
						<option value="3">Trainer</option>
						<option value="4">Sonstige Funktion</option>
					</select>
	            </div>
	        </div>
	        <input type="submit" class="btn btn-dark" name="doAdd" value="hinzuf&uuml;gen">
    	</form>
    </div>
</div>

<script type="text/javascript">
    $('.person-select').chosen();
</script>
