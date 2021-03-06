<?php
namespace splattner\myvbc\pages;

use splattner\myvbc\models\MOrder;
use splattner\myvbc\models\MTeam;

class PageOrder extends MyVBCPage
{
    public function __construct()
    {
        parent::__construct();
        $this->pagename = "order";
        $this->template = "order/order.tpl";

        $this->acl->allow("manager", ["main", "new","editOrder", "list"], ["view"]);
        $this->acl->allow("vorstand", ["delete"], ["view"]);
    }

    public function init()
    {
        parent::init();
        $this->smarty->assign("content", $this->template);
    }


    public function mainAction()
    {
        $this->smarty->assign("subContent1", "order/orderTable.tpl");

        $this->smarty->assign("allowedit", $this->acl->isAllowed($this->session->role, "editOrder", "view"));

        $order = new MOrder();
        $recordSet = $order->getOrder();
        $this->smarty->assign("orders", $recordSet->fetchAll());

        $teams = new MTeam();
        $recordSet = $teams->getRS(array(), array("teams.name" => "ASC"));

        $this->smarty->assign("teams", $recordSet->fetchAll());
    }


    public function deleteAction()
    {
        $orderID = $_GET["orderID"];
        $order = new MOrder();
        $order->delete(array("id" => $orderID));

        return "main";
    }

    public function newAction()
    {
        if (isset($_POST["doNew"])) {
            $order = new MOrder();
            $order->comment = $_POST["comment"];
            $order->teamid = $_POST["teamid"];
            $orderid = $order->addNewOrder();

            // Add all members of the selected team to this order
            if ($order->teamid > 0) {
                $team = new MTeam();
                $members = $team->getAllMember($order->teamid)->fetchAll();

                $order = new MOrder();

                foreach ($members as $person) {
                    if ($person["signature"] == 1) {
                        $order->addLicenceToOrder($person["personID"], $orderid);
                    }
                }
            }

            $this->smarty->assign("messages", "Lizenzbestellung eingetragen. Sie k&ouml;nnen diese nun bearbeiten");

            return "main";
        }
    }

    public function editOrderAction()
    {
        $orderID = $_GET["orderID"];


        if (isset($_POST["doEdit"])) {
            $order = new MOrder();
            $order->comment = $_POST["comment"];

            $order->update(array($order->pk => $orderID));

            $recordSet = $order->getRS(array($order->pk ." =" => $orderID));
            $orderdetail = $recordSet->fetch();


            if (isset($_POST["statusID"]) && $orderdetail[0][status] != $_POST["statusID"]) {
                $order->updateStatus($_POST["statusID"], $orderID);
            }

            $this->smarty->assign("messages", "Die Bestellung wurden bearbeitet!");

            unset($_POST["doEdit"]);
        }

        return "list";
    }

    public function listAction()
    {
        $this->smarty->assign("subContent1", "order/listOrder.tpl");

        $orderID = $_GET["orderID"];
        $this->smarty->assign("orderID", $orderID);


        $this->smarty->assign("allowedit", $this->acl->isAllowed($this->session->role, "editOrder", "view"));
    }
}
