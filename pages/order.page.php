<?php
MyModel::loadModel("person");
MyModel::loadModel("order");
MyModel::loadModel("team");



class PageOrder extends MyPage
{
	
	public function __construct() {
		parent::__construct();
		$this->pagename = "order";
		$this->template = "order/order.tpl";
		

	}
	
	public function init() {
		parent::init();
		$this->smarty->assign("content", $this->template);
		
		
		$this->xajax->register(XAJAX_FUNCTION, array("getItemsEntry", $this, "getItemsEntry"));
		$this->xajax->register(XAJAX_FUNCTION, array("showaddLicenceForm", $this, "showaddLicenceForm"));
		$this->xajax->register(XAJAX_FUNCTION, array("addLicenceToOrder", $this, "addLicenceToOrder"));
		$this->xajax->register(XAJAX_FUNCTION, array("removeLicenceFromOrder", $this, "removeLicenceFromOrder"));
		
				
		$this->customerJavaScript  .= "
			<script type=\"text/javascript\">
				function getItemsEntry(orderID) {
					xajax_getItemsEntry(orderID);
				}
				
				function showaddLicenceForm(orderID) {
					xajax_showaddLicenceForm(orderID);
				}
				
				function addLicenceToOrder(orderID) {
					var personID = document.getElementById('personID').options[document.getElementById('personID').selectedIndex].value;
					xajax_addLicenceToOrder(personID, orderID);
				}
				function removeLicenceFromOrder(personID, orderID) {
					xajax_removeLicenceFromOrder(personID, orderID);
				}
			</script>
		";
		
	}
	
		
	public function mainAction() {
		$this->smarty->assign("subContent1", "order/orderTable.tpl");
		
		$this->smarty->assign("allowedit", $this->acl->acl_check("order", "allowedit", "user", $this->session->uid));
		
		$order = new MOrder();
		$rs = $order->getOrder();
		$this->smarty->assign("orders", $rs->getArray());

		$teams = new MTeam();
		$rs = $teams->getRS("","teams.name");

		$this->smarty->assign("teams", $rs->getArray());


	}
	
	public function closeOrderAction() {
		$orderID = $_GET["orderID"];
		$order = new MOrder();
		$order->updateStatus(2, $orderID);
		
		return "list";
	}
	
	
	public function deleteAction() {
		
		$orderID = $_GET["orderID"];
		$order = new MOrder();
		$order->delete("id = " . $this->db->qstr($orderID));
		
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
			
			$rs = $order->getRS("id=" . $orderID, "");
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
		
		$order = new MOrder();
		$rs = $order->getOrder($orderID);
		$this->smarty->assign("orders", $rs->getArray());
		
		$this->smarty->assign("allowedit", $this->acl->acl_check("order", "allowedit", "user", $this->session->uid));
		
		
		$rs = $order->getStatusList();
		$this->smarty->assign("statuslist", $rs->getArray());
		
		
		$this->loaderJavaScript .= "
			<script type=\"text/javascript\">
				getItemsEntry(" . $orderID . ")
			</script>
		";
		$this->smarty->assign("loaderJavaScript", $loaderJavaScript);
		
	}
	
	public function addLicenceToOrder($personID, $orderID) {
		$this->smarty->assign("content", "order/orderItemEntrys.tpl");
		
		$order = new MOrder();
		$order->addLicenceToOrder($personID, $orderID);
		
		$rs = $order->getOrderItems($orderID);
		$this->smarty->assign("orderitems", $rs->getArray());
		
		$this->smarty->assign("allowedit", $this->acl->acl_check("order", "allowedit", "user", $this->session->uid));
		$this->smarty->assign("orderID", $orderID);
		
		// Create AJAX Response
		$objResponse = new xajaxResponse();
		$objResponse->assign("orderitemsnew", "innerHTML", "");
		$objResponse->assign("orderitems", "innerHTML", $this->render());

		return $objResponse;
	}
	
	public function removeLicenceFromOrder($personID, $orderID) {
		$this->smarty->assign("content", "order/orderItemEntrys.tpl");
		
		$order = new MOrder();
		$order->removeLicenceFromOrder($personID, $orderID);
		
		$rs = $order->getOrderItems($orderID);
		$this->smarty->assign("orderitems", $rs->getArray());
		
		$this->smarty->assign("allowedit", $this->acl->acl_check("order", "allowedit", "user", $this->session->uid));
		$this->smarty->assign("orderID", $orderID);
		
		// Create AJAX Response
		$objResponse = new xajaxResponse();
		$objResponse->assign("orderitems", "innerHTML", $this->render());

		return $objResponse;
	}
	
	
	public function showaddLicenceForm($orderID) {
		$this->smarty->assign("content", "order/addlicenceform.tpl");
		$this->smarty->assign("orderID", $orderID);
		
		$person = new MPerson();
		$rs = $person->getRS("active = 1 AND signature = 1","persons.name ASC, persons.prename ASC");
		$this->smarty->assign("persons", $rs->getArray());
		
		// Create AJAX Response
		$objResponse = new xajaxResponse();
		$objResponse->assign("orderitemsnew", "innerHTML", $this->render());
		return $objResponse;
	}
	
	public function getItemsEntry($orderID) {
		$this->smarty->assign("content", "order/orderItemEntrys.tpl");
		
		$this->smarty->assign("allowedit", $this->acl->acl_check("order", "allowedit", "user", $this->session->uid));
		
		
		$order = new MOrder();
		$rs = $order->getOrder($orderID);
		$this->smarty->assign("order", $rs->getArray());
		
		$rs = $order->getOrderItems($orderID);
		$this->smarty->assign("orderitems", $rs->getArray());
		
		
		// Create AJAX Response
		$objResponse = new xajaxResponse();
		$objResponse->assign("orderitems", "innerHTML", $this->render());
		return $objResponse;		
	}
}

?>
