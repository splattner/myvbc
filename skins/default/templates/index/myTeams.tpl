	<div class="card">
	<div class="card-header">
			Meine Teams
	</div>
	<div class="card-body		"	>
		<table class="table">
			{foreach item=myTeam from=$myTeams}
				<tr>
					<td style="text-align: left;">
						{$myTeam.name}
						als {$myTeam.typ|replace:"1":"Spieler"|replace:"2":"Captain / Teamverantwortlicher"|replace:"3":"Trainer"|replace:"4":"Sonstige Funktion"}
					</td>
					<td style="text-align: right;">
						<a class="btn btn-dark" data-toggle="tooltip" data-placement="bottom" title="Teamliste mit Kontaktdaten " href="index.php?page=myteam&action=main&teamID={$myTeam.id}">
							<i class="fa fa-users"></i>
						</a>
					</td>
				</tr>
			{/foreach}
		</table>
	</div>
</div>

