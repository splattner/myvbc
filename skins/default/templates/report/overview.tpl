<form class="form-inline" action="index.php" method="GET">

	<input type="hidden" name="page" value="{$currentPage}" />
	<input type="hidden" name="action" value="getReport" />

	<div class="form-group">
		<select class="form-control form-control-sm" name="reportID">
			{foreach item=report from=$reports}
				<option value="{$report.id}">{$report.title}</option>
			{/foreach}
		</select>
	</div>

	<button class="btn ml-3 btn-outline-dark" type="submit"><i class="fas fa-book" aria-hidden="true"></i> anzeigen</button>
</form>
