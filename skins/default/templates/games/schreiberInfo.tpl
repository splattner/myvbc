<p>
	Anzahl Schreibereinsätze: {$countSchreiber}
</p>

{if !empty($games)}
	<p>
		<b>Achtung:</b> Diese Person hat bereits selbst Spiele an diesem Tag:
	</p>
	
	<ul style="list-style-image:url({$templateDir}/images/icons/bullet_red.png)">
	{foreach item=game from=$games}
		<li>{$game.date}, {$game.ort} - {$game.halle}</li>
	{/foreach}
	</ul>
{else}
	<p>Keine anderen Spiele an diesem Tag</p>
{/if}
