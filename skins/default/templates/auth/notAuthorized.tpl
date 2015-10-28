<div class="panel panel-danger">
    <div class="panel-heading">
        <h3 class="panel-title">Keine Berechtigung</h3>
    </div>
    <div class="panel-body">
		<p>
			<b>Achtung:</b> {$msg}
		</p>
		{if not $isAuth}
            <p>
                Sie m&uuml;ssen sich zuerst anmelden.<br/>
                <a href="?page=auth"><i class="fa fa-caret-square-o-right"></i> Mit E-Mail Adresse und Passwort anmelden
            </p>
        {else}
            <p>
                Sie haben nicht die ben&ouml;tigten Berechtigungen um diese Seite anzuzeigen
            </p>
		{/if}
    </div>
</div>

</div>

