<table class="schreiber">
{foreach item=schreiber from=$schreibers}
<tr>
	<td><img src="{$templateDir}/images/icons/bullet_green.png"></td>
	<td>{$schreiber.prename} {$schreiber.name}</td>
	<td><a href="#" {popup caption="entfernen" bgcolor="#FF0000" text="Diesen Schreiber vom Spiel entfernen"} onClick="removeSchreiber({$schreiber.id},{$gameID},{$teamID})" ><img src="{$templateDir}/images/icons/delete.png"></a></td>
</tr>
{/foreach}
<tr>
	<td><img src="{$templateDir}/images/icons/bullet_red.png"></td>
	<td>
		<select onchange="getSchreiberInfo(this.value, {$gameID});" id="personid">
			<option value="0"></option>
			{foreach item=all_schreiber from=$all_schreibers}
				<option value="{$all_schreiber.id}">{$all_schreiber.prename} {$all_schreiber.name}</option>
			{/foreach}
		</select>
	</td>
	<td>
		<a href="#" {popup caption="hinzufügen" text="Diesen Schreiber dem Spiel hinzufügen"} onClick="addSchreiber({$gameID}, {$teamID})"><img src="{$templateDir}/images/icons/add.png"></a>
	</td>
</table>