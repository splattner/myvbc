<form action="index.php?page={$currentPage}&action=new" method="POST">
<table class="edit">
	<tr>
		<th width="30%">
			neue Bestellung
		</th>
		<th width="70%" style="text-align: right;">
			<a {popup caption="zurück" text="Zurück zur Übersicht"} href="index.php?page={$currentPage}&action=main"><img src="{$templateDir}/images/icons/cross.png" alt="zur&uuml;ck"></a>
		</th>
	</tr>
	<tr>
		<td width="30%">Bestellung f&uuml;r Team <br />
		<a {popup caption="Hinweis" text="wenn du hier ein Team ausw&auml;hlst, werden alle Teammitglieder automatisch dieser Bestellung hinzugef&uuml;gt."}href="#"><img src="{$templateDir}/images/icons/information.png"></a>
		</td>
		<td width="70%">
			<select onchange='getGames(this.value);' name="teamid">
				<option value="0">(Team ausw&auml;hlen)</option>
				{foreach item=team from=$teams}
						<option value="{$team.id}">{$team.name}</option>
				{/foreach}
			</select>
</td>
	</tr>
	<tr>
		<td width="30%">Bemerkung zur Bestellung</td>
		<td width="70%"><textarea name="comment" cols="40" rows="6">{$order.comment}</textarea></td>
	</tr>
	
	<tr>
		<td colspan="2">
			<input type="submit" name="doNew" value="eintragen">
		</td>
	</tr>

</table>
</form>