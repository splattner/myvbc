<?php
require_once ("libs/framework/dataSource.php");

class SourceSVRS extends MyDatasource {


	//Variabeln
	private $xml_request; // Enthält den request String für das XML File
	private $xml_output; //XML Stream Output von SVRS
	
	
	// Variabeln die angepasst werden können
	private $xml_baseurl = 'http://www.svrs.ch/spiele_xml.php?'; // Base URL für das XML File
	private $sl_tags; //Enthält die Tags welche von der Spielliste abgefragt werden sollen
	private $rl_tags; //Enthält die Tags welche von der Rangliste abgefragt werden sollen
	
	
	
	public function __construct()
	{
	
		//die Ranglisten-Tags
		//Mögliche Tags: "platz","name","spiele","punkte","satzgewonnen","satzverloren","kommentar"
		$this->rl_tags = array("platz","name","spiele","punkte","satzgewonnen","satzverloren","kommentar");
		
		// die Spiellisten-Tags
		// Mögliche Tags: "nummer","hdatum","isodatum","liga","ort","halle","heimteam","gastteam", 
		//"satzheim","satzgast","punkteheim1","punktegast1","punkteheim2","punktegast2","punkteheim3","punktegast3","punkteheim4","punktegast4","punkteheim5","punktegast5",
		// "schiri1","schiri2","schiri3","bemerkung"
		$this->sl_tags = array("nummer","isodatum","liga","ort","halle","heimteam","gastteam","satzheim","satzgast","punkteheim1","punktegast1","punkteheim2","punktegast2","punkteheim3","punktegast3","punkteheim4","punktegast4","punkteheim5","punktegast5");
	}
	
	//Funktionen
	
	public function getGamesbyTeamID($teamID)
	{
		//Lädt alle Spiele vom Team mit ID '$TeamID' (oder auch mehrere) und gibt ein Array mit allen Spielen zurück
		
		//XML Request erstellen und XML File Laden
		$this->xml_request = "teamID=" . $teamID;
		$this->getXMLFile();

		//Array mit Spielliste zurückgeben
		$this->parseGamelist();
		$this->parseRaw();
		return $this->games;
	}
	
//	public function getRanklistbyLiga($liga)
//	{
//		//Lädt die Rangliste einer Liga '$liga' (oder auch mehrere) und gibt ein Array mit allen Spielen zurück
//		
//		//XML Request erstellen und XML File Laden
//		$this->xml_request = "liga=" . $liga;
//		$this->getXMLFile();
//		
//		//Array mit Ranglisten zurückgeben
//		$this->parseRanklist();
//	}
	
	public function getnextGamesbyVerein($vereinID, $days = 7)
	{
		//Lädt alle Spiele der nächsten $days (default = 7) Tagen vom Verein mit ID '$vereinID'
		
		//Zeitspanne festlegen
		$von = date("d.m.Y");
		$bis = date('d.m.Y', strtotime('+' . $days . ' days'));
	
		//XML Request erstellen und XML File Laden
		$this->xml_request = "vereinID=" . $vereinID . "&von=" . $von . "&bis=" . $bis;
		$this->getXMLFile();
		
		//Array mit Spielliste zurückgeben
		$this->parseGamelist();
		$this->parseRaw();
		return $this->games;
	}
	
	public function getGamesbyVerein($vereinID)
	{
		//Lädt alle nächsten Spiele von Verein mit ID '$vereinID' und gibt sie in einem Array zurück
		//Default ist aktuelle Woche, kann durch angeben von $week verändert werden
	
		//XML Request erstellen und XML File Laden
		$this->xml_request = "vereinID=" . $vereinID;
		$this->getXMLFile();
		
		//Array mit Spielliste zurückgeben
		$this->parseGamelist();
		$this->parseRaw();
		return $this->games;
	}
	
	public function getGamesbyRef($refID) {
		//XML Request erstellen und XML File Laden
		$this->xml_request = "refID=" . $refID;
		$this->getXMLFile();
		
		//Array mit Spielliste zurückgeben
		$this->parseGamelist();
		$this->parseRaw();
		return $this->games;
	}
	
	public function getlastGamesbyVerein($vereinID, $days = 7 )
	{
		//Lädt alle Spiele der letzten $days (default = 7) Tagen vom Verein mit ID '$vereinID'
		
		//Zeitspanne festlegen
		$von = date('d.m.Y', strtotime('-' . $days . ' days'));
		$bis = date("d.m.Y");
		
		//XML Request erstellen und XML File Laden
		$this->xml_request = "vereinID=" . $vereinID . "&von=" . $von . "&bis=" . $bis;
		$this->getXMLFile();
		
		//Array mit Spielliste zurückgeben
		$this->parseGamelist();
		$this->parseRaw();
		return $this->games;
		
	}
	

