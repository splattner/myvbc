<?php


namespace splattner\myvbc\pages;

use splattner\myvbc\models\MPerson;
use splattner\myvbc\models\MReport;
use splattner\myvbc\models\MPlayer;
use splattner\myvbc\models\MGame;
use splattner\myvbc\models\MNotification;



class PageAdmin extends MyVBCPage
{
	
	public function __construct() {
		parent::__construct();
		$this->pagename = "admin";
		$this->template = "administration/administration.tpl";

		$this->acl->allow("administrator",["main", "access", "addAccess", "removeAccess", "report","editReport","addReport","deleteReport","functions","updateStatus","clearGames","changePassword","notifications","deleteNote","deleteNoteSubscription","addNoteSubscription"], ["view"]);
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
		
		$this->smarty->assign("members", $members->fetchAll());
		
	}
	
	public function addAccessAction() {
		$this->smarty->assign("subContent1", "administration/addAccess.tpl");
		
		if (isset($_POST["doAdd"])) {
			$personID = $_POST["person"];
			$group = $_POST["group"];
			
			$person = new MPerson();
			$person->createAccess($personID,$group);
			
			$this->smarty->assign("messages","Zugang f&uuml;r Person wurde eingerichtet");
			
			return "access";		
		}
		
		$persons = new MPerson();
		$rs = $persons->getRS(array(),array("name" => "DESC", "prename" => "ASC"));
		$this->smarty->assign("users", $rs->fetchAll());
		
		$groups = array("guest","manager","vorstand","administrator");
		$this->smarty->assign("groups", $groups);
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
		
		$this->smarty->assign("reports", $rs->fetchAll());
		
		
	}
	
	
	public function editReportAction() {
		$reportID = $this->db->qstr($_GET["reportID"]);
		
		if (isset($_POST["doEdit"])) {
			
			$sql ="UPDATE reports SET
				title = ?,
				query = ?
				WHERE id = ?";

			$sql = $this->pdo->Prepare($sql);
			$sql->Execute(array($_POST["title"],$_POST["query"], $reportID ));
			
			$this->smarty->assign("messages","Die Daten wurden bearbeitet!");
			
			return "report";
		}
		$this->smarty->assign("subContent1", "administration/editReport.tpl");
		
		$report = new MReport();
		$rs = $report->getRS(array($report->pk ." =" => $reportID));
		$this->smarty->assign("report", $rs->fetch());	
	}
	
	public function addReportAction() {
		if (isset($_POST["doNew"])) {
			
		
			$sql ="INSERT INTO reports (title, query) VALUES (?,?)";

            $sql = $this->pdo->Prepare($sql);
            $sql->Execute(array($_POST["title"],$_POST["query"] ));
			
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
		$rs = $persons->getRS(array(),array("name" => "ASC", "prename" => "ASC"), array("id","name","prename"));
		$this->smarty->assign("users", $rs->fetchAll());


	}
	
	
	public function notificationsAction() {
		$this->smarty->assign("subContent1", "administration/subscriptionTable.tpl");
		$notification = new MNotification();
		$rs = $notification->getAllSubscriptions();
		$this->smarty->assign("subscriptions", $rs->fetchAll());
				
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
		$rs = $persons->getRS(array("active =" => 1),array("name" => "DESC", "prename" => "ASC"));
		$this->smarty->assign("users", $rs->fetchAll());
		
		$notification = new MNotification();
		$rs = $notification->getAllNotificationTypes();
		$this->smarty->assign("types", $rs->fetchAll());
		
		
	}
}

?>
