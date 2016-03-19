{include file='messages/info.tpl'}

<script src="libs/chosen/chosen.jquery.js"></script>
<link rel="stylesheet" href="libs/chosen/chosen.css">

<form action="index.php?page={$currentPage}&action=addMember&teamID={$teamID}" method="POST">
<table class="edit">
	<tr>
		<th>
			Mitglied zu Team hinzuf&uuml;gen
		</th>
		<th style="text-align: right;">
			<a data-toggle="tooltip" data-placement="bottom" title="Zur&uuml;ck zur &Uuml;bersicht" href="index.php?page={$currentPage}&action=main&teamID={$teamID}"><i style="color: red" class="fa fa-times"></i></a>
		</th>
	</tr>
	<tr>
		<td>
			Person ausw&auml;hlen
		</td>
		<td>
			<select style="width:80%;" class="person-select" name="person">
				<option value="0" >(Bitte ausw&auml;hlen)</option>
				{foreach item=user from=$users}
					<option value="{$user.id}">{$user.name} {$user.prename} </option>
				{/foreach}
			</select>
			{if $canAddMember}
			<p>
				<a data-toggle="tooltip" data-placement="bottom" title="Neue Person erfassen"  href="index.php?page={$currentPage}&action=new&teamID={$teamID}"><i class="fa fa-plus-square"></i></a>
				Wenn eine Person noch nicht im System erfasst ist, k&ouml;nnen Sie diese hier hinzuf&uuml;gen.
			</p>
			{/if}
		</td>
	</tr>
	<tr>
		<td>
			Funktion
		</td>
		<td>
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
			<input type="submit" name="doAdd" value="hinzuf&uuml;gen">
		</td>
	</tr>

</table>
</form>

<script type="text/javascript">
    $('.person-select').chosen();
</script>
