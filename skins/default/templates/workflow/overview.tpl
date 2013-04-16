<table class="wide">
<tr>
	<th>Type</th>
	<th>Betrifft</th>
	<th>Ersteller</th>
	<th>Datum</th>
	<th>Status</th>
	<th>&nbsp;</th>
</tr>

{foreach item=workflow from=$workflows}
<tr>
	<td>{$workflow.type}</td>
	<td>{$workflow.prename} {$workflow.name}</td>
	<td>{$workflow.creatorPrename} {$workflow.creatorName}</td>
	<td>{$workflow.date}</td>
	<td>{$workflow.state}</td>
	<td align="right">
	</td>
</tr>
{/foreach}
</table>
