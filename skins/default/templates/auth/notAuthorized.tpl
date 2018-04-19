<div class="card text-white bg-danger mb-3">
    <div class="card-header">
        Keine Berechtigung
    </div>
    <div class="card-body">
		<p>
			<b>Achtung:</b> {$msg}
		</p>
		{if not $isAuth}
            <p>
                Sie m&uuml;ssen sich zuerst anmelden.<br/>
                <a class="btn btn-dark" href="index.php"><i class="fas fa-caret-square-right"></i> Login</a>
            </p>
        {else}
            <p>
                Sie haben nicht die ben&ouml;tigten Berechtigungen um diese Seite anzuzeigen
            </p>
		{/if}
    </div>
</div>

</div>
