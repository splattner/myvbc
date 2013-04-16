<h3>Workflow Verwaltung</h3>

<p>
	<a {popup caption="neuer Workflow" text="Neuer Workflow zum System hinzuf�gen"}href="index.php?page={$currentPage}&action=addWorkflow"><img src="{$templateDir}/images/icons/cog_add.png"></a>
</p>

{include file='messages/info.tpl'}

<table class="wide">
<tr>
	<th>&nbsp;</th>
	<th>Titel</th>
	<th>&nbsp;</th>
</tr>

{foreach item=workflow from=$workflows}
<tr>
	<td><img src="{$templateDir}/images/icons/bullet_green.png""></td>
	<td>{$workflow.name}</td>
	<td align="right">
		<a class="icons" href="index.php?page={$currentPage}&action=editWorkflow&workflowID={$workflow.id}" {popup caption="bearbeiten" text="Workflow bearbeiten"}><img src="{$templateDir}/images/icons/cog_edit.png"></a>
		<a class="icons" onclick="return confirm('Willst du diesen Eintrag wirklich l�schen?')" href="index.php?page={$currentPage}&action=deleteWorkflow&workflowID={$workflow.id}" {popup caption="l�schen" bgcolor="#FF0000" text="Workflow aus System entfernen. Achtung: Dies geschieht sofort und kann nicht r�ckg�ngig gemacht werden"}><img src="{$templateDir}/images/icons/cog_delete.png"></a>
	</td>
</tr>
{/foreach}
</table>