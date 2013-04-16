<p class="submenu">
	<a href="index.php?page={$currentPage}&action=new" {popup caption="neue Lizenzbestellung" text="Eine neue Lizenzbestellung tätigen"}><img src="{$templateDir}/images/icons/basket_add.png" ></a>
</p>

{include file='messages/info.tpl'}

<table class="legend">
<tr>
	<td>
		<img src="{$templateDir}/images/icons/bullet_green.png"> Status: Erfassen<br />
		<img src="{$templateDir}/images/icons/bullet_yellow.png"> Status: Bestellung ausgelöst<br />
		<img src="{$templateDir}/images/icons/bullet_blue.png"> Status: In Bearbeitung<br />
		<img src="{$templateDir}/images/icons/bullet_red.png"> Status: Abgeschlossen<br />
	</td>
</tr>
</table>

<table class="wide">
<tr>
	<th width="2%"></th>
	<th width="20%">Datum</th>
	<th width="20%">letzte Änderung</th>
	<th width="38%">Kommentar</th>
	<th width="15%">Ausgelöst durch</th>
	<th width="5%">&nbsp;</th>
</tr>

{foreach item=order from=$orders}
<tr>
	<td>
		{if $order.status == 1}<img src="{$templateDir}/images/icons/bullet_green.png">{/if}
		{if $order.status == 2}<img src="{$templateDir}/images/icons/bullet_yellow.png">{/if}
		{if $order.status == 3}<img src="{$templateDir}/images/icons/bullet_blue.png">{/if}
		{if $order.status == 4}<img src="{$templateDir}/images/icons/bullet_red.png">{/if}
	</td>
	<td>
		{$order.createdate|date_format:"%a, %d %B %y - %H:%M"}
	</td>
	<td>
		{$order.lastupdate|date_format:"%a, %d %B %y - %H:%M"}
	</td>

	<td>
		{$order.comment}
	</td>
	<td>
		{$order.ownername}
	</td>
	<td align="right">
		<a {popup caption="Anzeigen & bearbeiten" text="Diese Bestellung anzeigen. Bearbeiten nur möglich bei Status erfassen"} href="index.php?page={$currentPage}&action=list&orderID={$order.id}"><img src="{$templateDir}/images/icons/basket_edit.png" alt="Spiel bearbeiten"></a>
		{if (($allowedit && $order.status != 4 )|| ($order.owner == $uid && $order.status == 1))}
			<a onclick="return confirm('Willst du diesen Bestellung wirklich löschen?')" {popup caption="löschen" bgcolor="#FF0000" text="Diese Bestellung löschen"} href="index.php?page={$currentPage}&action=delete&orderID={$order.id}"><img src="{$templateDir}/images/icons/basket_delete.png"></a>
		{/if}
	</td>
</tr>
{/foreach}


</table>