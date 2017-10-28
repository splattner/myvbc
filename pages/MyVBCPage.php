<?php

namespace splattner\myvbc\pages;

use splattner\framework\Page;
use splattner\myvbc\models\MNotification;

abstract class MyVBCPage extends Page
{
    private $AppVersion;

    public function init()
    {
        parent::init();

        $pages = array("orderPage","addressPage","teamPage","gamesPage","adminPage","reportPage","notificationPage","keyPage");

        foreach ($pages as $ressource) {
            if (!$this->acl->hasResource($ressource)) {
                $this->acl->addResource($ressource);
            }
        }

        $this->acl->allow("manager", ["notificationPage", "orderPage"], ["view"]);
        $this->acl->allow("vorstand", ["addressPage","teamPage","gamesPage","reportPage","keyPage"], ["view"]);
        $this->acl->allow("administrator", ["adminPage"], ["view"]);

        $composerJSON = json_decode(file_get_contents('composer.json'), true);
        $this->appVersion = $composerJSON["version"];
        $this->smarty->assign("appVersion", $this->appVersion);


        // TODO: Should be done in a other way! This is too static
        $this->smarty->assign("canOrder", $this->acl->isAllowed($this->session->role, "orderPage", "view"));
        $this->smarty->assign("canAddress", $this->acl->isAllowed($this->session->role, "addressPage", "view"));
        $this->smarty->assign("canTeam", $this->acl->isAllowed($this->session->role, "teamPage", "view"));
        $this->smarty->assign("canGames", $this->acl->isAllowed($this->session->role, "gamesPage", "view"));
        $this->smarty->assign("canAdmin", $this->acl->isAllowed($this->session->role, "adminPage", "view"));
        $this->smarty->assign("canReport", $this->acl->isAllowed($this->session->role, "reportPage", "view"));
        $this->smarty->assign("canNotification", $this->acl->isAllowed($this->session->role, "notificationPage", "view"));
        $this->smarty->assign("canKey", $this->acl->isAllowed($this->session->role, "keyPage", "view"));
    }

    /**
     * Show a custom not Authorized Message
     */
    protected function notAllowed()
    {
        $this->setTemplate("auth/notAuthorized.tpl");
        $this->smarty->assign("msg", "Sie sind nicht berechtigt, diese Funktion auszuf&uuml;hren");
    }

    public function render()
    {
        $notification = new MNotification();
        $rs = $notification->getNotificationStatus($this->session->uid);
        $this->smarty->assign("numOfNotification", $rs->rowCount());


        parent::render();
    }
}
