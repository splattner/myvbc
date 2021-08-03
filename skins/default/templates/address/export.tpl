<div class="card">
	<h4 class="card-header">
		<a class="btn btn-dark" data-toggle="tooltip" data-placement="bottom" title="Zur&uuml;ck zur &Uuml;bersicht" href="index.php?page={$currentPage}&action=main">
			<i class="fas fa-times"></i>
		</a>
		Daten für ClubDesk exportieren
	</h4>
	<div class="card-body">
		<form action="index.php?page={$currentPage}&action=export" method="POST">
		<div class="container">
			<div class="form-group row">
				

				<div class="col-sm-12">
                    <div class="form-check">
					    <input class="form-check-input" type="checkbox" checked="checked" name="onlyActive" value="1" id="onlyActive">
                        <label for="onlyActive" class="class="form-check-label">Nur aktive exportieren</label>
                    </div>
				</div>
			</div>

			<div class="form-group row">
				<div class="col-sm-offset-2 col-sm-8">
					<button type="submit" class="btn btn-dark" name="doExport" >exportieren</button>
				</div>
			</div>
		</div>
		
        </form>
	</div>
</div>

{include file='messages/info.tpl'}

