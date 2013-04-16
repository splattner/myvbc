<p>
	<a {popup caption="Importieren" text="Spiele aus einer externen Quelle importieren"} href="index.php?page={$currentPage}&action=import"><img src="{$templateDir}/images/icons/basket_put.png" alt="Daten importieren"></a>
</p>

<p>
Team ausw&auml;hlen:
<select onchange='getGames(this.value);' name="teamid">
	<option value="0">Alle Spiele</option>
	{foreach item=team from=$teams}
		{if $share.teamID == $team.id}
			<option selected="selected" value="{$team.id}">{$team.name}</option>
		{else}
			<option value="{$team.id}">{$team.name}</option>
		{/if}
	{/foreach}
</select>
</p>

<div id="gameEntrys">
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
</table>
</div>
