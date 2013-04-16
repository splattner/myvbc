<?php
MyModel::loadModel("game");
MyModel::loadModel("team");
MyModel::loadModel("schreiber");
MyModel::loadModel("person");

require_once("libs/framework/dataSources/svrs.datasource.php");
require_once("libs/framework/dataSources/swissvolley.datasource.php");

class PageGames extends MyPage
{
	
	public function __construct() {
		parent::__construct();
		$this->pagename = "games";
		$this->template = "games/games.tpl";
	}
	
	public function init() {
		parent::init();
		$this->smarty->assign("content", $this->template);
		
		$this->xajax->register(XAJAX_FUNCTION, array("getGames", $this, "getGames"));
		$this->xajax->register(XAJAX_FUNCTION, array("getSchreiberList", $this, "getSchreiberList"));
		$this->xajax->register(XAJAX_FUNCTION, array("addSchreiber", $this, "addSchreiber"));
		$this->xajax->register(XAJAX_FUNCTION, array("removeSchreiber", $this, "removeSchreiber"));
		$this->xajax->register(XAJAX_FUNCTION, array("getGamesToImport", $this, "getGamesToImport"));
		$this->xajax->register(XAJAX_FUNCTION, array("importGames", $this, "importGames"));
		$this->xajax->register(XAJAX_FUNCTION, array("getSchreiberInfo", $this, "getSchreiberInfo"));
		
		
		
		$this->customerJavaScript  .= "
			<script type=\"text/javascript\">
				function getGames(teamID) {
					xajax_getGames(teamID);
				}
				
				function getSchreiberList(gameID, teamID) {
					xajax_getSchreiberList(gameID, teamID);
				}
				
				function addSchreiber(gameID, teamID) {
					var schreiberID = document.getElementById('personid').options[document.getElementById('personid').selectedIndex].value;
					xajax_addSchreiber(schreiberID, gameID, teamID);
				}
				
				function removeSchreiber(schreiberID, gameID, teamID) {
					xajax_removeSchreiber(schreiberID, gameID, teamID);
				}
				
				function getGamesToImport(teamID) {
					xajax_getGamesToImport(teamID);
				}
				
				function importGames() {
					xajax_importGames();
				}
				
				function getSchreiberInfo(personID, gameID) {
					xajax_getSchreiberInfo(personID, gameID);
				}
			</script>
		";
	}
	
	public function cleanup() {
		parent::cleanup();
		$this->session->share["teamID"] = "0";
	}

	public function mainAction() {
		$this->smarty->assign("subContent1", "games/gamesTable.tpl");
	

		$team = new MTeam();
		$rs = $team->getRS("","name");
		$this->smarty->assign("teams", $rs->getArray());
		
	
		$this->loaderJavaScript .= "
			<script type=\"text/javascript\">
				getGames(" . $this->session->share["teamID"] . ")
			</script>
		";
		
		$this->smarty->assign("loaderJavaScript", $loaderJavaScript);
		
		
	}
	
	public function getSchreiberInfo($personID, $gameID) {
		$this->smarty->assign("content", "games/schreiberInfo.tpl");
		
		$game = new MGame();
		$rs_currentGame = $game->getRS("id=" . $this->db->qstr($gameID));
		$currentGame = $rs_currentGame->getArray();
		
		//the number of events this person already has
		$person = new MPerson();
		$rs_schreiber = $person->getMySchreibers($personID);
		$schreiber = $rs_schreiber->getArray();
		$this->smarty->assign("countSchreiber", count($schreiber));
		
		//Get Games on the Same day!
		list($datum, $zeit) = explode(" ", $currentGame[0]["date"]);
		$rs_games = $game->getGamesFromPersonOnDate($personID, $datum);
		$games = $rs_games->getArray();
		$this->smarty->assign("games", $games);
		
		
		$objResponse = new xajaxResponse();
		$objResponse->assign("schreiberinfo", "innerHTML", $this->render());
		return $objResponse;
	}
	
