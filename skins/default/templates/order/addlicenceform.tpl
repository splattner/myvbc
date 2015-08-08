
<script src="libs/chosen/chosen.jquery.js"></script>
<link rel="stylesheet" href="libs/chosen/chosen.css">

<table class="wide">
<tr>
	<td width="2%">
		<img src="{$templateDir}/images/icons/bullet_yellow.png">
	</td>
	<td width="25%">
		<select class="person-select" id="personID">
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

<script type="text/javascript">
    $('.person-select').chosen();
</script>