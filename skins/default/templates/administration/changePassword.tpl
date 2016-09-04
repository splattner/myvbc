<form action="index.php?page={$currentPage}&action=changePassword" method="POST">
<table class="edit">
	<tr>
		<th width="30%">
			Passwort &auml;ndern
		</th>
		<th width="70%" style="text-align: right;">
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
					<option value="{$user.id}">{$user.prename} {$user.name}</option>
				{/foreach}
			</select>
		</td>
	</tr>
	<tr>
		<td width="30%">
			Passwort
		</td>
		<td width="70%">
			<input type="password" name="password" />
		</td>
	</tr>
	<td>
		<td colspan="2">
			<input class="btn btn-primary" type="submit" name="changePassword" value="&auml;ndern">
		</td>
	</tr>

</table>
</form>

<script type="text/javascript">
	$('.person-select').chosen();
</script>