
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
		<a href="#" {popup caption="hinzuf&uuml;gen" text="Lizenz f&uuml;r diese Person zur Bestellung hinzuf&uuml;gen"} onClick="addLicenceToOrder({$orderID})"><img src="{$templateDir}/images/icons/add.png"></a>
	</td>
</tr>
</table>