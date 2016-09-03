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

    }

	public function mainAction() {
		$this->smarty->assign("subContent1", "games/gamesTable.tpl");
	}


	public function importAction() {
		$this->smarty->assign("subContent1", "games/import.tpl");
	}

	
	public function editSchreiberAction() {
		$this->smarty->assign("subContent1", "games/editSchreiber.tpl");
				
		$gameID = $_GET["gameID"];
		$this->smarty->assign("gameID", $gameID);

	}


}

?>
