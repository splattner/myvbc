<?php
MyModel::loadModel("person");
MyModel::loadModel("team");
MyModel::loadModel("player");
MyModel::loadModel("licence");


MyPlugin::loadPlugin("persondata");
MyPlugin::loadPlugin("history");



class PageMyteam extends MyPage
{
	
	public function __construct() {
		parent::__construct();
		$this->pagename = "myteam";
		$this->template = "myTeam/myTeam.tpl";
	}
	
	public function init() {
		parent::init();
		$this->smarty->assign("content", $this->template);
		$this->smarty->assign("canAddMember", $this->acl->acl_check($this->pagename, "addMember", "user", $this->session->uid));
		$this->smarty->assign("canDeleteMember", $this->acl->acl_check($this->pagename, "deleteMember", "user", $this->session->uid));
		$this->smarty->assign("canEditMember", $this->acl->acl_check($this->pagename, "edit", "user", $this->session->uid));
	}

	
	public function mainAction() {
		$this->smarty->assign("subContent1", "myTeam/teamMember.tpl");
		
		
		$teamID = $_GET["teamID"];
		$this->smarty->assign("teamID", $teamID);
		
		$team = new MTeam();
		$rs = $team->getAllMember($teamID);
				
		$this->smarty->assign("persons", $rs->getArray());
		
		$rs_team = $team->getRS("id=" . $this->db->qstr($teamID));
		$currentTeam = $rs_team->getArray();
		
		$this->smarty->assign("teamName", $currentTeam[0]["name"]);
	}
	
	public function addMemberAction() {
		$this->smarty->assign("subContent1", "myTeam/addMember.tpl");
		
		$teamID = $_GET["teamID"];
		$this->smarty->assign("teamID",$teamID);
				
		
		if (isset($_POST["doAdd"])) {
			if ($_POST["person"] != 0) {
				$player = new MPlayer();
				$player->person = $_POST["person"];
				$player->team = $teamID;
				$player->typ = $_POST["typ"];
	
				$player->insert();
				$this->smarty->assign("messages","Person wurde zu Team hinzugef&uuml;gt");
				
				// No Update after adding to Team. This is done in model
				//$player->updateStatus();
				
	
				return "main";
			} else {
				$this->smarty->assign("messages","Achtung: Sie haben keine Perosn ausgew&auml;hlt!");
			}
		}
		
		$persons = new MPerson();
		$rs = $persons->getRS("","name ASC, prename ASC");
		$this->smarty->assign("users", $rs->getArray());
	}
	
	public function deleteMemberAction() {
		$teamID = $this->db->qstr($_GET["teamID"]);
		$personID = $this->db->qstr($_GET["personID"]);
		
		$player = new MPlayer();
		$player->team = $_GET["teamID"];
		$player->person = $_GET["personID"];
		$player->delete("team=" . $teamID . " AND person=" . $personID);
		
		$this->smarty->assign("messages","Person wurde aus Team entfernt");
		
		// No Update after delete
		//$player->updateStatus();

		return "main";
	}
	
	public function editAction() {

		$teamID = $_GET["teamID"];
		$this->smarty->assign("teamID", $teamID);
	
		$data["personID"] = $_GET["personID"];
		$this->smarty->assign("personID", $data["personID"]);

		$return = "";

		$plugin_personData = new PPersondata("persondata");
		$plugin_personData->setData($data);
		$plugin_personData->setFormURL("index.php?page={\$currentPage}&action=edit&teamID={\$teamID}&personID={\$personID}");
		$return = $plugin_personData->run("editEntry");
		
		// History Plugin
		$plugin_history = new PHistory("history");
		$plugin_history->setData($data);
		$plugin_history->run(NULL);
		
		$this->smarty->assign("subContent1", "myTeam/edit.tpl");
		
		return $return;
	}
	
	public function newAction() {
		$teamID = $_GET["teamID"];
		$this->smarty->assign("teamID", $teamID);

		$return = "";

		$plugin_personData = new PPersondata("persondata");
		$plugin_personData->setFormURL("index.php?page={\$currentPage}&action=new&teamID={\$teamID}");
		$return =  $plugin_personData->run("newEntry");
		
		$this->smarty->assign("subContent1", "myTeam/new.tpl");

		return $return;
	}

	public function requestFormAction() {

		$this->smarty->assign("subContent1", "myTeam/requestForm.tpl");


		$personID = $_GET["personID"];

		$user = new MPerson();
		$rs = $user->getRS("id=" . $personID);
		$this->smarty->assign("person", $rs->getArray());

	}
		

}

?>
