<table class="wide">
<tr>
	<th>&nbsp;</th>
	<th>Datum / Zeit</th>
	<th>Begegnung</th>
	<th>Ort</th>
	<th>&nbsp;</th>
</tr>
{foreach item=game from=$games}
<tr>
	<td>
		{if $game.local == 1 }
			<img src="{$templateDir}/images/icons/bullet_green.png">
		{elseif $game.local == 2}
			<img src="{$templateDir}/images/icons/bullet_orange.png">
		{else}
			<img src="{$templateDir}/images/icons/bullet_red.png">
		{/if}
	<td>
		{$game.datum}
	</td>
	<td>
		{$game.heimteam} - {$game.gastteam}
	</td>
	<td>
		{$game.ort} / {$game.halle}
	</td>

</tr>
{/foreach}
</table>
