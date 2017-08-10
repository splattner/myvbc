<?php
namespace splattner\myvbc\pages;
use splattner\myvbc\plugins\PHistory;
use splattner\myvbc\plugins\PPersondata;
use splattner\myvbc\models\MPerson;

class PageMydata extends MyVBCPage
{
	
	public function __construct() {
		parent::__construct();
		$this->pagename = "myData";
		$this->template = "myData/myData.tpl";

		$this->acl->addResource("setSignature");

		$this->acl->allow("registered",["main", "edit","editPassword"], ["view"]);
		$this->acl->allow("vorstand",["setSignature"], ["view"]);
	}
	
	public function init() {
		parent::init();
		$this->smarty->assign("content", $this->template);
	}

	
	public function mainAction() {
		

	}
	
	public function editAction() {
		$this->smarty->assign("subContent1", "myData/edit.tpl");
		
		$data["personID"] = $this->session->uid;

		$plugin_personData = new PPersondata("persondata");
		$plugin_personData->setData($data);
		$plugin_personData->setFormURL("index.php?page={\$currentPage}&action=edit");
		$return = $plugin_personData->run("editEntry");
		
		// History Plugin
		$plugin_history = new PHistory("history");
		$plugin_history->setData($data);
		$plugin_history->run(NULL);


		if ($return == "main") return "edit";


	}
	
	public function editPasswordAction() {

		if (isset($_POST["doEdit"])){
			if ($_POST["password"] == $_POST["confirm"]) {
				if (strlen($_POST["password"]) >=8) {
					$person = new MPerson();
					$person->changePassword($this->session->uid, $_POST["password"]);
					$this->smarty->assign("messages","Ihr Passwort wurde ge&auml;ndert");
				} else {
					$this->smarty->assign("messages","Das Passwort muss min. 8 Zeichen haben");
				}
			} else {
				$this->smarty->assign("messages","Die beiden Passw&ouml;rter stimmen nicht &uuml;berein!");
			}
			
		}

	}
}

?>
