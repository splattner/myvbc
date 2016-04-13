<script src="libs/chosen/chosen.jquery.js"></script>
<link rel="stylesheet" href="libs/chosen/chosen.css">


<form action="index.php?page={$currentPage}&action=addNoteSubscription" method="POST">
<table class="edit">
	<tr>
		<th width="30%">
			Subscription hinzuf&uuml;gen
		</th>
		<th width="70%" style="text-align: right">
			<a data-toggle="tooltip" data-placement="bottom" title="Zur&uuml;ck zur &Uuml;bersicht" href="index.php?page={$currentPage}&action=notifications"><i style="color: red" class="fa fa-times"></i></a>
		</th>
	</tr>
	<tr>
		<td width="30%">
			Person ausw&auml;hlen
		</td>
		<td width="70%">
			<select class="person-select" name="personID">
				<option value="0" >(Bitte ausw&auml;hlen)</option>
				{foreach item=user from=$users}
					<option value="{$user.id}">{$user.name} {$user.prename}</option>
				{/foreach}
			</select>
		</td>
	</tr>
	<tr>
		<td width="30%">
			Type
		</td>
		<td width="70%">
			<select name="typeID">
				<option value="0" >(Bitte ausw&auml;hlen)</option>
				{foreach item=type from=$types}
					<option value="{$type.id}">{$type.name}</option>
				{/foreach}
			</select>
		</td>
	</tr>
		<tr>
		<td width="30%">
			E-Mail
		</td>
		<td width="70%">
			<input type="checkbox" name="email" value="1">
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