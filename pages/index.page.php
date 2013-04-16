<?php
MyModel::loadModel("person");

require_once("libs/framework/dataSources/svrs.datasource.php");

class PageIndex extends MyPage
{
	
	public function __construct() {
		parent::__construct();
		$this->pagename = "index";
		$this->template = "index/index.tpl";
	}
	
	public function init() {
		parent::init();
		$this->smarty->assign("content", $this->template);
	}

	
	public function mainAction() {
		if ($this->session->isAuth) {
			
			$user = new MPerson();
			$rs = $user->getRS("id=" . $this->session->uid);
			$currentUser = $rs->getArray();

			$this->smarty->assign("user", $currentUser[0]);
			
			/*
			 * Check if RefID is available
			 */
			if($currentUser[0]["refid"] > 0) {
				$source = new SourceSVRS();	
				
				$refGames = $source->getGamesbyRef($currentUser[0]["refid"]);
				$this->smarty->assign("refGames", $refGames);	
				$this->smarty->assign("refID", $currentUser[0]["refid"]);
			}
			
			/*
			 * Get myGames
			 */
			$currentGames = $user->getMyGames($this->session->uid);
			$myGames = array();
			while ($currentGame = $currentGames->FetchRow()) {
            	$myGames[] = $currentGame;
			}
			$this->smarty->assign("myGames", $myGames);
			
			/*
			 * Get myTeams
			 */
			$currentTeams = $user->getMyTeams($this->session->uid);
			$myTeams = array();
			while ($currentTeam = $currentTeams->FetchRow()) {
            	$myTeams[] = $currentTeam;
			}
			$this->smarty->assign("myTeams", $myTeams);
			
			/*
			 * Get mySchreiber
			 */
			$currentSchreibers= $user->getMySchreibers($this->session->uid);
			$mySchreibers = array();
			while ($currentSchreiber = $currentSchreibers->FetchRow()) {
            	$mySchreibers[] = $currentSchreiber;
			}
			$this->smarty->assign("mySchreibers", $mySchreibers);
		
		}
	}
}

?>
