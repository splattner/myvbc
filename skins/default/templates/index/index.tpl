	{if $isAuth}

    {include file='messages/info.tpl'}

	{include file='index/myDatas.tpl'}
	{include file='index/myTeams.tpl'}
	{include file='index/myGames.tpl'}
	{include file='index/mySchreiber.tpl'}
{else}
<div class="card">
	<div class="card-body">
		<h4 class="card-title">
			Willkommen in der VBC Langenthal Web-Verwaltung
		</h4>
		<p>
			Um die Funktionen dieser Web-Verwaltung zu benutzen, m&uuml;ssen Sie sich zuerst authentifizieren.
		</p>


		<div class="card card-primary">

			<div class="card-body">
		        <form action="?page=auth&action=login" method="post">
		            <div class="form-group input-group">
									<div class="input-group-prepend">
		              	<span class="input-group-text"><i class="fas fa-envelope"></i></span>
									</div>
		              <input type="email" class="form-control" id="email" placeholder="E-Mail Adresse" name="email">
		            </div>
		            <div class="form-group input-group">
									<div class="input-group-prepend">
		                <span class="input-group-text"><i class="fas fa-key"></i></span>
									</div>
									<input type="password" class="form-control" id="password" placeholder="Password" name="password">
		            </div>

		            <button type="submit" class="btn btn-dark" value="Login" name="doLogin"><i class="fas fa-sign-in-alt"></i> Login</button>
		        </form>
			</div>
			<div class="card-footer">
				<i class="fas fa-exclamation-circle"></i> Wenn Sie noch keinen Zugang haben, schreiben Sie bitte eine E-Mail an <a href="mailto:myVBC@vbclangenthal.ch" >myVBC@vbclangenthal.ch</a> um einen
			Zugang einzurichten!
			<div>
		</div>
	</div>
</div>

{/if}
