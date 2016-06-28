{literal}
    <link rel="stylesheet" href="libs/codemirror-5.14/lib/codemirror.css">
    <script src="libs/codemirror-5.14/lib/codemirror.js"></script>
    <script>
        var editor = CodeMirror.fromTextArea(query, {
            lineNumbers: true
        });
    </script>
{/literal}


<form action="index.php?page={$currentPage}&action=editReport&reportID={$report[0].id}" method="POST">
<table class="edit">
	<tr>
		<th width="30%">
			Bericht bearbeiten
		</th>
		<th width="70%" style="text-align: right;">
			<a data-toggle="tooltip" data-placement="bottom" title="Zur&uuml;ck" href="index.php?page={$currentPage}&action=report"><i style="color: red" class="fa fa-times"></i></a>
		</th>
	</tr>
	<tr>
		<td width="30%">Titel</td>
		<td width="70%"><input class="textinput" type="text" name="title" value="{$report[0].title}"></td>
	</tr>
	<tr>
		<td width="30%">Query</td>
		<td width="70%">
			<textarea id="query" name="query" rows="20" cols="40">{$report[0].query}</textarea>
			</td>
	</tr>

	<td>
		<td colspan="2">
			<input type="submit" name="doEdit" value="bearbeiten" />
		</td>
	</tr>

</table>
</form>