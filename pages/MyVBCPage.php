<?php
/**
 * Created by PhpStorm.
 * User: sebastianplattner
 * Date: 04.09.16
 * Time: 15:52
 */

namespace splattner\myvbc\pages;
use splattner\framework\Page;
use splattner\myvbc\models\MNotification;

abstract class MyVBCPage extends Page
{
    public function init() {
        parent::init();

        // TODO: Should be done in a other way! This is too static
        $this->smarty->assign("canOrder", $this->acl->acl_check("order", "main", "user", $this->session->uid));
        $this->smarty->assign("canAddress", $this->acl->acl_check("address", "main", "user", $this->session->uid));
        $this->smarty->assign("canTeam", $this->acl->acl_check("team", "main", "user", $this->session->uid));
        $this->smarty->assign("canGames", $this->acl->acl_check("games", "main", "user", $this->session->uid));
        $this->smarty->assign("canAdmin", $this->acl->acl_check("admin", "main", "user", $this->session->uid));
        $this->smarty->assign("canReport", $this->acl->acl_check("report", "main", "user", $this->session->uid));
        $this->smarty->assign("canNotification", $this->acl->acl_check("notification", "main", "user", $this->session->uid));
        $this->smarty->assign("canKey", $this->acl->acl_check("key", "main", "user", $this->session->uid));


    }

    /**
     * Show a custom not Authorized Message
     */
    protected function notAllowed() {
        $this->setTemplate("auth/notAuthorized.tpl");
        $this->smarty->assign("msg", "Sie sind nicht berechtigt, diese Funktion auszuf&uuml;hren");
    }

    public function render() {


        $notification = new MNotification();
        $rs = $notification->getNotificationStatus($this->session->uid);
        $this->smarty->assign("numOfNotification", $rs->RecordCount());


        parent::render();
    }
}