	public function getGames($teamID) {		
		$this->smarty->assign("content", "games/gameEntrys.tpl");
		$this->session->share["teamID"] = $teamID;
		
		$sql = "SELECT 
					games.id AS id,
					games.date AS date,
					teams.name AS name,
					games.gegner AS gegner,
					games.ort AS ort,
					games.halle AS halle,
					games.heimspiel AS heimspiel
				FROM 
					games 
				LEFT JOIN teams ON games.team = teams.id";
		
		if($this->session->share["teamID"] != 0) {
			$sql .= " WHERE
					games.team = " . $this->session->share["teamID"];
		}
		$sql .= " ORDER BY games.date";
		$rs = $this->db->Execute($sql);
		
		$games = $rs->getArray();
		
		$schreiber = new MGame();
		
		for ($i = 0 ; $i < count($games); $i++) {

			if($games[$i]["heimspiel"] == 1) {
				$currentSchreiber = $schreiber->getSchreiber($games[$i]["id"]);
				$arraySchreiber = $currentSchreiber->getArray();
				$games[$i]["schreiber"] = $arraySchreiber;
			} else { $games[$i]["schreiber"] = ""; }
		}

		$this->smarty->assign("games", $games);
		

		$objResponse = new xajaxResponse();
		$objResponse->assign("gameEntrys", "innerHTML", $this->render());
		
		return $objResponse;
	}
	
	public function importAction() {
		$this->smarty->assign("subContent1", "games/import.tpl");
		
		$this->loaderJavaScript .= "
			<script type=\"text/javascript\">
				getGamesToImport(" . $this->session->share["teamID"] . ")
			</script>
		";
		
		$team = new MTeam();
		$rs = $team->getRS("","name");
		$this->smarty->assign("teams", $rs->getArray());

			
	}
	
	public function getGamesFromSource($teamID) {
		
		$games = array();
		
		if ($teamID > 0) {
			$team = new MTeam();
			$rs = $team->getRS("id=" . $this->db->qstr($teamID));
			$teamData = $rs->getArray();
			
			switch($teamData[0]["typ"]) {
				case "1":
					//Swissvolley
					$source = new SourceSwissvolley();
					break;
					
				case "2":
					//SVRS
					$source = new SourceSVRS();			
					break;
			}
			
			$games = $source->getGamesbyTeamID($teamData[0]["extid"]);
			
			for ($i = 0 ; $i < count($games); $i++) {
				
				$localGame = new MGame();
				$rs = $localGame->getRS("extid= " . $games[$i]["extid"]);
				$localGames = $rs->getArray();
				if (count($localGames) >= 1) {
					if($games[$i]["datum"] != $localGames[0]["date"] || $games[$i]["ort"] != $localGames[0]["ort"] || $games[$i]["halle"] != $localGames[0]["halle"]){
						$games[$i]["local"] = 2;
					} else {
						$games[$i]["local"] = 1;
					}
				} else {
					$games[$i]["local"] = 0;
				}
			}
		}
		
		return $games;
	}
	
	public function getGamesToImport($teamID) {
		$this->smarty->assign("content", "games/importEntrys.tpl");
		$this->session->share["teamID"] = $teamID;

		$this->smarty->assign("games", $this->getGamesFromSource($teamID));
		
		$objResponse = new xajaxResponse();
		$objResponse->assign("importEntrys", "innerHTML", $this->render());
		return $objResponse;
	}
	
	public function importGames() {
	
		$games = $this->getGamesFromSource($this->session->share["teamID"]);
		
		$team = new MTeam();
		$rs = $team->getRS("id=" . $this->session->share["teamID"]);
		$team = $rs->getArray();
		
		foreach ($games as $game) {
			
			$localgame = new MGame();
			
			$localgame->extid = $game["extid"];
			$localgame->date = $game["datum"];
			$localgame->ort = $game["ort"];
			$localgame->halle = $game["halle"];
			$localgame->team = $this->session->share["teamID"];
			
			
			if ($game["heimteam"] == $team[0]["extname"]) {
				$localgame->heimspiel = 1;
				$localgame->gegner = $game["gastteam"];
			} else {
				$localgame->heimspiel = 0;
				$localgame->gegner = $game["heimteam"];
			}
			
			if ($game["local"] == 1 || $game["local"] == 2) {
				$localgame->update("extid=" . $game["extid"]);
			} else {
				$localgame->insert();
			}
			
		}
		return $this->getGamesToImport($this->session->share["teamID"]);
	}
	
