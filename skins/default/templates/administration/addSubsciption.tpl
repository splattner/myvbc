<form action="index.php?page={$currentPage}&action=addNoteSubscription" method="POST">
<table class="edit">
	<tr>
		<th width="30%">
			Subscription hinzuf&uuml;gen
		</th>
		<th width="70%" style="text-align: right">
			<a {popup caption="zurück" text="Zurück zur Übersicht"} href="index.php?page={$currentPage}&action=notifications"><img src="{$templateDir}/images/icons/cross.png"></a>
		</th>
	</tr>
	<tr>
		<td width="30%">
			Person ausw&auml;hlen
		</td>
		<td width="70%">
			<select name="personID">
				<option value="0" >(Bitte ausw&auml;hlen)</option>
				{foreach item=user from=$users}
					<option value="{$user.id}">{$user.prename} {$user.name}</option>
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
			<input type="submit" name="doAdd" value="hinzuf&uuml;gen">
		</td>
	</tr>

</table>
</form>