<?php
namespace splattner\myvbc\pages;
use splattner\framework\Page;
use splattner\framework\Model;

use splattner\myvbc\models\MOrder;
use splattner\myvbc\models\MTeam;


class PageOrder extends MyVBCPage
{
	
	public function __construct() {
		parent::__construct();
		$this->pagename = "order";
		$this->template = "order/order.tpl";
		

	}
	
	public function init() {
		parent::init();
		$this->smarty->assign("content", $this->template);
		

	}
	
		
	public function mainAction() {
		$this->smarty->assign("subContent1", "order/orderTable.tpl");
		
		$this->smarty->assign("allowedit", $this->acl->acl_check("order", "allowedit", "user", $this->session->uid));
		
		$order = new MOrder();
		$rs = $order->getOrder();
		$this->smarty->assign("orders", $rs->getArray());

		$teams = new MTeam();
		$rs = $teams->getRS(array(),array("teams.name" => "ASC"));

		$this->smarty->assign("teams", $rs->getArray());


	}

	
	public function deleteAction() {
		
		$orderID = $_GET["orderID"];
		$order = new MOrder();
		$order->delete(array("id" => $orderID));
		
		return "main";	
	}

	public function newAction() {

		if (isset($_POST["doNew"])) {
			
			$order = new MOrder();
			$order->comment = $_POST["comment"];
			$order->teamid = $_POST["teamid"];
			$orderid = $order->addNewOrder();
			
			// Add all members of the selected team to this order
			if ($order->teamid > 0) {
				$team = new MTeam();
				$members = $team->getAllMember($order->teamid)->getArray();
				
				$order = new MOrder();
				
				foreach($members as $person) {
					if($person["signature"] == 1) {
						$order->addLicenceToOrder($person["personID"], $orderid);
					}
				}
			}

			$this->smarty->assign("messages","Lizenzbestellung eingetragen. Sie k&ouml;nnen diese nun bearbeiten");
			
			return "main";
		}

	}
	
	public function editOrderAction() {
		
		$orderID = $_GET["orderID"];
		
		
		if (isset($_POST["doEdit"])) {
			$order = new MOrder();
			$order->comment = $_POST["comment"];
			
			$order->update("id=" . $this->db->qstr($orderID));
			
			$rs = $order->getRS(array($order->pk ." =" => $orderID));
			$orderdetail = $rs->getArray();
			
		
			if (isset($_POST["statusID"]) && $orderdetail[0][status] != $_POST["statusID"]) {
				$order->updateStatus($_POST["statusID"], $orderID);
			}
			
			$this->smarty->assign("messages","Die Bestellung wurden bearbeitet!");

			unset($_POST["doEdit"]);
		}
		
		return "list";
	}
	
	public function listAction() {
		$this->smarty->assign("subContent1", "order/listOrder.tpl");
		
		$orderID = $_GET["orderID"];
		$this->smarty->assign("orderID", $orderID);

		
		$this->smarty->assign("allowedit", $this->acl->acl_check("order", "allowedit", "user", $this->session->uid));
		


	}
}

?>
