
<table class="wide">
<tr>
	<td width="2%">
		<img src="{$templateDir}/images/icons/bullet_yellow.png">
	</td>
	<td width="25%">
		<select id="personID">
			<option value="0"></option>
			{foreach item=person from=$persons}
				<option value="{$person.id}">{$person.name} {$person.prename} </option>
			{/foreach}
		</select>
	</td>
	<td colspan="3">
		<a href="#" data-toggle="tooltip" data-tooltip="true" data-placement="bottom" title="Lizenz f&uuml;r diese Person zur Bestellung hinzuf&uuml;gen" onClick="addLicenceToOrder({$orderID})">
			<i class="fa fa-plus-square"></i>
		</a>
	</td>
</tr>
</table>