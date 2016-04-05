<?
MyModel::loadModel("person");
MyModel::loadModel("licence");
MyModel::loadModel("notification");

class PPersondata extends MyPlugin {


	private $formURL;
	

	public function __toString() {
		$this->smarty->assign("formURL", $this->formURL);
		return MyPlugin::__toString();
	}

	public function run($action) {


		$return = "";

		switch($action) {
			case "newEntry":
				$this->contentFile = "plugins/persondata/new.tpl";
				$return = $this->newEntry();
			break;
			case "editEntry":
				$this->contentFile = "plugins/persondata/edit.tpl";
				$return = $this->editEntry();
	
			break;
		}

		return $return;
	}


	public function setFormURL($formURL) {
		$this->formURL = $formURL;
	}

	private function newEntry() {
		if (isset($_POST["doNew"])) {
			
			$person = new MPerson();
			$person->name = $_POST["name"];
			$person->prename = $_POST["prename"];
			$person->ort = $_POST["ort"];
			$person->plz = $_POST["plz"];
			$person->address = $_POST["address"];
			$person->phone = $_POST["phone"];
			$person->mobile = $_POST["mobile"];
			$person->email = $_POST["email"];
			$person->email_parent = $_POST["email_parent"];
			$person->birthday = 
					$_POST["birthdayYear"] ."-" . 
					$_POST["birthdayMonth"] . "-" . 
					$_POST["birthdayDay"];
			$person->gender = $_POST["gender"];
			$person->signature = $_POST["signature"];
			if ($person->signature == NULL) $person->signature = 0;
			$person->schreiber = $_POST["schreiber"];
			if ($person->schreiber == NULL) $person->schreiber = 0;
			$person->sms = $_POST["sms"];
            if ($person->sms == NULL) $person->sms = 0;
			$person->licence = $_POST["licence"];
			$person->licence_comment = $_POST["licence_comment"];
			$person->refid = $_POST["refid"];
			
			$person->insert();
			
			$this->smarty->assign("messages","Neue Person wurde eingetragen");
			
			return "main";
		}
		
		$licences = new MLicence();
		$rs = $licences->getLicenceList();
		$this->smarty->assign("licences", $rs->getArray());
	}


	private function editEntry() {
		
		if (isset($_POST["doEdit"])) {
			$person = new MPerson();
			$person->name = $_POST["name"];
			$person->prename = $_POST["prename"];
			$person->ort = $_POST["ort"];
			$person->plz = $_POST["plz"];
			$person->address = $_POST["address"];
			$person->phone = $_POST["phone"];
			$person->mobile = $_POST["mobile"];
			$person->email = $_POST["email"];
			$person->email_parent = $_POST["email_parent"];
			$person->birthday = 
					$_POST["birthdayYear"] ."-" . 
					$_POST["birthdayMonth"] . "-" . 
					$_POST["birthdayDay"];
			$person->gender = $_POST["gender"];
			$person->schreiber = $_POST["schreiber"];
			if ($person->schreiber == NULL) $person->schreiber = 0;
			$person->signature = $_POST["signature"];
			if ($person->signature == NULL) $person->signature = 0;
			$person->sms = $_POST["sms"];
			$person->licence = $_POST["licence"];
			$person->licence_comment = $_POST["licence_comment"];
			$person->refid = $_POST["refid"];
			
			$person->update("id=" . $this->db->qstr($this->data["personID"]), $this->db->qstr($this->data["personID"]));
			
			$this->smarty->assign("messages","Die Daten wurden bearbeitet!");

			unset($_POST["doEdit"]);
			
			return "main";
		}
		
		$person = new MPerson();
		$rs = $person->getAddressEntry("persons.id = " . $this->db->qstr($this->data["personID"])); 
		$this->smarty->assign("person", $rs->getArray());
		
		$licences = new MLicence();
		$rs = $licences->getLicenceList();
		$this->smarty->assign("licences", $rs->getArray());
	}
}
