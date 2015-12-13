<p class="submenu">
	{if $isAuth}
		<a data-toggle="tooltip" data-placement="bottom" title="Zur&uuml;ck zur &Uuml;bersicht" href="index.php?page={$currentPage}&action=main"<i class="fa fa-caret-square-o-left"></i></a>
	{/if}
	<a href="#" onClick='window.print()' data-toggle="tooltip" data-placement="bottom" title="Drucken"><i class="fa fa-print"></i></a>
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
