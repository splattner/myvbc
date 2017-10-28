<?php
namespace splattner\myvbc\plugins;

use splattner\framework\Plugin;
use splattner\framework\Model;
use splattner\myvbc\models\MOrder;
use splattner\myvbc\models\MNotification;

class PHistory extends Plugin
{
    private $notifications;
    private $myorders;

    public function __toString()
    {
        $this->smarty->assign("notifications", $this->notifications);
        $this->smarty->assign("myorders", $this->myorders);

        return Plugin::__toString();
    }

    public function run($action)
    {
        $this->contentFile = "plugins/history/table.tpl";

        $m_notifications = new MNotification();
        $this->notifications = $m_notifications->getHistory($this->data["personID"]);
            

        $m_orders = new MOrder();
        $this->myorders = $m_orders->getPersonOrders($this->data["personID"]);
    }
}
