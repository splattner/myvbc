{include file='messages/info.tpl'}

<script src="libs/chosen/chosen.jquery.js"></script>
<link rel="stylesheet" href="libs/chosen/chosen.css">



<form action="index.php?page={$currentPage}&action=addMember&teamID={$teamID}" method="POST">
<table class="edit">
	<tr>
		<th width="30%">
			Mitglied zu Team hinzuf&uuml;gen
		</th>
		<th width="70%" style="text-align: right">
			<a data-toggle="tooltip" data-placement="bottom" title="Zur&uuml;ck zur &Uuml;bersicht" href="index.php?page={$currentPage}&action=member&teamID={$teamID}"><i style="color: red" class="fa fa-times"></i></a>
		</th>
	</tr>
	<tr>
		<td width="30%">
			Person ausw&auml;hlen
		</td>
		<td width="70%">
			<select style="width:80%;" class="person-select" name="person">
				<option value="0" >(Bitte ausw&auml;hlen)</option>
				{foreach item=user from=$users}
					<option value="{$user.id}">{$user.name} {$user.prename}</option>
				{/foreach}
			</select>
		</td>
	</tr>
	<tr>
		<td width="30%">
			Funktion
		</td>
		<td width="70%">
			<select name="typ">
				<option value="1">Spieler</option>
				<option value="2">Captain / Teamverantwortlicher</option>
				<option value="3">Trainer</option>
				<option value="4">Sonstige Funktion</option>
			</select>
		</td>
	</tr>
	<td>
		<td colspan="2">
			<input type="submit" class="btn btn-primary" name="doAdd" value="hinzuf&uuml;gen">
		</td>
	</tr>

</table>
</form>

<script type="text/javascript">
    $('.person-select').chosen();
</script>
