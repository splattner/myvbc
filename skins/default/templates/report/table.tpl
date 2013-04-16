<p class="submenu">
	{if $isAuth}
		<a {popup caption="zurück" text="Zurück zur Team Übersicht"} href="index.php?page={$currentPage}&action=main"><img src="{$templateDir}/images/icons/cross.png"></a>
	{/if}
	<a href="#" onClick='window.print()' {popup caption="Drucken" text="Diese Liste drucken"}><img src="{$templateDir}/images/icons/printer.png"></a>
</p>


{if $reportID == 5}
<table class="info">
<tr>
	<td>
		<img src="{$templateDir}/images/icons/exclamation.png"> Achtung: Nur angemeldete Benutzer sehen die vollst&auml;ndigen Kontaktdaten!
	</td>
</tr>
</table>
{/if}
{if !empty($tableContent)}
<table class="report">
<tr>
	{foreach item=value from=$tableHeader}
		<th>{$value}</th>
	{/foreach}
</tr>


{foreach item=line from=$tableContent}
<tr>
	{foreach item=value from=$line}
		<td>{$value}</td>
	{/foreach}
</tr>
{/foreach}

</table>
{/if}
