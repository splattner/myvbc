<?php

MyModel::loadModel("notification");
MyModel::loadModel("person");
MyModel::loadModel("licence");
MyModel::loadModel("team");

class MyNotification {
	
	/**
	 * Manage the db connection
	 * @access private
	 * @var mixed
	 */
	private $db;
	
	/**
	 * The Session object to manage all Session related stuff
	 * @access public
	 * @var mixed
	 */
	private $session;
	
	public function __construct() {
		$this->db = MyApplication::getInstance("db");
		$this->session = MyApplication::getInstance("session");
	}
	
	
	public function addNewNotification($type, $message, $objectID) {
		
		$notification = new MNotification();
		$notification->newNotification($type, $message, $objectID, $this->session->uid);
	}
	
	public function addChangeAddressNotification($personOld, $personNew) {
		
		$personOld = $personOld[0];
		$personNew = $personNew[0];
		
		$changedStatus = false;
		$message = "";
		
		$message .="<p> alt / neu (fett geschrieben bei &Auml;nderung)</p>";
		$message .= "<ul>";
		
		if($personOld["prename"] != $personNew["prename"]) {
			$changedStatus = true;
			$message .= "<li>Vorname : " . $personOld["prename"] . " / <b>" . $personNew["prename"] . "</b></li>";
		} else { 
			$message .= "<li>Vorname : " . $personOld["prename"] . " / " . $personNew["prename"] . "</li>";
		}
		
		if($personOld["name"] != $personNew["name"]) {
			$changedStatus = true;
			$message .= "<li>Name : " . $personOld["name"] . " / <b>" . $personNew["name"] . "</b></li>";
		} else { 
			$message .= "<li>Name : " . $personOld["name"] . " / " . $personNew["name"] . "</li>";
		}
		
		if($personOld["ort"] != $personNew["ort"]) {
			$changedStatus = true;
			$message .= "<li>Ort : " . $personOld["ort"] . " / <b>" . $personNew["ort"] . "</b></li>";
		}
		
		if($personOld["plz"] != $personNew["plz"]) {
			$changedStatus = true;
			$message .= "<li>PLZ : " . $personOld["plz"] . " / <b>" . $personNew["plz"] . "</b></li>";
		}
		
		if($personOld["address"] != $personNew["address"]) {
			$changedStatus = true;
			$message .= "<li>Adresse : " . $personOld["address"] . " / <b>" . $personNew["address"] . "</b></li>";
		}
		
		if($personOld["phone"] != $personNew["phone"]) {
			$changedStatus = true;
			$message .= "<li>Telefon : " . $personOld["phone"] . " / <b>" . $personNew["phone"] . "</b></li>";
		}
		
		if($personOld["mobile"] != $personNew["mobile"]) {
			$changedStatus = true;
			$message .= "<li>Mobile : " . $personOld["mobile"] . " / <b>" . $personNew["mobile"] . "</b></li>";
		}
		
		if($personOld["email"] != $personNew["email"]) {
			$changedStatus = true;
			$message .= "<li>E-Mail : " . $personOld["email"] . " / <b>" . $personNew["email"] . "</b></li>";
		}

		if($personOld["email-parent"] != $personNew["email-parent"]) {
			$changedStatus = true;
			$message .= "<li>E-Mail Eltern / Vormund: " . $personOld["email-parent"] . " / <b>" . $personNew["email-parent"] . "</b></li>";
		}

		if($personOld["comment_licence"] != $personNew["comment_licence"]) {
			$changedStatus = true;
			$message .= "<li>Bemerkung zu Lizenz : " . $personOld["comment_licence"] . " / <b>" . $personNew["comment_licence"] . "</b></li>";
		}

	 	if($personOld["schreiber"] != $personNew["schreiber"]) {
                        $changedStatus = true;
                        $message .= "<li>Schreiber: ";
                        if($personNew["schreiber"] == 0) {
                                $message .= "<b>Nein</b>";
                        } else {
                                $message .= "<b>Ja</b>";
                        }

                        $message .= "</li>";
                }

		if($personOld["signature"] != $personNew["signature"]) {
			$changedStatus = true;
			$message .= "<li>Vereintbeitritt unterzeichnet: ";
			if($personNew["signature"] == 0) {
				$message .= "<b>Nein</b>";
			} else {
				$message .= "<b>Ja</b>";
			}

			$message .= "</li>";
		}

		$message .= "</ul>";

		if($changedStatus) { 
			$person = new MPerson();
			$person->setChanged($personNew["id"], 1);
			$this->addNewNotification(1,$message, $personNew["id"]);
		}
		
	}
	
