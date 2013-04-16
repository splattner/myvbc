<form action="index.php?page={$currentPage}&action=addAccess" method="POST">
<table class="edit">
	<tr>
		<th width="30%">
			Zugang hinzufügen
		</th>
		<th width="70%" style="text-align: right;">
			<a {popup caption="zurück" text="Zurück zur Übersicht"} href="index.php?page={$currentPage}&action=addaccess><img src="{$templateDir}/images/icons/cross.png"></a>
		</th>
	</tr>
	<tr>
		<td width="30%">
			Person ausw&auml;hlen
		</td width="70%">
		<td>
			<select name="person">
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
			<input type="submit" name="doAdd" value="hinzuf&uuml;gen">
		</td>
	</tr>

</table>
</form>
