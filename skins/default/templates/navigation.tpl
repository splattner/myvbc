<div class="navbar-header">
    <a class="navbar-brand" href="#">
        myvbc
    </a>
</div>

<ul class="nav navbar-nav">


    <li role="presentation">
        <a href="?page=index" data-toggle="tooltip" data-placement="bottom" title="myVBC Startseite"><img
                    src="skins/default/images/icons/house.png"></a>
    </li>

    {if $canAddress}
        <li role="presentation">

            <a href="?page=address" data-toggle="tooltip" data-placement="bottom" title="Mitglieder Verwaltung"><img
                        src="skins/default/images/icons/book_addresses.png"></a>
        </li>
    {/if}

    {if $canOrder}
        <li role="presentation">
            <a href="?page=order" data-toggle="tooltip" data-placement="bottom" title="Lizenzbestellung"><img
                        src="skins/default/images/icons/basket.png"></a>
        </li>
    {/if}

    {if $canTeam}
        <li role="presentation">
            <a href="?page=team" data-toggle="tooltip" data-placement="bottom" title="Team Verwaltung"><img
                        src="skins/default/images/icons/group.png"></a>
        </li>
    {/if}

    {if $canGames}
        <li role="presentation">
            <a href="?page=games" data-toggle="tooltip" data-placement="bottom" title="Spiele"><img
                        src="skins/default/images/icons/sport_soccer.png"></a>
        </li>
    {/if}

    {if $canReport}
        <li role="presentation">
            <a href="?page=report" data-toggle="tooltip" data-placement="bottom" title="Reports"><img
                        src="skins/default/images/icons/report.png"></a>
        </li>
    {/if}


    {if $canNotification}
        <li role="presentation">
            <a href="?page=notification" data-toggle="tooltip" data-placement="bottom" title="Benachrichtigungen"><img
                        src="skins/default/images/icons/note.png"></a>
        </li>
    {/if}


    {if $canAdmin}
        <li role="presentation" class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true"
               aria-expanded="false">
                <img src="skins/default/images/icons/wrench.png"><span class="caret"></span>
            </a>
            <ul class="dropdown-menu">
                <li role="presentation">
                    <a href="index.php?page={$currentPage}&action=updateStatus">
                        Aktiv Status aktualisieren</a>
                </li>
                <li role="presentation">
                    <a href="index.php?page={$currentPage}&action=changePassword">
                        Passw&ouml;rter &auml;ndern</a>
                </li>
                <li role="presentation">
                    <a href="index.php?page={$currentPage}&action=clearGames">
                        Spiele entfernen</a>
                </li>
                <li role="presentation">
                    <a href="index.php?page={$currentPage}&action=gacl">
                        ACL Settings</a>
                </li>
            </ul>
        </li>
    {/if}
</ul>
<ul class="nav navbar-nav navbar-right">

    <li role="presentation">
        {if not $isAuth}
            <a href="?page=auth" data-toggle="tooltip" data-placement="bottom" title="Anmelden"><img
                        src="skins/default/images/icons/key.png"></a>
        {/if}
        {if $isAuth}
            <a href="?page=auth" data-toggle="tooltip" data-placement="bottom" title="Beenden"><img
                        src="skins/default/images/icons/cross.png"></a>
        {/if}
    </li>

</ul>


