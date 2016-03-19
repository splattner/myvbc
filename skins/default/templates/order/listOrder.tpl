{include file='messages/info.tpl'}

{foreach item=order from=$orders}
<form action="index.php?page={$currentPage}&action=editorder&orderID={$order.id}" method="POST">
<table class="edit">
	<tr>
		<th width="30%">
			Bestellung bearbeiten
		</th>
		<th width="70%" style="text-align: right;">
			<a data-toggle="tooltip" data-placement="bottom" title="Zur&uuml;ck zur &Uuml;bersicht" href="index.php?page={$currentPage}&action=main"><i style="color: red" class="fa fa-times"></i></a>
		</th>
	</tr>
	<tr>
		<td width="30%">Erstelldatum</td>
		<td width="70%">{$order.createdate|date_format:"%a, %d %B %y - %H:%M"}</td>
	</tr>
		<tr>
		<td width="30%">Letze Status &Auml;nderung</td>
		<td width="70%">{$order.lastupdate|date_format:"%a, %d %B %y - %H:%M"}</td>
	</tr>
	<tr>
		<td width="30%">Status</td>
		<td width="70%">
			{if $allowedit}
				<select name="statusID">
					<option value="0"></option>
					{foreach item=status from=$statuslist}
					<option {if $order.status == $status.id} selected="selected" {/if} value="{$status.id}">{$status.description}</option>
					{/foreach}
				</select>
			{else}
				{$order.statustext}&nbsp;
				{if ($order.owner == $uid && $order.status == 1)}
					<a data-toggle="tooltip" data-placement="bottom" title="Sobald sie die Bestellung schliessen, wird der Bestellvorgang eingeleitet. Achtung: Danach k&ouml;nnen Sie an dieser Bestellung nichts mehr &auml;ndern!"  href="index.php?page={$currentPage}&action=closeOrder&orderID={$order.id}">
						<img src="{$templateDir}/images/icons/accept.png" > Bestellung abschliessen
					</a>
				{/if}
			{/if}
			
		</td>
	</tr>
	<tr>
		<td width="30%">Bemerkung zur Bestellung</td>
		<td width="70%">
			{if (($allowedit && $order.status != 4) || ($order.owner == $uid && $order.status == 1))}
				<textarea name="comment" cols="40" rows="6">{$order.comment}</textarea>
			{else}
				{$order.comment}
			{/if}
			</td>
	</tr>
	
	<tr>
		<td colspan="2">
		{if ($order.status == 4)}
			<p class="hightlight" >Bestellung abgeschlossen, Bearbeitung nicht mehr m&ouml;glich!</p>
		{else}
			{if ($allowedit || ($order.owner == $uid && $order.status == 1))}
				<input type="submit" name="doEdit" value="bearbeiten">
			{else}
				<p class="hightlight" >Bearbeiten ist nicht mehr m�glich, der Bestellvorgang wurde bereits ausgel&oumlst, oder das ist nich deine Bestellung <br />
				Wenn etwas nicht in Ordnung ist, melde dich beim Chef-TK!</p>
			{/if}
		{/if}
		</td>
	</tr>

</table>
</form>


<p class="submenu">
	{if ($allowedit && $order.status != 4 )|| $order.status == 1}
	<a onClick="showaddLicenceForm({$orderID})" {popup caption="neue Lizenz" text="Neue Lizenz zu dieser Bestellung hinzuf�gen"} href="#"><img src="{$templateDir}/images/icons/basket_put.png"></a>
	{/if}
</p>

<div id="orderitems">
<table class="wide">
<tr>
	<th width="2%">&nbsp;</th>
	<th width="25%">Person</th>
	<th width="25%">Lizenz</th>
	<th width="38%">Kommentar</th>
	<th width="10%">&nbsp;</th>
</tr>
</table>
</div>

<div id="orderitemsnew"></div>
{/foreach}

