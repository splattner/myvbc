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
			<a {popup caption="zur&uuml;ck" text="Zur&uuml;ck zur &Uuml;ersicht"} href="index.php?page={$currentPage}&action=member&teamID={$teamID}"><img src="{$templateDir}/images/icons/cross.png"></a>
		</th>
	</tr>
	<tr>
		<td width="30%">
			Person ausw&auml;hlen
		</td>
		<td width="70%">
			<select name="person">
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
			<input type="submit" name="doAdd" value="hinzuf&uuml;gen">
		</td>
	</tr>

</table>
</form>

<script type="text/javascript">

    $("input[value='person']").chosen({no_results_text: "Keine Person mit diesem Namen gefunden!"});
</script>
