<table class="wide">
<tr>
	<th width="2%">&nbsp;</th>
	<th width="25%">Person</th>
	<th width="25%">Lizenz</th>
	<th width="38%">Kommentar</th>
	<th width="10%">&nbsp;</th>
</tr>

{foreach item=orderitem from=$orderitems}
<tr>
	<td>
		<img src="{$templateDir}/images/icons/bullet_green.png">
	</td>
	<td>
		{$orderitem.prename} {$orderitem.name}
	</td>
	<td>
		{$orderitem.licence} 
	</td>

	<td>
		{$orderitem.comment} 
	</td>

	<td align="right">
		{if (($allowedit && $order[0].status != 4) || ($order[0].owner == $uid && $order[0].status == 1))}
			<a onclick="removeLicenceFromOrder({$orderitem.personID},{$orderitem.orderID})" data-toggle="tooltip" data-tooltip="true" data-placement="bottom" title="Diese Lizenz entfernen" href="#"><i style="color: red;" class="fa fa-trash-o"></i></a>
		{/if}	
	</td>
</tr>
{/foreach}
</table>