{foreach item=game from=$games}
<form action="index.php?page={$currentPage}&action=edit&gameID={$game.id}" method="POST">
<table class="edit">
	<tr>
		<th width="30%">
			Spiel bearbeiten
		</th>
		<th width="70%" style="text-align: right;">
			<a {popup caption="zurück" text="Zurück zur Übersicht"} href="index.php?page={$currentPage}&action=main"><img src="{$templateDir}/images/icons/cross.png" alt="zur&uuml;ck"></a>
		</th>
	</tr>
	<tr>
		<td width="30%">Externe ID</td>
		<td width="70%"><input class="textinput" type="text" name="extid" value="{$game.extid}"></td>
	</tr>
	<tr>
		<td width="30%">Datum / Zeit</td>
		<td width="70%">
			{html_select_date prefix="date" field_order="DMY" time=$game.date start_year="+0" end_year="+1"}
			{html_select_time prefix="time" use_24_hours=true display_seconds=false time=$game.date}
		</td>
	</tr>
	<tr>
		<td width="30%">Gegner</td>
		<td width="70%"><input class="textinput" type="text" name="gegner" value="{$game.gegner}"></td>
	</tr>
	<tr>
		<td width="30%">Ort</td>
		<td width="70%"><input class="textinput" type="text" name="ort" value="{$game.ort}"></td>
	</tr>
	<tr>
		<td width="30%">Halle</td>
		<td width="70%"><input class="textinput" type="text" name="halle" value="{$game.halle}"></td>
	</tr>
	<tr>
		<td width="30%">Heimspiel</td>
		<td>
			{if $game.heimspiel == 1}
				<input type='checkbox' name='heimspiel' value='1' checked="checked">
			{else}
				<input type='checkbox' name='heimspiel' value='1'>
			{/if}
		</td>
	</tr>
	<tr>
		<td colspan="2">
			<input type="submit" name="doEdit" value="bearbeiten">
		</td>
	</tr>

</table>
</form>
{/foreach}