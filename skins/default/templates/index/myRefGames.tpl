<div class="card">
	<div class="card-header">
		Meine Schiedsrichtereins&auml;tze
	</div>
	<div class="card-body">
		<table class="table table-striped">

			{foreach item=refGame from=$refGames}
				<tr>
					<td>{$refGame.datum|date_format:"%a, %d %B %y - %H:%M"}</td>
					<td>{$refGame.heimteam}</td>
					<td>{$refGame.gastteam}</td>
					<td>{$refGame.ort} / {$refGame.halle}</td>
				</tr>
			{/foreach}
		</table>

	</div>
</div>



