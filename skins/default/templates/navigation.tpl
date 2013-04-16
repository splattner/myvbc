<a href="?page=index" {popup caption="Übersicht" text="Deine myVBC Startseite"}><img src="skins/default/images/icons/house.png"></a>




{if $canAddress}
<a href="?page=address" {popup caption="Mitglieder Verwaltung" text="Alle Adressen bearbeiten oder neue Personen eintragen"}><img src="skins/default/images/icons/book_addresses.png"></a>
{/if}

{if $canOrder}
<a href="?page=order" {popup caption="Lizenzbestellung" text="neue Lizenzen bestellen, Status von Bestellungen prüfen"}><img src="skins/default/images/icons/basket.png"></a>
{/if}

{if $canTeam}
<a href="?page=team" {popup caption="Team Verwaltung" text="Team Daten bearbeiten. Neue Teams erstellen. Personen den Teams zuordnen"}><img src="skins/default/images/icons/group.png"></a>
{/if}

{if $canGames}
<a href="?page=games" {popup caption="Spiele" text="Spiele verwaltung und von Externen Quellen importieren. Schreiber den Spielen zuweisen"}><img src="skins/default/images/icons/sport_soccer.png"></a>
{/if}

{if $canReport}
<a href="?page=report" {popup caption="Reports" text="Berichte, Dokumente erstellen. Teamlisten, Schreiberlisten, etc"}><img src="skins/default/images/icons/report.png"></a>
{/if}

{if $canNotification}
<a href="?page=notification" {popup caption="Benachrichtigung" text="Benachrichtigungs-Meldungen anschauen und bestätigen"}><img src="skins/default/images/icons/note.png"></a>
{/if}

{if $canWorkflow}
<a href="?page=workflow" {popup caption="Workflow" text="Workflow Status pr&uuml;fen und ausl&ouml;sen"}><img src="skins/default/images/icons/cog.png"></a>
{/if}

{if $canAdmin}
<a href="?page=admin" {popup caption="Administration" text="Administrative Aufgaben. Zugangsberechtigungen verwalten"}><img src="skins/default/images/icons/wrench.png"></a>
{/if}

&nbsp;&nbsp;&nbsp;&nbsp;

{if not $isAuth}
	<a href="?page=auth" {popup caption="Anmelden" text="Mit E-Mail Adresse und Passwort an myVBC anmelden"} ><img src="skins/default/images/icons/key.png"></a>
{/if}
{if $isAuth}
	<a href="?page=auth" {popup caption="Beenden" text="myVBC beenden und ausloggen"}><img src="skins/default/images/icons/cross.png"></a>
{/if}