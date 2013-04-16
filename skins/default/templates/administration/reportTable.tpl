<h3>Berichte Verwaltung</h3>

<p>
	<a {popup caption="neuer Bericht" text="Neuer Bericht zum System hinzufügen"}href="index.php?page={$currentPage}&action=addReport"><img src="{$templateDir}/images/icons/report_add.png"></a>
</p>

{include file='messages/info.tpl'}

<table class="wide">
<tr>
	<th>&nbsp;</th>
	<th>Titel</th>
	<th>&nbsp;</th>
</tr>

{foreach item=report from=$reports}
<tr>
	<td><img src="{$templateDir}/images/icons/bullet_green.png""></td>
	<td>{$report.title}</td>
	<td align="right">
		<a class="icons" href="index.php?page={$currentPage}&action=editReport&reportID={$report.id}" {popup caption="bearbeiten" text="Bericht bearbeiten"}><img src="{$templateDir}/images/icons/report_edit.png"></a>
		<a class="icons" onclick="return confirm('Willst du diesen Eintrag wirklich löschen?')" href="index.php?page={$currentPage}&action=deleteReport&reportID={$report.id}" {popup caption="löschen" bgcolor="#FF0000" text="Bericht aus System entfernen. Achtung: Dies geschieht sofort und kann nicht rückgängig gemacht werden"}><img src="{$templateDir}/images/icons/report_delete.png"></a>
	</td>
</tr>
{/foreach}
</table>