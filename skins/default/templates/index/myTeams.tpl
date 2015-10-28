



<div class="panel panel-default">
	<div class="panel-heading">
		Meine Teams
	</div>
	<div class="panel-body">
		<table class="table">
			{foreach item=myTeam from=$myTeams}
				<tr>
					<td style="width: 20px";>
						<img src="{$templateDir}/images/icons/bullet_green.png">
					</td>
					<td style="text-align: left;">
						{$myTeam.name}
						als {$myTeam.typ|replace:"1":"Spieler"|replace:"2":"Captain / Teamverantwortlicher"|replace:"3":"Trainer"|replace:"4":"Sonstige Funktion"}
					</td>
					<td style="text-align: right;">
						<a data-toggle="tooltip" data-placement="bottom" title="Teamliste mit Kontaktdaten " href="index.php?page=myteam&action=main&teamID={$myTeam.id}">
							<i class="fa fa-users"></i>
						</a>
					</td>
				</tr>
			{/foreach}
		</table>
	</div>
</div>

