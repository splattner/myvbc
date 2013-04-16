<form action="index.php?page={$currentPage}&action=editReport&reportID={$report[0].id}" method="POST">
<table class="edit">
	<tr>
		<th width="30%">
			Bericht bearbeiten
		</th>
		<th width="70%" style="text-align: right;">
			<a {popup caption="zurück" text="Zurück zur Übersicht"} href="index.php?page={$currentPage}&action=report"><img src="{$templateDir}/images/icons/cross.png" alt="zur&uuml;ck"></a>
		</th>
	</tr>
	<tr>
		<td width="30%">Titel</td>
		<td width="70%"><input class="textinput" type="text" name="title" value="{$report[0].title}"></td>
	</tr>
	<tr>
		<td width="30%">Query</td>
		<td width="70%">
			<textarea name="query" rows="20" cols="40">{$report[0].query}</textarea>
			</td>
	</tr>

	<td>
		<td colspan="2">
			<input type="submit" name="doEdit" value="bearbeiten" />
		</td>
	</tr>

</table>
</form>