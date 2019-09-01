<div class="card">
	<h4 class="card-header">
		<a class="btn btn-dark" data-toggle="tooltip" data-placement="bottom" title="Zur&uuml;ck" href="index.php?page={$currentPage}&action=report"><i class="fas fa-times"></i></a> Bericht bearbeiten
	</h4>
	<div class="card-body">
		<form action="index.php?page={$currentPage}&action=editReport&reportID={$report.id}" method="POST">
			<div class="form-group row">
				<div class="col-sm-2">Titel</div>
				<div class="col-sm-10">
					<input class="form-control" type="text" id="extid" name="title" value="{$report.title}">
				</div>
			</div>
			<div class="form-group row">
				<div class="col-sm-2">Query</div>
				<div class="col-sm-10">
					<textarea class="form-control" id="query" name="query" rows="20" cols="40">{$report.query}</textarea>
				</div>
			</div>

			<input class="btn btn-dark" type="submit" name="doEdit" value="bearbeiten" />
		</form>
	</div>
</div
