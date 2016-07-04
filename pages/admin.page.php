<?php
MyModel::loadModel("person");
MyModel::loadModel("arogroup");
MyModel::loadModel("report");
MyModel::loadModel("player");
MyModel::loadModel("notification");
MyModel::loadModel("game");


class PageAdmin extends MyPage
{
	
	public function __construct() {
		parent::__construct();
		$this->pagename = "admin";
		$this->template = "administration/administration.tpl";
	}
	
	public function init() {
		parent::init();
		$this->smarty->assign("content", $this->template);
	}

	
	public function mainAction() {
		$this->smarty->assign("subContent1", "administration/overview.tpl");
		
	}
	
	public function accessAction() {
		$this->smarty->assign("subContent1", "administration/memberList.tpl");
		
		$person = new MPerson();
		$members = $person->getPersonsWithAccess();
		
		$this->smarty->assign("members", $members->getArray());
		
	}
	
	public function addAccessAction() {
		$this->smarty->assign("subContent1", "administration/addAccess.tpl");
		
		if (isset($_POST["doAdd"])) {
			$personID = $_POST["person"];
			$groupID = $_POST["group"];
			
			$person = new MPerson();
			$person->createAccess($personID,$groupID);
			
			$this->smarty->assign("messages","Zugang f&uuml;r Person wurde eingerichtet");
			
			return "access";		
		}
		
		$persons = new MPerson();
		$rs = $persons->getRS("","name ASC, prename ASC");
		$this->smarty->assign("users", $rs->getArray());
		
		$arogroups = new MAroGroup();
		$groups = $arogroups->getGroupList();
		$this->smarty->assign("groups", $groups->getArray());
	}
	
	public function removeAccessAction() {
		
		$personID = $_GET["personID"];
		
		$person = new MPerson();
		$person->removeAccess($personID);
		
		$this->smarty->assign("messages","Zugang f&uuml;r Person wurde entfernt");
		
		return "access";
		
	}
	
	public function reportAction() {
		$this->smarty->assign("subContent1", "administration/reportTable.tpl");
		
		$reports = new MReport();
		$rs = $reports->getRS();
		
		$this->smarty->assign("reports", $rs->getArray());
		
		
	}
	
	
	public function editReportAction() {
		$reportID = $this->db->qstr($_GET["reportID"]);
		
		if (isset($_POST["doEdit"])) {
			
			$sql ="UPDATE reports SET
				title = ?,
				query = ?
				WHERE id = ?";

			$sql = $this->db->Prepare($sql);
			$this->db->Execute($sql, array($_POST["title"],$_POST["query"], $reportID ));
			
			$this->smarty->assign("messages","Die Daten wurden bearbeitet!");
			
			return "report";
		}
		$this->smarty->assign("subContent1", "administration/editReport.tpl");
		
		$report = new MReport();
		$rs = $report->getRS("id = " . $reportID); 
		$this->smarty->assign("report", $rs->getArray());	
	}
	
	public function addReportAction() {
		if (isset($_POST["doNew"])) {
			
		
			$sql ="INSERT INTO reports (title, query) VALUES (?,?)";

            $sql = $this->db->Prepare($sql);
            $this->db->Execute($sql, array($_POST["title"],$_POST["query"] ));
			
			$this->smarty->assign("messages","Neuer Bericht wurde eingetragen");
			
			return "report";
		}
	}
	
	public function deleteReportAction() {
		
		$reportID = $_GET["reportID"];
		$reports = new MReport();
		
		$reports->delete(array("id" => $reportID));
		$this->smarty->assign("messages","Bericht wurde gel&ouml;scht");
		
		return "report";
		
	}
	
	public function functionsAction() {
		$this->smarty->assign("subContent1", "administration/functions.tpl");
		
	}
	
	
	public function updateStatusAction() {
		
		$player = new MPlayer();
		$player->updateStatus();
		
		
		$this->smarty->assign("messages","Status wurde aktualisiert");
		
		return "functions";
	}

	public function clearGamesAction() {
		$game = new MGame();
		$game->clearGames();

		$this->smarty->assign("messages","Spiele wurden bereinigt!");

		return "functions";
	}

	public function changePasswordAction() {

		if(isset($_POST["changePassword"])) {

			$person = new MPerson();
			$person->changePassword($_POST["personID"], $_POST["password"]);

			$this->smarty->assign("messages","Passwort wurde ge&auml;ndert");

			
			return "functions";
		}
		$this->smarty->assign("subContent1", "administration/changePassword.tpl");

		$persons = new MPerson();
		$rs = $persons->getRS("","name ASC, prename ASC");
		$this->smarty->assign("users", $rs->getArray());


	}
	
	public function gaclAction() {
		$this->smarty->assign("subContent1", "administration/gacl.tpl");
	}
	
	public function notificationsAction() {
		$this->smarty->assign("subContent1", "administration/subscriptionTable.tpl");
		$notification = new MNotification();
		$rs = $notification->getAllSubscriptions();
		$this->smarty->assign("subscriptions", $rs->getArray());
		
		$rs = $notification->getAllNotifications();
		$this->smarty->assign("allnotifications", $rs->getArray());
		
	}
	
	public function deleteNoteAction(){
		
		$notificationID = $_GET["notificationID"];
		
		$notification = new MNotification();
		$notification->delete(array("id" => $notificationID));
		
		return "notifications";
	}
	
	public function deleteNoteSubscriptionAction() {
		$personID = $_GET["personID"];
		$typeID = $_GET["typeID"];
		
		$notification = new MNotification();
		$notification->deleteSubscribtion($typeID, $personID);
		
		return "notifications";
	}
	
	public function addNoteSubscriptionAction() {
		
		if (isset($_POST["doAdd"])) {
			$personID = $_POST["personID"];
			$typeID = $_POST["typeID"];
			$email = $_POST["email"];
			
			if ($email == "") $email = 0;
			
			$notification = new MNotification();
			$notification->addSubscription($typeID, $personID, $email);
			
			return "notifications";
		}
		$this->smarty->assign("subContent1", "administration/addSubsciption.tpl");
		
		$persons = new MPerson();
		$rs = $persons->getRS("active=1","name ASC, prename ASC");
		$this->smarty->assign("users", $rs->getArray());
		
		$notification = new MNotification();
		$rs = $notification->getAllNotificationTypes();
		$this->smarty->assign("types", $rs->getArray());
		
		
	}
}

?>
