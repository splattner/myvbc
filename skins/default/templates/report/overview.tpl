<form class="form-inline" action="index.php" method="GET">
	
	<input type="hidden" name="page" value="{$currentPage}" />
	<input type="hidden" name="action" value="getReport" />
	
	<div class="form-group">
		Bericht ausw&auml;hlen:
		<select class="form-control form-control-sm" name="reportID">
			{foreach item=report from=$reports}
				<option value="{$report.id}">{$report.title}</option>
			{/foreach}
		</select>
	</div>

	<button class="btn btn-outline-dark" type="submit"><i class="fa fa-book" aria-hidden="true"></i>anzeigen</button>
</form>