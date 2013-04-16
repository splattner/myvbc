{include file='messages/info.tpl'}
<table class="edit">
	<tr>
		<th width="30%">
			Meine Daten bearbeiten
		</th>
		<th width="70%" style="text-align: right;">
			<a {popup caption="zurück" text="Zurück zur Übersicht"} href="index.php?page=index&action=main"><img src="{$templateDir}/images/icons/cross.png"></a>
		</th>
	</tr>
	<tr>
		<td colspan="2">{$plugins.persondata}</td>
	</tr>
</table>

{$plugins.history}

