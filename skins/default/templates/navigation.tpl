<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#">myVBC</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">

        <ul class="navbar-nav mr-auto">
                {if $currentPage == "index"}
                <li class="nav-item active">
                {else}
                <li class="nav-item">
                {/if}
                <a class="nav-link" href="?page=index" data-toggle="tooltip" data-placement="bottom" title="myVBC Startseite"><i class="fa fa-2x fa-home"></i></a>
            </li>

            {if $canAddress}
                {if $currentPage == "address"}
                <li class="nav-item active">
                {else}
                <li class="nav-item">
                {/if}
                    <a class="nav-link" href="?page=address" data-toggle="tooltip" data-placement="bottom" title="Mitglieder Verwaltung"><i class="fa fa-2x fa-globe"></i></a>
                </li>
            {/if}

            {if $canOrder}
                {if $currentPage == "order"}
                <li class="nav-item active">
                {else}
                <li class="nav-item">
                {/if}
                    <a class="nav-link" href="?page=order" data-toggle="tooltip" data-placement="bottom" title="Lizenzbestellung"><i class="fa fa-2x fa-shopping-cart"></i></a>
                </li>
            {/if}

            {if $canTeam}
                {if $currentPage == "team"}
                <li class="nav-item active">
                {else}
                <li class="nav-item">
                {/if}
                    <a class="nav-link" href="?page=team" data-toggle="tooltip" data-placement="bottom" title="Team Verwaltung"><i class="fa fa-2x fa-users"></i></a>
                </li>
            {/if}

            {if $canGames}
                {if $currentPage == "games"}
                <li class="nav-item active">
                {else}
                <li class="nav-item">
                {/if}
                    <a class="nav-link" href="?page=games" data-toggle="tooltip" data-placement="bottom" title="Spiele"><i class="fa fa-2x fa-futbol-o"></i></a>
                </li>
            {/if}

            {if $canKey}
                {if $currentPage == "key"}
                <li class="nav-item active">
                {else}
                <li class="nav-item">
                {/if}
                    <a class="nav-link" href="?page=key" data-toggle="tooltip" data-placement="bottom" title="Schl&uuml;ssel"><i class="fa fa-2x fa-key"></i></a>
                </li>
            {/if}

            {if $canReport}
                {if $currentPage == "report"}
                <li class="nav-item active">
                {else}
                <li class="nav-item">
                {/if}
                    <a class="nav-link" href="?page=report" data-toggle="tooltip" data-placement="bottom" title="Reports"><i class="fa fa-2x fa-book"></i></a>
                </li>
            {/if}


            {if $canNotification}
                {if $currentPage == "notification"}
                <li class="nav-item active">
                {else}
                <li class="nav-item">
                {/if}
                    <a class="nav-link" href="?page=notification" data-toggle="tooltip" data-placement="bottom" title="Benachrichtigungen"><i class="fa fa-2x fa-comments"></i>

                        {if $numOfNotification > 0}
                            <span style="background-color: red" class="badge">{$numOfNotification}</span>
                        {/if}


                        </a>
                </li>
            {/if}


            {if $canAdmin}
                {if $currentPage == "admin"}
                <li class="nav-item dropdown active">
                {else}
                <li class="nav-item dropdown">
                {/if}
                
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-2x fa-wrench"></i><span class="caret"></span>
                    </a>
                    <div class="dropdown-menu bg-dark">
                        <a class="nav-link" href="index.php?page=admin&action=access">Zugangsberechtigung</a>
                        <a class="nav-link" href="index.php?page=admin&action=report">Berichte</a>

                        <a class="nav-link" href="index.php?page=admin&action=notifications">Benachrichtigungen</a>

                        <a class="nav-link" href="index.php?page=admin&action=updateStatus">Aktiv Status aktualisieren</a>

                        <a class="nav-link" href="index.php?page=admin&action=changePassword">Passw&ouml;rter &auml;ndern</a>

                        <a class="nav-link" href="index.php?page=admin&action=clearGames">
                                <i class="fa fa-exclamation-triangle" style="color:red" aria-hidden="true"></i> Spiele entfernen
                            </a>
                     </div>
                </li>
            {/if}
            <li class="nav-item">
                {if $isAuth}
                    <a class="nav-link" href="?page=auth" data-toggle="tooltip" data-placement="bottom" title="Beenden"><i class="fa fa-2x fa-sign-out"></i></a>
                {/if}
            </li>
        </ul>
    </div>
</nav>

