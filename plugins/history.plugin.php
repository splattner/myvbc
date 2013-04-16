<?
MyModel::loadModel("notification");
MyModel::loadModel("order");

class PHistory extends MyPlugin {


	private $notifications;
	private $myorders;

	public function __toString() {
		$this->smarty->assign("notifications", $this->notifications);
		$this->smarty->assign("myorders", $this->myorders);

		return MyPlugin::__toString();
	}

	public function run($action) {
	
		$this->contentFile = "plugins/history/table.tpl";

		$m_notifications = new MNotification();
		$this->notifications = $m_notifications->getHistory($this->data["personID"]);
			

		$m_orders = new MOrder();
		$this->myorders = $m_orders->getPersonOrders($this->data["personID"]);
	
	}
}
