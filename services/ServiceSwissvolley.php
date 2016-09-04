<?php
namespace splattner\myvbc\service;



class ServiceSwissvolley extends ServiceDataSource {
	
	private $soap_client;
	
	public function __construct() {
		$this->soap_client = new \SoapClient("http://myvolley.volleyball.ch/SwissVolley.wsdl");
	}
	
	public function getGamesByTeamID($teamID) {
		
		$this->games_raw = $this->soap_client->getGamesTeam($teamID);
	
		$this->parseRaw();
		return $this->games;	
	}
	
	public function parseRaw() {
		
		unset($this->games);
		$this->games = array();
		
		if (count($this->games_raw) > 0) {
			foreach ($this->games_raw as $game) {
				$temp = array();
				$temp["extid"] = $game->ID_game;
				$temp["datum"] = $game->PlayDate;
				$temp["heimteam"] = utf8_decode($game->TeamHomeCaption);
				$temp["gastteam"] = utf8_decode($game->TeamAwayCaption);
				$temp["ort"] = utf8_decode($game->HallPlace);
				$temp["halle"] = utf8_decode($game->HallCaption);		
				
				$this->games[] = $temp;
				unset($temp);
			}
		}
	}
	
}

?>