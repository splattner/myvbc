<form action="index.php?page={$currentPage}&action=new" method="POST">
<table class="edit">
	<tr>
		<th width="30%">
			Neues Team eintragen
		</th>
		<th width="70%" style="text-align: right;">
			<a {popup caption="zurück" text="Zurück zur Übersicht"} href="index.php?page={$currentPage}&action=main"><img src="{$templateDir}/images/icons/cross.png" alt="zur&uuml;ck"></a>
		</th>
	</tr>
	<tr>
		<td width="30%">Externe ID</td>
		<td width="70%"><input class="textinput" type="text" name="extid"></td>
	</tr>
	<tr>
		<td width="30%">Name</td>
		<td width="70%"><input class="textinput" type="text" name="name" ></td>
	</tr>
	<tr>
		<td width="30%">Externer Name</td>
		<td width="70%"><input class="textinput" type="text" name="extname" ></td>
	</tr>
	<tr>
		<td width="30%">Liga</td>
		<td width="70%"><input class="textinput" type="text" name="liga"></td>
	</tr>
	<tr>
		<td width="30%">Externe Liga</td>
		<td width="70%"><input class="textinput" type="text" name="extliga"></td>
	</tr>
	<tr>
		<td width="30%">Type</td>
		<td width="70%">
			<select name="typ">
				<option value="1">SwissVolley (National)</option>
				<option value="2" selected="selected">Swissvolley Region Solothurn</option>
			</select>
		</td>
	</tr>
	<td>
		<td colspan="2">
			<input type="submit" name="doNew" value="eintragen">
		</td>
	</tr>

</table>
</form>