
{if $isAuth}
	<a class="btn btn-outline-dark" data-toggle="tooltip" data-placement="bottom" title="Zur&uuml;ck zur &Uuml;bersicht" href="index.php?page={$currentPage}&action=main"><i class="fas fa-caret-square-left"></i></a>
{/if}
<a class="btn btn-outline-dark" data-toggle="tooltip" data-placement="bottom" title="CSV Export" href="index.php?page={$currentPage}&action=exportReport&reportID={$reportID}">
    <i class="fa fa-file-export"></i>
</a>
<a class="btn btn-outline-dark" href="#" onClick='window.print()' data-toggle="tooltip" data-placement="bottom" title="Drucken">
  <i class="fas fa-print"></i>
</a>


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
<table class="table table-sm">
<thead class="thead-inverse">
	<tr>
		{foreach item=value from=$tableHeader}
			<th>{$value}</th>
		{/foreach}
	</tr>
</thead>
<tbody>
	{foreach item=line from=$tableContent}
	<tr>
		{foreach item=value from=$line}
			<td>{$value}</td>
		{/foreach}
	</tr>
	{/foreach}
</tbody>

</table>
{/if}
