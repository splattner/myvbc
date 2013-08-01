<h1>
	Administration
</h1>
<p>
	<a {popup caption="Zugangsberechtigung" text="Zugangsberechtigun zum System verwalten"} href="index.php?page={$currentPage}&action=access"><img src="{$templateDir}/images/icons/key.png"></a>
	<a {popup caption="Berichte" text="Berichte verwalten"} href="index.php?page={$currentPage}&action=report"><img src="{$templateDir}/images/icons/report.png"></a>
	<a {popup caption="Benachrichtigungen" text="Benachrichtigungs Subscriptions verwalten"} href="index.php?page={$currentPage}&action=notifications"><img src="{$templateDir}/images/icons/note.png"></a>
	<a {popup caption="Sonstiges" text="Sonstige Funktionen"} href="index.php?page={$currentPage}&action=functions"><img src="{$templateDir}/images/icons/computer.png"></a>
</p>


{if $subContent1} 
	{include file=$subContent1}
{/if}