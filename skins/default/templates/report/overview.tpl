<form action="index.php" method="GET">
<input type="hidden" name="page" value="{$currentPage}" />
<input type="hidden" name="action" value="getReport" />
<p>
Bericht ausw&auml;hlen:
<select name="reportID">
	{foreach item=report from=$reports}
		<option value="{$report.id}">{$report.title}</option>
	{/foreach}
</select>
<input class="btn btn-primary" type="submit" value="anzeigen" />

</p>
</form>