	public function deleteAction() {
		$gameID = $this->db->qstr($_GET["gameID"]);
		
		$game = new MGame();
		$game->delete("id=" . $gameID);
		
		return "main";
	}
	
	public function editAction() {
		$this->smarty->assign("subContent1", "games/edit.tpl");
		
		$gameID = $this->db->qstr($_GET["gameID"]);
		$teamID = $this->session->share["teamID"];
		
		if (isset($_POST["doEdit"])) {
			$game = new MGame();
			$game->extid = $_POST["extid"];
			$game->date = 
					$_POST["dateYear"] ."-" . 
					$_POST["dateMonth"] . "-" . 
					$_POST["dateDay"] . " " . 
					$_POST["timeHour"] . ":" .
					$_POST["timeMinute"] .":" . "00";
			$game->gegner = $_POST["gegner"];
			$game->ort = $_POST["ort"];
			$game->halle = $_POST["halle"];
			$game->heimspiel = $_POST["heimspiel"];

			$game->update("id=" . $gameID);
			
			return "main";
		}
	
		$game = new MGame();
		$rs = $game->getRS("id=" . $gameID);
		$this->smarty->assign("games", $rs->getArray());		
	}
	
	public function editSchreiberAction() {
		$this->smarty->assign("subContent1", "games/editSchreiber.tpl");
				
		$gameID = $_GET["gameID"];
		
		// Get Game Details
		$sql_game = "SELECT 
						games.date as datum, 
						teams.name as teamname,
						games.gegner as gegner,
						games.id as id,
						games.ort as ort,
						games.halle as halle
					FROM 
						games 
					LEFT JOIN 
						teams ON teams.id = games.team 
					WHERE 
						games.id = " . $this->db->qstr($gameID);
		$rs = $this->db->Execute($sql_game);
		$this->smarty->assign("game", $rs->getArray());
		
		$this->loaderJavaScript .= "
			<script type=\"text/javascript\">
				getSchreiberList(" . $gameID . "," . $this->session->share["teamID"] . ")
			</script>
		";
		
		$mschreiber = new MSchreiber();
		$rs_proposals = $mschreiber->getSchreiberProposal($gameID);
		$proposals = $rs_proposals->getArray();
		//print_r($proposals);
		$this->smarty->assign("proposals", $proposals);

	}
	
	public function addSchreiber($schreiberID, $gameID, $teamID) {	
		$schreiber = new MSchreiber();
		$schreiber->addSchreiber($schreiberID, $gameID);
		
		return $this->getSchreiberList($gameID,$teamID);
	}
	
	public function removeSchreiber($schreiberID, $gameID, $teamID)
	{
		$schreiber = new MSchreiber();
		$schreiber->removeSchreiber($schreiberID, $gameID);
		
		return $this->getSchreiberList($gameID,$teamID);
	}
	
	public function getSchreiberList($gameID, $teamID) {
		$this->smarty->assign("content", "games/schreiberList.tpl");
		$this->smarty->assign("gameID", $gameID);
		$this->smarty->assign("teamID", $teamID);
			
		$game = new MGame();
		$rs = $game->getSchreiber($gameID);
		$this->smarty->assign("schreibers", $rs->getArray());

		$validSchreiber = $game->getValidSchreiber($gameID);
		$this->smarty->assign("all_schreibers", $validSchreiber);
		
		
		$objResponse = new xajaxResponse();
		$objResponse->assign("schreiberlist", "innerHTML", $this->render());
		return $objResponse;
	}
}

?>