	public function addNewAdressNotifcation($personID) {
		
		$message ="";
				
		$person = new MPerson();
		$rs = $person->getRS("id=".$personID);
		$personNew = $rs->getArray();
		$personNew = $personNew[0];
		
		$message .= "<p>" . $personNew["prename"] . " " . $personNew["name"] . " wurde neu Eingetragen</p>";

		$message .= "<ul>";
		

		$message .= "<li>Vorname : " . $personNew["prename"] . "</li>";
		$message .= "<li>Name : " . $personNew["name"] . "</li>";
		$message .= "<li>Ort : " . $personNew["ort"] . "</li>";
		$message .= "<li>PLZ : " . $personNew["plz"] . "</li>";
		$message .= "<li>Adresse : " . $personNew["address"] . "</li>";
		$message .= "<li>Telefon : " . $personNew["phone"] . "</li>";
		$message .= "<li>Mobile : " . $personNew["mobile"] . "</li>";
		$message .= "<li>E-Mail : " . $personNew["email"] . "</li>";
		$message .= "<li>E-Mail Eltern / Vormund : " . $personNew["email-parent"] . "</li>";
		$message .= "<li>Bemerkung zu Lizenz : " . $personNew["comment_licence"] . "</li>";

		$message .= "<li>Schreiber: ";
		if($personNew["schreiber"] == 0) {
			$message .= "<b>Nein</b>";
		} else {
			$message .= "<b>Ja</b>";
		}

		$message .= "<li>Vereintbeitritt unterzeichnet: ";
		if($personNew["signature"] == 0) {
			$message .= "<b>Nein</b>";
		} else {
			$message .= "<b>Ja</b>";
		}
	
		$message .= "</li>";
		$message .= "</ul>";

		$this->addNewNotification(1,$message, $personID);
	}
	
	public function addNewLicenceNotification($personID) {
		
		$message ="";
		
		$person = new MPerson();
		$rs = $person->getRS("id=".$personID);
		$personNew = $rs->getArray();
		$personNew = $personNew[0];
		
		$licence = new MLicence();
		$rs = $licence->getRS("id=" . $personNew["licence"]);
		$licenceData = $rs->getArray();
		$licenceData = 	$licenceData[0];
		
		$message .= "<p>Lizenzbestellung abgeschlossen. " . $personNew["prename"] . " " . $personNew["name"] . " hat neu die Lizenz:<br/><b> " . $licenceData["typ"] ."</b></p>";
		
		$this->addNewNotification(3,$message, $personID);
	}

	public function addNewAccessNotification($personID) {

		$message = "";

                $person = new MPerson();
                $rs = $person->getRS("id=".$personID);
                $personNew = $rs->getArray();
                $personNew = $personNew[0];

                $message .= "<p>F&uuml;r <b>" . $personNew["prename"] . " " . $personNew["name"] . "</b> wurde ein Zugang erstellt!";

                $this->addNewNotification(4,$message, 0);
	}
	
	public function addNewOrderNotification() {

    	$message .= "<p>Es wurde eine neue Lizenzbestellung auf Status \"Bestellung ausgel&ouml;st\" gesetzt</p>";
		$this->addNewNotification(5,$message, 0);
	}
	
	

	public function addNewTeamMemberNotification($personID, $teamID) {


		$message = "";

		$person = new MPerson();
		$rs = $person->getRS("id=".$personID);
		
		$personData = $rs->getArray();
		$personData = $personData[0];

		
		$team = new MTeam();
		$rs = $team->getRS("id=".$teamID);

		$teamData = $rs->getArray();
		$teamData = $teamData[0];

		$message = "<p>" . $personData["prename"] . " " . $personData["name"] . " wurde dem Team " . $teamData["name"] . " hinzugef&uuml;gt!</p>";


		$this->addNewNotification(2,$message, $personID);
	}

	public function addRemoveTeamMemberNofitication($personID, $teamID) {

		  $message = "";

                $person = new MPerson();
                $rs = $person->getRS("id=".$personID);

                $personData = $rs->getArray();
                $personData = $personData[0];


                $team = new MTeam();
                $rs = $team->getRS("id=".$teamID);

                $teamData = $rs->getArray(); 
                $teamData = $teamData[0];

                $message = "<p>" . $personData["prename"]	. " " .	$personData["name"] . "	wurde aus dem  Team " . $teamData["name"] . " entfernt!</p>";




		$this->addNewNotification(2,$message, $personID);
	}

}

?>