	private function parseGamelist() //Generiert ein Array mit den gewünschten Spielen
	{
		// Die gesamte Spielliste in $spielliste laden
		preg_match_all("/<spielliste>(.*?)<\/spielliste>/",$this->xml_output,$spielliste);
		
		//Alle Spiel aus Spielliste in '$spiele' laden
		preg_match_all("/<spiel id=\"\d+\">(.*?)<\\/spiel>/", $spielliste[1][0], $spiele);
		preg_match_all("/<spiel id=\"(.*?)\">/", $spielliste[1][0], $spielID);
		
	
		unset($spielliste);
		
		//Spiel parsen
		$i = 0;
		foreach ($spiele[1] as $spiel)
		{
			unset($buffer);
			//Gewünschte Tags auslesen
			foreach ($this->sl_tags as $val)
			{
				preg_match("/<".$val.">(.*?)<\/".$val.">/",$spiel,$tag);
				$buffer[$val]=$tag[1];
			}
			$buffer["id"] = $spielID[1][$i];
			$spielliste[]=$buffer;
			$i++;
		}
		$this->games_raw = $spielliste;
	}
	
	private function parseRanklist() //Generiert ein Array mit den gewünschten Ranglisten
	{
		// Die gesamte Rangliste in $ranglisten laden
		preg_match_all("/<rangliste>(.*?)<\/rangliste>/",$this->xml_output,$ranglisten);
		
		//Alle Ligen aus $ranglisten in $ligen laden
		preg_match_all("/<rliga>(.*?)<\\/rliga>/", $ranglisten[1][0], $ligen);
		
		unset($ranglisten);
		
		//Ligen Parsen
		foreach ($ligen[1] as $liga)
		{
			//Name der Liga
			preg_match("/<liganame>(.*?)<\/liganame>/",$liga,$liganame);
			
			// Alle Teams aus der Liga in $teams laden
			preg_match_all("/<team id=\"\d+\">(.*?)<\/team>/",$liga,$teams);
			
			// Alle Teams parsen
			foreach ($teams[1] as $team)
			{
				unset($buffer);
				
				# Gewünschte Tags auslesen
				foreach ($this->rl_tags as $val)
				{
					preg_match("/<".$val.">(.*?)<\/".$val.">/",$team,$tag);
					$buffer[$val]=$tag[1];
				}
				
				$ranglisten[$liganame[1]][]=$buffer;
			}
		}
		return $ranglisten;
	}
	
	private function getXMLFile()
	{
		//Lädt das XML File von www.volleyballvrs.ch
		//Benötigt einen Gültigen Request
		
		/*
		$request: Abfrage-String (Z.B.: 'liga=2d&teamID=84')
		Moegliche Abfragen:
		liga=Liga1[,Liga2,...] (generiert für jede Liga eine Ranglistentabelle)
		teamID=id[,id,...] (rendert für ein oder mehrere Teams alle Spiele)
		vereinID=id (rendert alle Spiele des Vereins mit der id
		refID=id (rendert alle Spiele, für die der Schiedsrichter mit der id aufgeboten ist)
		suche=suchtext (rendert alle Spiele, in denen im Teamname der suchtext enthalten ist)
		von=dd.mm.yyyy (rendert alle Spiele ab diesem Datum)
		bis=dd.mm.yyyy (rendert alle Spiele bis diesem Datum)
		woche=x (rendert alle Spiele in aktueller [x=0], vorheriger [x=-1], nächster [x=1] usw. Woche)
		*/
		
		
		
		//Lädt den XML Stream mit Curl
		$xml_file = curl_init($this->xml_baseurl.$this->xml_request);
		curl_setopt($xml_file, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($xml_file, CURLOPT_TIMEOUT, 10);
		$this->xml_output = curl_exec($xml_file);
		curl_close($xml_file);
		
		
		//New Line und Tabs entfernen
		$this->xml_output=preg_replace("/[\\n\\r\\t]+/", '', $this->xml_output);
	}
	
	
	public function parseRaw() {
		
		//Reset Games Array
		unset($this->games);
		$this->games = array();
		
		if (count($this->games_raw) > 0) {
			foreach ($this->games_raw as $game) {
				$temp = array();
				$temp["extid"] = $game["nummer"];
				$temp["datum"] = $game["isodatum"];
				$temp["heimteam"] = utf8_decode($game["heimteam"]);
				$temp["gastteam"] = utf8_decode($game["gastteam"]);
				$temp["ort"] = utf8_decode($game["ort"]);
				$temp["halle"] = utf8_decode($game["halle"]);	
				$temp["gameID"] = $game["id"];	
				
				$this->games[] = $temp;
				unset($temp);
			}
		}
	}
}
?>
