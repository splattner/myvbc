<?php

namespace splattner\myvbc\pages;

use splattner\myvbc\models\MNotification;

class PageNotification extends MyVBCPage
{
    public function __construct()
    {
        parent::__construct();
        $this->pagename = "notification";
        $this->template = "notification/notification.tpl";

        $this->acl->allow("manager", ["main", "delete"], ["view"]);
    }

    public function init()
    {
        parent::init();
        $this->smarty->assign("content", $this->template);
    }

    public function cleanup()
    {
        parent::cleanup();
    }



    public function mainAction()
    {
        $this->smarty->assign("subContent1", "notification/notificationTable.tpl");

        $notification = new MNotification();
        $recordSet = $notification->getNotificationStatus($this->session->uid);
        $this->smarty->assign("notifications", $recordSet->fetchAll());
    }

    public function deleteAction()
    {
        $notificationID = $_GET["notificationID"];

        $notification = new MNotification();
        $notification->deleteNotificationStatus($notificationID, $this->session->uid);

        return "main";
    }
}
