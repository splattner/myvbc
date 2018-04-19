{include file='messages/info.tpl'}


<div class="card">
	<h4 class="card-header">
		<a class="btn btn-dark" data-toggle="tooltip" data-placement="bottom" title="Zur&uuml;ck zur &Uuml;bersicht" href="index.php?page={$currentPage}&action=createAccess"><i class="fas fa-times"></i></a> Zugang einrichten
	</h4>
	<div class="card-body">
		<form action="index.php?page={$currentPage}&action=createAccess&step2" method="POST">
			<div class="row">
				<div class="col-sm-4">
					Information
				</div>
				<div class="col-sm-8">
					<p>
						Ihr Passwort wird Ihnen per SMS oder E-Mail zugestellt.
						Deshalb ist es wichtig, dass Ihre Angaben stimmen. <br/>
						Wenn keine Mobile-Nummer hinterlegt ist, wird Ihnen dass Passwort per E-Mail zugestellt.<br />
						Pr&uuml;fen Sie deshalb bitte ob 1. Ihre Mobile Nummer simmt, wenn keine Mobile Nummer vorhanden ist,
						pr&uuml;fen Sie bitte Ihre E-Mail Adresse.
					</p>
					<p>
						<b style="color: #FF0000;">Achtung:</b> Wenn die hier angezeigten Daten nicht stimmen,
						m&uuml;ssen Sie dies zuerst per E-Mail an  <a href="mailto:myVBC@vbclangenthal.ch" >myVBC@vbclangenthal.ch</a> melden,
						damit die korrekte Adresse eingetragen werden kann!
						<br /> <br /><b>Erst danach kann Ihr Zugang erstellt werden!</b>
					</p>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-4">
					Mobile
				</div>
				<div class="col-sm-8">
					{$persons.mobile}
					{if not $persons.mobile == ""}
					<br /><b style="color: #FF0000;">Diese Nummer wird f&uuml;r den Passwort versand benutzt!</b>
					{/if}
				</div>
			</div>
			<div class="row">
				<div class="col-sm-4">
					E-Mail Adresse
				</div>
				<div class="col-sm-8">
					{$persons.email}
					{if $persons.mobile == "" && $person.email != ""}
					<br /><b style="color: #FF0000;">Diese E-Mail Adresse wird f&uuml;r den Passwort Versand benutzt!</b>
					{/if}
				</div>
			</div>
			<div class="row">
				<div class="col-sm-4">

				</div>
				<div class="col-sm-8">
					{if ($persons.mobile != "") or ($persons.email != "")}
						<input class="btn btn-dark" type="submit" name="doAdd" value="Zugang erstellen">
						<input type="hidden" name="personID" value="{$persons.id}">
					{else}
						<b style="color: #FF0000;">Keine Telefon Nummer und keine E-Mail Adresse vorhanden</b>
					{/if}
				</div>
			</div>

		</form>

	</div>
</div>
