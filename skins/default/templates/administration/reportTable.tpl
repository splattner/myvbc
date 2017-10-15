<h3>Berichte Verwaltung</h3>

<a class="btn btn-outline-dark" data-toggle="modal" data-target="#myModal" data-tooltip="true" title="Neuer Bericht erfassen" href="#">
	<i class="fa fa-plus-square"></i>
</a>


{include file='messages/info.tpl'}

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="myModalLabel">neuer Report</h4>
			</div>
			<div class="modal-body">
				<form id="reportform" action="index.php?page={$currentPage}&action=addReport"
					  method="POST">

					<div class="form-group row">
						<label for="title" class="col-sm-3 col-form-label">Titel</label>

						<div class="col-sm-9">
							<input class="form-control" type="text" id="title" name="title">
						</div>
					</div>

					<div class="form-group row">
						<label for="query" class="col-sm-3 col-form-label">Query</label>

						<div class="col-sm-9">
							<textarea cass="form-control" id="query" name="query" rows="20" cols="40"></textarea>
						</div>
					</div>

				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Schliessen</button>
				<button type="submit" class="btn btn-primary" name="doNew" form="reportform">weiter</button>

			</div>
		</div>
	</div>
</div>

<table class="table table-striped table-sm">
	<thead class="thead-inverse">
		<tr>
			<th>Titel</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
		{foreach item=report from=$reports}
		<tr>
			<td>{$report.title}</td>
			<td align="right">
				<a class="btn btn-outline-dark" data-toggle="tooltip" data-placement="bottom" title="Report bearbeiten" href="index.php?page={$currentPage}&action=editReport&reportID={$report.id}">
					<i class="fa fa-pencil-square-o"></i>
				</a>
				<a class="btn btn-outline-danger" onclick="return confirm('Willst du diesen Eintrag wirklich l&ouml;schen?')" data-toggle="tooltip" data-placement="bottom" title="Report l&ouml;schen" href="index.php?page={$currentPage}&action=deleteReport&reportID={$report.id}">
					<i style="color: red;" class="fa fa-trash-o"></i>
				</a>

			</td>
		</tr>
		{/foreach}
	</tbody>
</table>