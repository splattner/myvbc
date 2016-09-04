<?php
namespace splattner\myvbc\pages;
use splattner\framework\Page;
use splattner\framework\Model;


class PageGames extends MyVBCPage
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
