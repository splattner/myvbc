<table class="overview">
	<tr>
		<th colspan="3">
			Meine Teams
		</th>
	</tr>
	<tr>
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
				<a href="index.php?page=myteam&action=main&teamID={$myTeam.id}" {popup caption="Team Liste" text="Teamliste mit Kontaktdaten anzeigen. Captain/Teamverantwortliche und Trainer können hier Personen den Teams zuordnen"}><img src="{$templateDir}/images/icons/group.png"></a>
			</td>
		</tr>
	{/foreach}
	</tr>
</table>