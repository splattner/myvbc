<table class="schreiber">
{foreach item=schreiber from=$schreibers}
<tr>
	<td><img src="{$templateDir}/images/icons/bullet_green.png"></td>
	<td>{$schreiber.prename} {$schreiber.name}</td>
	<td><a href="#" data-toggle="tooltip" data-placement="bottom" title="Diesen Schreiber vom Spiel entfernen" onClick="removeSchreiber({$schreiber.id},{$gameID},{$teamID})" ><i style="color: red;" class="fa fa-trash-o"></i></a></td>
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
		<a href="#" data-toggle="tooltip" data-placement="bottom" title="Diesen Schreiber dem Spiel hinzuf&uuml;gen" onClick="addSchreiber({$gameID}, {$teamID})"><i class="fa fa-plus-square"></i></a>
	</td>
</table>