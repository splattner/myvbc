<table class="edit">
	<tr>
		<th width="30%">
			Schreiber zu Spiel hinzuf&uuml;gen
		</th>
		<th width="70%" style="text-align: right">
			<a data-toggle="tooltip" data-placement="bottom" title="Zur&uuml;ck zur &Uuml;bersicht" href="index.php?page={$currentPage}&action=main"><i style="color:red" class="fa fa-times"></i></a>
		</th>
	</tr>
	<tr>
		<td width="30%">Spiel</td>
		<td width="70%">{$game[0].teamname} : {$game[0].gegner}</td>
	</tr>
	<tr>
		<td width="30%">Datum / Zeit</td>
		<td width="70%">{$game[0].datum}</td>
	</tr>
	<tr>
		<td width="30%">Ort / halle</td>
		<td width="70%">{$game[0].ort} - {$game[0].halle}</td>
	</tr>
	<tr>
		<td width="30%">Schreiber</td>
		<td width="70%">
			<div id="schreiberlist">
				
			</div>
		</td>
	</tr>
	<tr>
		<td width="30%"></td>
		<td width="70%">
			<div id="schreiberinfo">
				<p>Bitte w&auml;hlen Sie zuerst einen Schreiber aus, <br />anschliessend werden hier die Informationen angezeigt!</p>
			</div>
		</td>
	</tr>
	<tr>
		<td colspan="2"><hr /></td>
	</tr>
	<tr>
		<td colspan="2">
			<p>
				<b>Vorschl�ge</b>: Personen die an diesem Tag, aber nicht zur gleichen Zeit, Heimspiele haben
			</p>
			<ul style="list-style-image:url({$templateDir}/images/icons/bullet_green.png)">
			{if !empty($proposals)}
				{foreach item=proposal from=$proposals}
					<li>{$proposal.prename} {$proposal.name}, Schreibereins&auml;tze: {$proposal.anzahl} <br />
					 	{$proposal.date}, {$proposal.ort} - {$proposal.halle}</li>
				{/foreach}
			{else}
				<li>Keine Vorschl&auml;ge, da keine anderen Heimspiele an diesem Tag</li>
			{/if}
			</ul>
		</td>

</table>