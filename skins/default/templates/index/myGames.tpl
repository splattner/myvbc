<table class="overview">
	<tr>
		<th colspan="6">
			Meine Spiele
		</th>
	</tr>
	{foreach item=myGame from=$myGames}
		<tr>
			<td>
				{if ($myGame.date|date_format:"%d" < $smarty.now|date_format:"%d" &&  $myGame.date|date_format:"%m" <= $smarty.now|date_format:"%m" && $myGame.date|date_format:"%Y" <= $smarty.now|date_format:"%Y")
				|| ($myGame.date|date_format:"%m" < $smarty.now|date_format:"%m" && $myGame.date|date_format:"%Y" <= $smarty.now|date_format:"%Y") 
				|| ($myGame.date|date_format:"%Y" < $smarty.now|date_format:"%Y") }
					<img src="{$templateDir}/images/icons/bullet_red.png">
				{else}
					<img src="{$templateDir}/images/icons/bullet_green.png">
				{/if}	
			</td>
			<td>{$myGame.date|date_format:"%a, %d. %B %Y"}</td>
			<td>{$myGame.date|date_format:"%H:%M"}</td>
			<td>{$myGame.name}</td>
			<td>{$myGame.gegner}</td>

			<td>{$myGame.ort} / {$myGame.halle}</td>
		</tr>
	{/foreach}
</table>
