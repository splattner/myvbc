<?php

namespace splattner\myvbc\pages;
use splattner\framework\Application;


class PageAuth extends MyVBCPage
{
	
	public function __construct() {
		parent::__construct();
		$this->pagename = "auth";
		$this->template = "auth/auth.tpl";
	}
	
	public function init() {
		parent::init();
		$this->smarty->assign("content", $this->template);
	}
	
	
	public function mainAction() {
	
	}
	
	public function loginAction() {
		if(isset($_POST["doLogin"])) {
			$email = $_POST["email"];
			$password = $_POST["password"];
			
			if($this->session->auth($email, $password)) {
				$this->setTemplate("auth/success.tpl");
				$notification = Application::getService("ServiceNotification");
                $notification->addNewNotification(4, "Login", 0);
			} else {
				$this->setTemplate("auth/error.tpl");
			}
			$this->init();
		}
	}
	
	public function logoutAction() {
		if(isset($_POST["doLogout"])) {
			$this->session->closeMySession();
		}
		$this->init();
	}
	
	public function createAccessAction() {
		
		$personID = $_POST["personID"];
		
		if (isset($_POST["doAdd"])) {
			$person = new MPerson();
			
			$rs = $person->getRS(array($person->pk ." =" => $personID));
			$currentPerson = $rs->getArray();
			$currentPerson = $currentPerson[0];
			
			$password = Helper::generatePW(8);
			
			$content = "Zugangsdaten für myVBC\nE-Mail Adresse: " . $currentPerson["email"] . "\nPasswort: " . $password;
			
			if($currentPerson["mobile"] != "") {
                Helper::sendSMS("myVBC",$currentPerson["mobile"], $content);
							
				$this->smarty->assign("messages","Ihr Zugang wurde erstellt und das Passwort wurde Ihnen zugesandt");	
			} else {
				$mail = new PHPMailer();
				
				$mail->IsSMTP();

				$mail->Host       = "localhost"; // sets the SMTP server
				$mail->Port       = 25;                    // set the SMTP port for the GMAIL server

				
				$mail->SetFrom("myVBC@vbclangenthal.ch", "myVBC");
				$mail->AddAddress($currentPerson["email"],$currentPerson["prename"] . " " . $currentPerson["name"]);
				$mail->Subject = "[myVBC] Zugangsdaten";
				$mail->IsHTML(false);
				$mail->Body = $content;
				$mail->Send();
				
				$this->smarty->assign("messages","Ihr Zugang wurde erstellt und das Passwort wurde Ihnen zugesandt");
				
			} 
			
			$person->changePassword($personID, $password);
			$person->createAccess($personID);

			$notification =  Application::getService("ServiceNotification");
			$notification->addNewAccessNotification($personID);
				
			return "main";
			
		}
		
		if(isset($_GET["step2"])) {
			$this->setTemplate("auth/createAccess.tpl");
			
			$person = new MPerson();
			$rs = $person->getRS(array($person->pk ." =" => $personID));
			$this->smarty->assign("persons", $rs->getArray());
			
		} else {
			$this->setTemplate("auth/choosePerson.tpl");
			$persons = new MPerson();
			$rs = $persons->getRS(array("password IS" => "NULL", "active =" => "1"),array("name" => "ASC", "prename" =>  "ASC"));
			$this->smarty->assign("users", $rs->getArray());
		}
		
	}
}

?>
