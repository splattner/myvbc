<?php
MyModel::loadModel("person");
MyModel::loadModel("licence");

MyPlugin::loadPlugin("persondata");
MyPlugin::loadPlugin("history");


class PageAddress extends MyPage
{
	
	public function __construct() {
		parent::__construct();
		$this->pagename = "address";
		$this->template = "address/address.tpl";
		
		$this->noACL["import"] = true;
	}
	
	public function init() {
		parent::init();
		$this->smarty->assign("content", $this->template);

		
	}


	
	public function mainAction() {
		$this->smarty->assign("subContent1", "address/addressTable.tpl");

		$person = new MPerson();
		$rs = $person->getAddressEntry("","persons.active DESC, persons.name ASC, persons.prename ASC");
		$persons = $rs->GetArray();
		$this->smarty->assign("persons", $persons);


	}
	
	public function editAction() {
		$this->smarty->assign("subContent1", "address/edit.tpl");
		
		$data["personID"] = $_GET["personID"];
		$this->smarty->assign("personID", $data["personID"]);

		$plugin_personData = new PPersondata("persondata");
		$plugin_personData->setData($data);
		$plugin_personData->setFormURL("index.php?page={\$currentPage}&action=edit&personID={\$personID}");
		
		// History Plugin
		$plugin_history = new PHistory("history");
		$plugin_history->setData($data);
		$plugin_history->run(NULL);
		

		return $plugin_personData->run("editEntry");
	}
	
	public function newAction() {
		$this->smarty->assign("subContent1", "address/new.tpl");

		$plugin_personData = new PPersondata("persondata");
		$plugin_personData->setFormURL("index.php?page={\$currentPage}&action=new");

		return $plugin_personData->run("newEntry");
		
	}
	
	public function deleteAction() {
		
		$personID = $_GET["personID"];
		
		$person = new MPerson();
		$person->removeAccess($personID);
		$person->delete("id = " . $this->db->qstr($personID));
		
		$this->smarty->assign("messages","Person wurde aus Datenbank gel&ouml;scht!");
		
		return "main";
	}
	
	
	public function setStateAction() {
		
		$personID = $_GET["personID"];
		$state = $_GET["state"];
		
		$person = new MPerson();
		$person->setState($personID, $state);
		
		return "main";
	
	}
	
	public function importAction() {
		
	}
}

?>
