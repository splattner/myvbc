{if !empty($mySchreibers)}
<div class="card">
	<div class="card-header">
		Meine Schreibereinsätze
	</div>
	<div class="card-body">
		<table class="table table-striped">
		{foreach item=mySchreiber from=$mySchreibers}
			<tr>
				<td>{$mySchreiber.date|date_format:"%a, %d %B %y - %H:%M"}</td>
				<td>{$mySchreiber.name} : {$mySchreiber.gegner}</td>
				<td>{$mySchreiber.ort} / {$mySchreiber.halle}</td>
			</tr>
		{/foreach}
		</table>

	</div>
</div>
{/if}

