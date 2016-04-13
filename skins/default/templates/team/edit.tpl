{foreach item=team from=$teams}
<form action="index.php?page={$currentPage}&action=edit&teamID={$team.id}" method="POST">
<table class="edit">
	<tr>
		<th width="30%">
			Team bearbeiten
		</th>
		<th width="70%" style="text-align: right;">
			<a data-toggle="tooltip" data-placement="bottom" title="Zur&uuml;ck zur &Uuml;bersicht" href="index.php?page={$currentPage}&action=main"><i style="color: red" class="fa fa-times"></i></a>
		</th>
	</tr>
	<tr>
		<td width="30%">Externe ID</td>
		<td width="70%"><input class="form-control" type="text" name="extid" value="{$team.extid}"></d>
	</tr>
	<tr>
		<td width="30%">Name</td>
		<td width="70%"><input class="form-control" type="text" name="name" value="{$team.name}"></d>
	</tr>
	<tr>
		<td width="30%">Externer Name</td>
		<td width="70%"><input class="form-control" type="text" name="extname" value="{$team.extname}"></d>
	</tr>
	<tr>
		<td width="30%">Liga</td>
		<td width="70%"><input class="form-control" type="text" name="liga" value="{$team.liga}"></d>
	</tr>
	<tr>
		<td width="30%">Externe Liga</td>
		<td width="70%"><input class="form-control" type="text" name="extliga" value="{$team.extliga}"></d>
	</tr>
	<tr>
		<td width="30%">Type</td>
		<td width="70%">
			<select name="typ">
				{if $team.typ == 1}
					<option value="1" selected="selected">SwissVolley (National)</option>
					<option value="2">Swissvolley Region Solothurn</option>
				{elseif $team.typ == 2}
					<option value="1" >SwissVolley (National)</option>
					<option value="2" selected="selected">Swissvolley Region Solothurn</option>
				{/if}
			</select>
	</tr>
	<tr>
		<td width="30%"></td>
		<td width="70%">
			<input type="submit" class="btn btn-primary" name="doEdit" value="bearbeiten">
		</td>
	</tr>

</table>
</form>
{/foreach}