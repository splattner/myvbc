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
		
		//Register XAJAX Functions
		$this->xajax->register(XAJAX_FUNCTION, array("getAddressEntrys", $this, "getAddressEntrys"));
		
		$this->customerJavaScript .= "
			<script type=\"text/javascript\">
				function getAddressEntrys(char) {
					xajax_getAddressEntrys(char);
				}
			</script>
		";
		
	}
	
	public function cleanup() {
		parent::cleanup();
		$this->session->share["onlyChar"] = "";
	}
	
	public function getAddressEntrys($onlyChar = "") {
		$this->smarty->assign("content", "address/addressEntrys.tpl");
		$this->session->share["onlyChar"] = $onlyChar;
		
		$person = new MPerson();
		
		if($onlyChar == "") { $rs = $person->getAddressEntry("","persons.active DESC, persons.name ASC, persons.prename ASC");} 
		else { $rs = $person->getAddressEntry("persons.name LIKE '" . $onlyChar . "%'","persons.active DESC, persons.name ASC, persons.prename ASC");}
		
		$persons = $rs->GetArray();
		$this->smarty->assign("persons", $persons);
		
		$objResponse = new xajaxResponse();
		$objResponse->assign("addressEntrys", "innerHTML", $this->render());
		
		return $objResponse;
	}
	
	public function mainAction() {
		$this->smarty->assign("subContent1", "address/addressTable.tpl");
		
		$this->loaderJavaScript = "
			<script type=\"text/javascript\">
				getAddressEntrys('" . $this->session->share["onlyChar"] . "');
			</script>
		";
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
		
		$this->smarty->assign("messages","Person wurde aus Datenbank gelöscht!");
		
		return "main";
	}
	
	public function importAction() {
		
	}
}

?>
