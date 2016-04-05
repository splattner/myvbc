<form action="{eval var=$formURL}" method="POST">
<table width="100%">
	<tr>
		<td width="30%">Vorname</td>
		<td width="70%"><input class="textinput" type="text" name="prename"></td>
	</tr>
	<tr>
		<td width="30%">Name</td>
		<td width="70%"><input class="textinput" type="text" name="name"></td>
	</tr>
	<tr>
		<td width="30%">Adresse</td>
		<td width="70%"><input class="textinput" type="text" name="address"></td>
	</tr>
	<tr>
		<td width="30%">PLZ</td>
		<td width="70%"><input class="textinput" type="text" name="plz"></td>
	</tr>
	<tr>
		<td width="30%">Ort</td>
		<td width="70%"><input class="textinput" type="text" name="ort"></td>
	</tr>
	<tr>
		<td width="30%">Telefon</td>
		<td width="70%"><input class="textinput" type="text" name="phone"></td>
	</tr>
	<tr>
		<td width="30%">Mobile</td>
		<td width="70%"><input class="textinput" type="text" name="mobile"></td>
	</tr>
	<tr>
		<td width="30%">E-Mail</td>
		<td width="70%"><input class="textinput" type="text" name="email"></td>
	</tr>
	<tr>
		<td width="30%">E-Mail Eltern / Vormund</td>
		<td width="70%"><input class="textinput" type="text" name="email-parent"></td>
	</tr>
	<tr>
		<td width="30%">Schiedsrichter ID (wenn vorhanden)</td>
		<td width="70%"><input class="textinput" type="text" name="refid"></td>
	</tr>
	<tr>
		<td width="30%">Geburtstag</td>
		<td width="70%">{html_select_date prefix="birthday" start_year="1940" field_order="DMY"}
	</tr>
	<tr>
		<td width="30%">Geschlecht</td>
		<td width="70%">
			<select name="gender">
				<option value="m" >m</option>
				<option value="w" >w</option>
			</select>
		</td>
	</tr>
	<tr>
		<td width="30%"><b>Zus&auml;tzliche Daten</td>
		<td width="70%" >&nbsp;</td>
	</tr>
	<td width="30%">Schreiber</td>
		<td width="70%">
				<input  class="textinput"type='checkbox' name='schreiber' value='1' checked="checked">
		</td>
	</tr>
	<tr>
		<td width="30%">SMS-Benachrichtigung <br />bei Schreibereinsatz</td>
		<td width="70%">
				<input  class="textinput"type='checkbox' name='sms' value='1' checked="checked">
		</td>
	</tr>
	<tr>
		<td width="30%"><b>Lizenz</b></td>
		<td width="70%">
		
			<select name="licence">
			{foreach item=licence from=$licences}
			
				{if $licence.id == 1}
					<option value="{$licence.id}" selected="selected">{$licence.typ}</option>
				{else}
					<option value="{$licence.id}">{$licence.typ}</option>
				{/if}
			
			{/foreach}
			
			</select>
		
		
		</td>
	</tr>
        <tr>
                <td width="30%"><b>Bemerkung zu Lizenz</b></td>
                <td width="30%">
                        <textarea name="licence_comment" rows="10" cols="30"></textarea>
                </td>
        </tr>

	<tr>
		<td colspan="2">
			<input type="submit" class="btn btn-primary" name="doNew" value="eintragen">
		</td>
	</tr>

</table>
</form>
