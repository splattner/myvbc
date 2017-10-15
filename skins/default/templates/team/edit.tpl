
<div class="card">
	<h4 class="card-header">
		<a class="btn btn-dark" data-toggle="tooltip" data-placement="bottom" title="Zur&uuml;ck zur &Uuml;bersicht" href="index.php?page={$currentPage}&action=main">
			<i class="fa fa-times"></i>
		</a>
		Team bearbeiten
	</h4>
	<div class="card-body">
		{foreach item=team from=$teams}
		<div class="container">
			<form action="index.php?page={$currentPage}&action=edit&teamID={$team.id}" method="POST">
                <div class="form-group row">
                    <label for="extid" class="col-sm-3 col-form-label">Externe ID</label>

                    <div class="col-sm-9">
                        <input class="form-control" type="text" id="extid" name="extid" value="{$team.extid}"	>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="name" class="col-sm-3 col-form-label">Name</label>

                    <div class="col-sm-9">
                        <input class="form-control" type="text" id="name" name="name" value="{$team.name}">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="extname" class="col-sm-3 col-form-label">Externer Name</label>

                    <div class="col-sm-9">
                        <input class="form-control" type="text" id="extname" name="extname" value="{$team.extname}">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="liga" class="col-sm-3 col-form-label">Liga</label>

                    <div class="col-sm-9">
                        <input class="form-control" type="text" id="liga" name="liga" value="{$team.liga}">
                    </div>
                </div>


                <div class="form-group row">
                    <label for="extliga" class="col-sm-3 col-form-label">Externe Liga</label>

                    <div class="col-sm-9">
                        <input class="form-control" type="text" id="extliga" name="extliga" value="{$team.extliga}">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="typ" class="col-sm-3 col-form-label">Type</label>

                    <div class="col-sm-9">
                        <select class="form-control" name="typ">
                        	{if $team.typ == 1}
								<option value="1" selected="selected">SwissVolley (National)</option>
								<option value="2">Swissvolley Region Solothurn</option>
							{elseif $team.typ == 2}
								<option value="1" >SwissVolley (National)</option>
								<option value="2" selected="selected">Swissvolley Region Solothurn</option>
							{/if}
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-offset-2 col-sm-8">
                        <button type="submit" class="btn btn-dark" name="doEdit" >bearbeiten</button>
                    </div>
                </div>
        	</form>
		</div>
		{/foreach}
	</div>
</div>





