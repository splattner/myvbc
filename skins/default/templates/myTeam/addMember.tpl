{include file='messages/info.tpl'}

<div class="card">
    <h4 class="card-header">
        <a class="btn btn-dark" data-toggle="tooltip" data-placement="bottom" title="Zur&uuml;ck zur &Uuml;bersicht" href="index.php?page={$currentPage}&action=main&teamID={$teamID}"><i class="fas fa-times"></i></a> Mitglied zu Team hinzuf&uuml;gen
    </h4>
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

					{if $canAddMember}
					<p>
						<a class="btn btn-dark" data-toggle="tooltip" data-placement="bottom" title="Neue Person erfassen"  href="index.php?page={$currentPage}&action=new&teamID={$teamID}"><i class="fas fa-plus-square"></i></a>
						Wenn eine Person noch nicht im System erfasst ist, k&ouml;nnen Sie diese hier hinzuf&uuml;gen.
					</p>
				{/if}
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
