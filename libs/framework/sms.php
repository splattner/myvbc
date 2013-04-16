<?php




class MySMS {
	
	public $config;
	
	private $sms; // APS SMS Interface.
	
	public function __construct(){
		
		$this->config = MyApplication::getInstance("config");

		
		//Mit ASPSMS Interface Verbinden
		$this->sms = new SMS($this->config["aspsms"]["username"], $this->config["aspsms"]["password"]);
		
	}
	
	public function __destruct() {
		unset($this->sms);
	}
	
	public function addRecipient($recipient)	{
		$this->sms->addRecipient($recipient);	
	}
	
	public function setOriginator($originator) {
		$this->sms->setOriginator($originator);
	}
	
	public function setContent($content) {
		$this->sms->setContent($content);
	}
	
	public function sendSMS() {
		return $this->sms->sendSMS();
	}
	
	public function getErrorDescription() {
		return $this->sms->getErrorDescription();
	}
}
?>