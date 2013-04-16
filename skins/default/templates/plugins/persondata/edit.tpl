<form action="{eval var=$formURL}" method="POST">
<table width="100%">
	<tr>
		<td width="30%">Vorname</td>
		<td width="70%"><input class="textinput" type="text" name="prename" value="{$person[0].prename}"></td>
	</tr>
	<tr>
		<td width="30%">Name</td>
		<td width="70%"><input class="textinput" type="text" name="name" value="{$person[0].name}"></td>
	</tr>
	<tr>
		<td width="30%">Adresse</td>
		<td width="70%"><input class="textinput" type="text" name="address" value="{$person[0].address}"></td>
	</tr>
	<tr>
		<td width="30%">PLZ</td>
		<td width="70%"><input class="textinput" type="text" name="plz" value="{$person[0].plz}"></td>
	</tr>
	<tr>
		<td width="30%">Ort</td>
		<td width="70%"><input class="textinput" type="text" name="ort" value="{$person[0].ort}"></td>
	</tr>
	<tr>
		<td width="30%">Telefon</td>
		<td width="70%"><input class="textinput" type="text" name="phone" value="{$person[0].phone}"></td>
	</tr>
	<tr>
		<td width="30%">Mobile</td>
		<td width="70%"><input class="textinput" type="text" name="mobile" value="{$person[0].mobile}"></td>
	</tr>
	<tr>
		<td width="30%">E-Mail</td>
		<td width="70%"><input class="textinput" type="text" name="email" value="{$person[0].email}"></td>
	</tr>
	<tr>
		<td width="30%">Schiedsrichter ID (wenn vorhanden)</td>
		<td width="70%"><input class="textinput" type="text" name="refid" value="{$person[0].refid}"></td>
	</tr>
	<tr>
		<td width="30%">Geburtstag</td>
		<td width="70%">{html_select_date prefix="birthday" start_year="1940" field_order="DMY" time=$person[0].birthday}
	</tr>
	<tr>
		<td width="30%">Geschlecht</td>
		<td>
			<select name="gender">
			{if $person[0].gender == 'm'}
				<option value="m" selected="selected">m</option>
				<option value="w" >w</option>
			{else}
				<option value="m" >m</option>
				<option value="w" selected="selected">w</option>
			{/if}
			</select>
		</td>
	</tr>
	<tr>
		<td width="30%"><b>Zusätzliche Daten</td>
		<td width="70%" >&nbsp;</td>
	</tr>
	<tr>
		<td width="30%">Schreiber</td>
		<td>
			{if $person[0].schreiber == 1}
				<input type='checkbox' name='schreiber' value='1' checked="checked">
			{else}
				<input type='checkbox' name='schreiber' value='1'>
			{/if}
		</td>
	</tr>
	<tr>
		<td width="30%">SMS-Benachrichtigung <br />bei Schreibereinsatz</td>
		<td>
			{if $person[0].sms == 1}
				<input type='checkbox' name='sms' value='1' checked="checked">
			{else}
				<input type='checkbox' name='sms' value='1'>
			{/if}
		</td>
	</tr>
	<tr>
		<td width="30%"><b>Teams</b></td>
		<td width="70%">
			<p>{if $person[0].active == 1}{$person[0].liga}{else}Spieler ist nicht aktiv{/if}</p>
		</td>
	</tr>
	<tr>
		<td width="30%"><b>Lizenz</b></td>
		<td width="70%">
		
			<select name="licence">
			{foreach item=licence from=$licences}
			
				{if $person[0].licence == $licence.id}
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
			<textarea name="licence_comment" rows="10" cols="30">{$person[0].licence_comment}</textarea>
		</td>
	</tr>
	<tr>
		<td colspan="2">
			<input type="submit" name="doEdit" value="bearbeiten">
		</td>
	</tr>
	

</table>
</form>
