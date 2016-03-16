<h3>Berichte Verwaltung</h3>

<p>
	<a  title="Neuer Bericht erfassen" href="index.php?page={$currentPage}&action=addReport">
		<i class="fa fa-plus-square"></i>
	</a>
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
		<a class="icons" data-toggle="tooltip" data-placement="bottom" title="Report bearbeiten" href="index.php?page={$currentPage}&action=editReport&reportID={$report.id}">
			<i class="fa fa-pencil-square-o"></i>
		</a>
		<a onclick="return confirm('Willst du diesen Eintrag wirklich l&ouml;schen?')" data-toggle="tooltip" data-placement="bottom" title="Report l&ouml;schen" href="index.php?page={$currentPage}&action=deleteReport&reportID={$report.id}">
			<i style="color: red;" class="fa fa-trash-o"></i>
		</a>

	</td>
</tr>
{/foreach}
</table>