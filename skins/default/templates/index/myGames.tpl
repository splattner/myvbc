<div class="card">
	<div class="card-header">
		Meine Spiele
	</div>
	<div class="card-body">
		<table class="table table-striped">
			{foreach item=myGame from=$myGames}
				<tr>
					<td>{$myGame.date|date_format:"%a, %d. %B %Y"}</td>
					<td>{$myGame.date|date_format:"%H:%M"}</td>
					<td>{$myGame.name}</td>
					<td>{$myGame.gegner}</td>

					<td>{$myGame.ort} / {$myGame.halle}</td>
				</tr>
			{/foreach}
		</table>

	</div>
</div>



