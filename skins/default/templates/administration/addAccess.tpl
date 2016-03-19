<script src="libs/chosen/chosen.jquery.js"></script>
<link rel="stylesheet" href="libs/chosen/chosen.css">

<form action="index.php?page={$currentPage}&action=addAccess" method="POST">
<table class="edit">
	<tr>
		<th width="30%">
			Zugang hinzuf&uuml;gen
		</th>
		<th width="70%" style="text-align: right;">
			<a data-toggle="tooltip" data-placement="bottom" title="Zur&uuml;ck zur &Uuml;bersicht" href="index.php?page={$currentPage}&action=addaccess"><i style="color: red" class="fa fa-times"></i></a>
		</th>
	</tr>
	<tr>
		<td width="30%">
			Person ausw&auml;hlen
		</td width="70%">
		<td>
			<select style="width:80%;" class="person-select" name="person">
				<option value="0" >(Bitte ausw&auml;hlen)</option>
				{foreach item=user from=$users}
					<option value="{$user.id}">{$user.prename} {$user.name}</option>
				{/foreach}
			</select>
		</td>
	</tr>
	<tr>
		<td width="30%">
			Gruppe
		</td>
		<td width="70%">
			<select name="group">
				<option value="0" >(Bitte ausw&auml;hlen)</option>
				{foreach item=group from=$groups}
					<option value="{$group.id}">{$group.name}</option>
				{/foreach}
			</select>
		</td>
	</tr>
	<td>
		<td colspan="2">
			<input class="btn btn-primary" type="submit" name="doAdd" value="hinzuf&uuml;gen">
		</td>
	</tr>

</table>
</form>

<script type="text/javascript">
	$('.person-select').chosen();
</script>

