<table class="wide">
<tr>
	<th width="2%">&nbsp;</th>
	<th width="20%">Datum / Zeit</th>
	<th width="15%">Team</th>
	<th width="20%">Gegner</th>
	<th width="20%">Ort / Halle</th>
	<th width="13%">Schreiber</th>
	<th width="10%">&nbsp;</th>
</tr>


{foreach item=game from=$games}
<tr>
	<td>
		{if ($game.date|date_format:"%d" < $smarty.now|date_format:"%d" &&  $game.date|date_format:"%m" <= $smarty.now|date_format:"%m" && $game.date|date_format:"%Y" <= $smarty.now|date_format:"%Y")
		|| ($game.date|date_format:"%m" < $smarty.now|date_format:"%m" && $game.date|date_format:"%Y" <= $smarty.now|date_format:"%Y")
		|| ($game.date|date_format:"%Y" < $smarty.now|date_format:"%Y")}
			<img src="{$templateDir}/images/icons/bullet_red.png">
		{else}
			<img src="{$templateDir}/images/icons/bullet_green.png">
		{/if}	
	</td>
	<td>{$game.date|date_format:"%a, %d %B %y - %H:%M"}</td>
	<td>{$game.name}</td>
	<td>{$game.gegner}</td>
	<td>{$game.ort} / {$game.halle}</td>
	<td>
		{if !empty($game.schreiber)}
			{foreach item=schreiber from=$game.schreiber}
			{$schreiber.prename} {$schreiber.name} <br />
			{/foreach}
		{elseif $game.heimspiel == 1}
			<i>Keine Schreiber</i>
		{/if}
	</td>
	<td align="right">
		{if $game.heimspiel == 1}
			<a {popup caption="Schreiber" text="Schreiber für dieses Spiel verwalten"}href="index.php?page={$currentPage}&action=editSchreiber&gameID={$game.id}"><img src="{$templateDir}/images/icons/group.png" alt="Schreiber bearbeiten"></a>
		{/if}
		<a {popup caption="bearbeiten" text="Daten dieses Spiels bearbeiten"} href="index.php?page={$currentPage}&action=edit&gameID={$game.id}"><img src="{$templateDir}/images/icons/page_edit.png" alt="Spiel bearbeiten"></a>
		<a onclick="return confirm('Willst du diesen Eintrag wirklich löschen?')" {popup caption="löschen" bgcolor="#FF0000" text="Dieses Spiel aus myVBC löschen."} href="index.php?page={$currentPage}&action=delete&gameID={$game.id}"><img src="{$templateDir}/images/icons/page_delete.png" alt="Spiel l&ouml;schen"></a>
	</td>
</tr>
{/foreach}
</table>
