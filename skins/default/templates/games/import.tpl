<p>
	<a data-toggle="tooltip" data-placement="bottom" title="Zur&uuml;ck zur &Uuml;bersicht" href="index.php?page={$currentPage}&action=main"><i class="fa fa-caret-square-o-left"></i></a>
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
<a data-toggle="tooltip" data-placement="bottom" title="Spiele importieren" href="#" onClick='importGames()'><i class="fa fa-plus-square"></i></a>
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