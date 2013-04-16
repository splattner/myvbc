<?php
/*

PHP Klasse für die Abfrage von Spielplänen und Ranglisten von Swissvolley

Script: Plattner Sebastian webmaster@vbclangenthal.ch

*/

class swissvolley
{

	//Variabeln
	
	private $soap_client; //Soap Client für die Verbindung mit Swissvolley
	
	
	public function swissvolley() // Konstruktor
	{
		// Soap Verbindung öffnen
		$this->soap_client = new SoapClient("http://myvolley.volleyball.ch/SwissVolley.wsdl");
	}
	
	// Funktionen
	public function get_GamesbyTeamID($teamID) // Lädt alle Spiele des Team mit ID '$teamID' und gibt diese als Array zurück
	{
		return $this->soap_client->getGamesTeam($teamID);
	}
	
	public function get_GameDetailed($gameID) // Gibt detailierte Informationen über das Spiel mit ID '$gameID'
	{
		return $this->soap_client->getGameDetailed($gameID);
	}
	
	public function get_Table($groupID) // Rankliste ausgeben
	{
		return $this->soap_client->getTable($groupID);
	}
	
}
?>