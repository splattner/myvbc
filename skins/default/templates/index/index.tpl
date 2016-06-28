{if $isAuth}

    {include file='messages/info.tpl'}

	{include file='index/myDatas.tpl'}
	{include file='index/myTeams.tpl'}
	{include file='index/myGames.tpl'}
	{include file='index/mySchreiber.tpl'}
	{include file='index/myRefGames.tpl'}
{else}
<table class="overview">
<tr>
	<td style="text-align: center;width: 200px; height: 200px;">
		<img src="{$templateDir}/images/logo_vbcl.gif">
	</td>
	<td style="">
		<h3>
			Willkommen in der VBC Langenthal Web-Verwaltung
		</h3>
		<p>
			Um die Funktionen dieser Web-Verwaltung zu benutzen, m&uuml;ssen Sie sich zuerst authentifizieren.
		</p>

		<p class="indented">
			<a href="?page=auth"><i class="fa fa-sign-in"></i>&nbsp;Mit E-Mail Adresse und Passwort anmelden</a>
		</p>
		
				
		<p> <i class="fa fa-exclamation-circle"></i> Wenn Sie noch keinen Zugang haben, schreiben Sie bitte eine E-Mail an <a href="mailto:myVBC@vbclangenthal.ch" >myVBC@vbclangenthal.ch</a> um einen
			Zugang einzurichten!
		</p>
	</td>
</tr>
</table>

{/if}