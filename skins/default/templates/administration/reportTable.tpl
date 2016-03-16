<h3>Berichte Verwaltung</h3>

<p>
	<a data-toggle="modal" data-target="#myModal" data-tooltip="true" title="Neuer Bericht erfassen" href="#">
		<i class="fa fa-plus-square"></i>
	</a>
</p>

{include file='messages/info.tpl'}

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
							aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">neuer Report</h4>
			</div>
			<div class="modal-body">
				<form id="reportform" class="form-horizontal" action="index.php?page={$currentPage}&action=addReport"
					  method="POST">

					<div class="form-group">
						<label for="title" class="col-sm-3 control-label">Titel</label>

						<div class="col-sm-9">
							<input class="form-control" type="text" id="title" name="title">
						</div>
					</div>

					<div class="form-group">
						<label for="query" class="col-sm-3 control-label">Wuery</label>

						<div class="col-sm-9">
							<textarea lass="form-control" id="query" name="query" rows="20" cols="40"></textarea>
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

<table class="wide">
<tr>
	<th>&nbsp;</th>
	<th>Titel</th>
	<th>&nbsp;</th>
</tr>

{foreach item=report from=$reports}
<tr>
	<td><img src="{$templateDir}/images/icons/bullet_green.png""></td>
	<td>{$report.title}</td>
	<td align="right">
		<a class="icons" data-toggle="tooltip" data-placement="bottom" title="Report bearbeiten" href="index.php?page={$currentPage}&action=editReport&reportID={$report.id}">
			<i class="fa fa-pencil-square-o"></i>
		</a>
		<a onclick="return confirm('Willst du diesen Eintrag wirklich l&ouml;schen?')" data-toggle="tooltip" data-placement="bottom" title="Report l&ouml;schen" href="index.php?page={$currentPage}&action=deleteReport&reportID={$report.id}">
			<i style="color: red;" class="fa fa-trash-o"></i>
		</a>

	</td>
</tr>
{/foreach}
</table>