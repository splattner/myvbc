<?php
/*

PHP Klasse f�r die Abfrage von Spielpl�nen und Ranglisten von Swissvolley

Script: Plattner Sebastian webmaster@vbclangenthal.ch

*/

class swissvolley
{

	//Variabeln
	
	private $soap_client; //Soap Client f�r die Verbindung mit Swissvolley
	
	
	public function __construct() // Konstruktor
	{
		// Soap Verbindung �ffnen
		$this->soap_client = new \SoapClient("http://myvolley.volleyball.ch/SwissVolley.wsdl");
	}
	
	// Funktionen
	public function get_GamesbyTeamID($teamID) // L�dt alle Spiele des Team mit ID '$teamID' und gibt diese als Array zur�ck
	{
		return $this->soap_client->__soapCall("getGamesTeam", array($teamID));
	}
	
	public function get_GameDetailed($gameID) // Gibt detailierte Informationen �ber das Spiel mit ID '$gameID'
	{
		return $this->soap_client->__soapCall("getGameDetailed", array($gameID));
	}
	
	public function get_Table($groupID) // Rankliste ausgeben
	{
		return $this->soap_client->__soapCall("getTable", array($groupID));
	}

	public function getGamesByClub($clubID) {

		return $this->soap_client->__soapCall("getGamesByClub", array($clubID));


	}
	
}
?>