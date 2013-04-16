<p>
	<a href="index.php?page={$currentPage}&action=main"><img src="{$templateDir}/images/icons/cross.png" alt="zur&uuml;ck"></a>
</p>

<h3>Spiele importieren</h3>
<p>
Team ausw&auml;hlen:
<select onchange="getGamesToImport(this.value);" name="teamid">
	<option value="0">(Bitte ausw&auml;hlen)</option>
	{foreach item=team from=$teams}
		{if $share.teamID == $team.id}
			<option selected="selected" value="{$team.id}">{$team.name}</option>
		{else}
			<option value="{$team.id}">{$team.name}</option>
		{/if}
	{/foreach}
</select>
<a href="#" onClick='importGames()'><img src="{$templateDir}/images/icons/add.png"></a>
</p>

<table class="legend">
<tr>
	<td>
		<img src="{$templateDir}/images/icons/bullet_green.png"> Spiel lokal in Datenbank <br />
		<img src="{$templateDir}/images/icons/bullet_orange.png"> Spiel lokal in Datenbank nicht aktuell<br />
		<img src="{$templateDir}/images/icons/bullet_red.png"> Spiel nicht lokal in Datenbank<br />
	</td>
</tr>
</table>

<div id="importEntrys">
<table class="wide">
<tr>
	<th>&nbsp;</th>
	<th>Datum / Zeit</th>
	<th>Team</th>
	<th>Gegner</th>
	<th>Ort</th>
	<th>&nbsp;</th>
</tr>
</table>
</div>