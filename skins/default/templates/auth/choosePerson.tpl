<form action="index.php?page={$currentPage}&action=createAccess&step2" method="POST">
<table class="edit">
	<tr>
		<th width="30%">
			Zugang einrichten
		</th>
		<th width="70%" style="text-align: right;">
			<a href="index.php?page=index"><img src="{$templateDir}/images/icons/cross.png"></a>
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
	<td>
		<td colspan="2">
			<input type="submit" name="doChoose" value="auswählen">
		</td>
	</tr>

</table>
</form>