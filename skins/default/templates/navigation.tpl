<div class="navbar-header">
    <a class="navbar-brand" href="#">
        myvbc
    </a>
</div>

<ul class="nav navbar-nav">


    <li role="presentation">
        <a href="?page=index" data-toggle="tooltip" data-placement="bottom" title="myVBC Startseite"><i class="fa fa-2x fa-home"></i></a>
    </li>

    {if $canAddress}
        <li role="presentation">
            <a href="?page=address" data-toggle="tooltip" data-placement="bottom" title="Mitglieder Verwaltung"><i class="fa fa-2x fa-globe"></i></a>
        </li>
    {/if}

    {if $canOrder}
        <li role="presentation">
            <a href="?page=order" data-toggle="tooltip" data-placement="bottom" title="Lizenzbestellung"><i class="fa fa-2x fa-shopping-cart"></i></a>
        </li>
    {/if}

    {if $canTeam}
        <li role="presentation">
            <a href="?page=team" data-toggle="tooltip" data-placement="bottom" title="Team Verwaltung"><i class="fa fa-2x fa-users"></i></a>
        </li>
    {/if}

    {if $canKey}
        <li role="presentation">
            <a href="?page=games" data-toggle="tooltip" data-placement="bottom" title="Spiele"><i class="fa fa-2x fa-futbol-o"></i></a>
        </li>
    {/if}

    {if $canKey}
        <li role="presentation">
            <a href="?page=key" data-toggle="tooltip" data-placement="bottom" title="Schl&uuml;ssel"><i class="fa fa-2x fa-key"></i></a>
        </li>
    {/if}

    {if $canReport}
        <li role="presentation">
            <a href="?page=report" data-toggle="tooltip" data-placement="bottom" title="Reports"><i class="fa fa-2x fa-book"></i></a>
        </li>
    {/if}


    {if $canNotification}
        <li role="presentation">
            <a href="?page=notification" data-toggle="tooltip" data-placement="bottom" title="Benachrichtigungen"><i class="fa fa-2x fa-comments"></i>

                {if $numOfNotification > 0}
                    <span style="background-color: red" class="badge">{$numOfNotification}</span>
                {/if}


                </a>
        </li>
    {/if}


    {if $canAdmin}
        <li role="presentation" class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true"
               aria-expanded="false">
                <i class="fa fa-2x fa-wrench"></i><span class="caret"></span>
            </a>
            <ul class="dropdown-menu">
                <li role="presentation">
                    <a href="index.php?page=admin&action=access">Zugangsberechtigung</a>
                </li>
                <li role="presentation">
                    <a href="index.php?page=admin&action=report">Berichte</a>
                </li>
                <li role="presentation">
                    <a href="index.php?page=admin&action=notifications">Benachrichtigungen</a>
                </li>
                <li role="presentation">
                    <a href="index.php?page=admin&action=updateStatus">
                        Aktiv Status aktualisieren</a>
                </li>
                <li role="presentation">
                    <a href="index.php?page=admin&action=changePassword">
                        Passw&ouml;rter &auml;ndern</a>
                </li>
                <li role="presentation">
                    <a href="index.php?page=admin&action=clearGames">
                        Spiele entfernen</a>
                </li>
                <li role="presentation">
                    <a href="index.php?page=admin&action=gacl">
                        ACL Settings</a>
                </li>
            </ul>
        </li>
    {/if}
</ul>
<ul class="nav navbar-nav navbar-right">

    <li role="presentation">
        {if not $isAuth}
            <a href="?page=auth" data-toggle="tooltip" data-placement="bottom" title="Anmelden"><i class="fa fa-2x fa-sign-in"></i></a>
        {/if}
        {if $isAuth}
            <a href="?page=auth" data-toggle="tooltip" data-placement="bottom" title="Beenden"><i class="fa fa-2x fa-sign-out"></i></a>
        {/if}
    </li>

</ul>


