<?php
MyModel::loadModel("team");
MyModel::loadModel("player");
MyModel::loadModel("person");


class PageTeam extends MyPage
{
	
	public function __construct() {
		parent::__construct();
		$this->pagename = "team";
		$this->template = "team/team.tpl";
	}
	
	public function init() {
		parent::init();
		$this->smarty->assign("content", $this->template);
	}
	


	
	public function mainAction() {
		$this->smarty->assign("subContent1", "team/teamTable.tpl");
		
		$teams = new MTeam();
		$rs = $teams->getRS("","teams.name");

		$this->smarty->assign("teams", $rs->getArray());
	}
	
	public function editAction() {
		$this->smarty->assign("subContent1", "team/edit.tpl");
		
		$teamID = $this->db->qstr($_GET["teamID"]);
			
		if (isset($_POST["doEdit"])) {
			$team = new MTeam();
			$team->extid = $_POST["extid"];
			$team->name = $_POST["name"];
			$team->extname = $_POST["extname"];
			$team->liga = $_POST["liga"];
			$team->extliga = $_POST["extliga"];
			$team->typ = $_POST["typ"];

			$team->update("id=" . $teamID);
			
			return "main";
		}
		
		$team = new MTeam();
		$rs = $team->getRS("id=". $teamID);

		$this->smarty->assign("teams", $rs->getArray());
	}
	
	public function memberAction() {
		$this->smarty->assign("subContent1", "team/memberTable.tpl");
		
		$teamID = $_GET["teamID"];
		$this->smarty->assign("teamID", $teamID);
		
		$team = new MTeam();
		$rs = $team->getAllMember($teamID);
		$this->smarty->assign("persons", $rs->getArray());	
		
		$rs = $team->getRS("id=" . $this->db->qstr($teamID),"");
		$currentTeam = $rs->getArray();
		$teamName = $currentTeam[0]["name"];
		$this->smarty->assign("teamName", $teamName);
	}
	
	public function deleteMemberAction() {
		$teamID = $this->db->qstr($_GET["teamID"]);
		$personID = $this->db->qstr($_GET["personID"]);
		
		$player = new MPlayer();
		$player->person = $_GET["personID"];
		$player->team = $_GET["teamID"];
		$player->delete("team=" . $teamID . " AND person=" . $personID);
		
		// No Update after delete
		//$player->updateStatus();

		return "member";
	}
	
	public function addMemberAction() {
		$this->smarty->assign("subContent1", "team/addMember.tpl");
		
		$teamID = $_GET["teamID"];
		$this->smarty->assign("teamID", $teamID);
		
		
		if (isset($_POST["doAdd"])) {
			if ($_POST["person"] != 0) {
				$player = new MPlayer();
				$player->person = $_POST["person"];
				$player->team = $_GET["teamID"];
				$player->typ = $_POST["typ"];
	
				$player->insert();
				
				// No Update after adding to Team. This is done in model
				//$player->updateStatus();
				
				$this->smarty->assign("messages","Person wurde zu Team hinzugef&uuml;gt");
	
				return "member";
			} else {	
				$this->smarty->assign("messages","Achtung: Sie haben keine Perosn ausgew&auml;hlt!");
			}
		}
		
		$persons = new MPerson();
		$rs = $persons->getRS("","name ASC, prename ASC");
		$this->smarty->assign("users", $rs->getArray());
	}
	
	public function newAction() {
		$this->smarty->assign("subContent1", "team/new.tpl");
		
			
		if (isset($_POST["doNew"])) {
			$person = new MTeam($this->db);
			$person->extid = $_POST["extid"];
			$person->name = $_POST["name"];
			$person->extname = $_POST["extname"];
			$person->liga = $_POST["liga"];
			$person->extliga = $_POST["extliga"];
			$person->typ = $_POST["typ"];

			$person->insert();
			
			return "main";
		}
	}
	
	public function deleteAction() {
		$teamID = $_GET["teamID"];
		
		$team = new MTeam();
		$team->delete("id=" . $this->db->qstr($teamID));

		$player = new MPlayer();
                $player->updateStatus();
		
		return "main";
	}
}
?>
