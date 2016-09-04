<?php
/*
PHP-Class f�r die Abfrage von Spielpl�nen und Resultate von Swissvolley Region Solothurn

Script: Plattner Sebastian webmaster@vbclangenthal.ch

Das Script kann nach belieben angepasst werden, sofern die Hinweise von Swissvolley Region Solothurn beachtet werden.

# Die Spieldaten und Ranglisten des SVRS k�nnen frei genutzt werden, solange
# der Quellen- und Copyright-Hinweis mit Link Sicht- und Lesbar angegeben wird:
# Ranglisten&amp;Spieldaten: &copy; <a href="http://www.volleyballvrs.ch" target="_blank" title="Swiss Volley - Region Solothurn">SVRS</a>

Vielen Dank an Gerd M�ller welche die Grundlage f�r diese Class erstellt hat.


#####################
##    Hinweis zur Verwendung    ##
#####################

Abfragen werden in den get_* Funktionen definiert (3 Varianten sind schon vorhanden)

1) $this->xml_request mit den gew�nschten werten f�llen
2) svrs::get_XMLFile aufrufen um die XML Daten von SVRS zu laden
3) Entsprechendes Array zur�ck geben
	a) svrs::parse_Gamelist() 
		Gibt ein Array mit dem Spielen zur�ck
	b) svrs::parse_Ranklist()
		Gibt ein Array mit Ranglisten zur�ck
		


*/

class svrs
{

	//Variabeln
	protected $xml_request; // Enth�lt den request String f�r das XML File
	protected $xml_output; //XML Stream Output von SVRS
	
	
	// Variabeln die angepasst werden k�nnen
	public $xml_baseurl = 'http://www.svrs.ch/spiele_xml.php?'; // Base URL f�r das XML File
	public $sl_tags; //Enth�lt die Tags welche von der Spielliste abgefragt werden sollen
	public $rl_tags; //Enth�lt die Tags welche von der Rangliste abgefragt werden sollen
	
	
	
	public function __construct() //Konstruktor
	{
		//#####################################
		//## Diesen Teil bearbeiten wenn andere Tags gew�nscht sind ##
		//## Kann auch extern angepasst werden                                     ##
		//#####################################
		
		//die Ranglisten-Tags
		//M�gliche Tags: "platz","name","spiele","punkte","satzgewonnen","satzverloren","kommentar"
		$this->rl_tags = array("platz","name","spiele","punkte","satzgewonnen","satzverloren","kommentar");
		
		// die Spiellisten-Tags
		// M�gliche Tags: "nummer","hdatum","isodatum","liga","ort","halle","heimteam","gastteam", 
		//"satzheim","satzgast","punkteheim1","punktegast1","punkteheim2","punktegast2","punkteheim3","punktegast3","punkteheim4","punktegast4","punkteheim5","punktegast5",
		// "schiri1","schiri2","schiri3","bemerkung"
		$this->sl_tags = array("nummer","isodatum","liga","ort","halle","heimteam","gastteam","satzheim","satzgast","punkteheim1","punktegast1","punkteheim2","punktegast2","punkteheim3","punktegast3","punkteheim4","punktegast4","punkteheim5","punktegast5");
	}
	
	//Funktionen
	
	public function get_GamesbyTeamID($teamID)
	{
		//L�dt alle Spiele vom Team mit ID '$TeamID' (oder auch mehrere) und gibt ein Array mit allen Spielen zur�ck
		
		//XML Request erstellen und XML File Laden
		$this->xml_request = "teamID=" . $teamID;
		$this->get_XMLFile();

		//Array mit Spielliste zur�ckgeben
		return $this->parse_Gamelist();
	}
	
	public function get_RanklistbyLiga($liga)
	{
		//L�dt die Rangliste einer Liga '$liga' (oder auch mehrere) und gibt ein Array mit allen Spielen zur�ck
		
		//XML Request erstellen und XML File Laden
		$this->xml_request = "liga=" . $liga;
			
		$this->get_XMLFile();
		
		//Array mit Ranglisten zur�ckgeben
		return $this->parse_Ranklist();
	}
	
	public function get_nextGamesbyVerein($vereinID, $days = 7)
	{
		//L�dt alle Spiele der n�chsten $days (default = 7) Tagen vom Verein mit ID '$vereinID'
		
		//Zeitspanne festlegen
		$von = date("d.m.Y");
		$bis = date('d.m.Y', strtotime('+' . $days . ' days'));
	
		//XML Request erstellen und XML File Laden
		$this->xml_request = "vereinID=" . $vereinID . "&von=" . $von . "&bis=" . $bis;
		$this->get_XMLFile();
		
		//Array mit Spielliste zur�ckgeben
		return $this->parse_Gamelist();
	}
	
	public function get_GamesbyVerein($vereinID)
	{
		//L�dt alle n�chsten Spiele von Verein mit ID '$vereinID' und gibt sie in einem Array zur�ck
		//Default ist aktuelle Woche, kann durch angeben von $week ver�ndert werden
	
		//XML Request erstellen und XML File Laden
		$this->xml_request = "vereinID=" . $vereinID;
		$this->get_XMLFile();
		
		//Array mit Spielliste zur�ckgeben
		return $this->parse_Gamelist();
	}
	
	public function get_lastGamesbyVerein($vereinID, $days = 7 )
	{
		//L�dt alle Spiele der letzten $days (default = 7) Tagen vom Verein mit ID '$vereinID'
		
		//Zeitspanne festlegen
		$von = date('d.m.Y', strtotime('-' . $days . ' days'));
		$bis = date("d.m.Y");
		
		//XML Request erstellen und XML File Laden
		$this->xml_request = "vereinID=" . $vereinID . "&von=" . $von . "&bis=" . $bis;
		$this->get_XMLFile();
		
		//Array mit Spielliste zur�ckgeben
		return $this->parse_Gamelist();
		
	}
	
	// Hier k�nnen neue Abfrage Funktion definiert werden
	/*
	public function get_*(�bergabewerte)
	{
		//XML Request erstellen und XML File Laden
		$this->xml_request = ######### Hier anpassen ###########
		$this->get_XMLFile();
		
		//Entsprechendes Array zur�ckgeben
		return $this->parse_Gamelist();
		return $this->parse_Ranklist();
	}
	
	*/
	
	private function parse_Gamelist() //Generiert ein Array mit den gew�nschten Spielen
	{

		$spielliste = "";
		// Die gesamte Spielliste in $spielliste laden
		preg_match_all("/<spielliste>(.*?)<\/spielliste>/",$this->xml_output,$spielliste);
		
		//Alle Spiel aus Spielliste in '$spiele' laden
		preg_match_all("/<spiel id=\"\d+\">(.*?)<\\/spiel>/", $spielliste[1][0], $spiele);
	
		unset($spielliste);

		$spielliste = "";
		
		//Spiel parsen
		foreach ($spiele[1] as $spiel)
		{
			unset($buffer);
			//Gew�nschte Tags auslesen
			foreach ($this->sl_tags as $val)
			{
				preg_match("/<".$val.">(.*?)<\/".$val.">/",$spiel,$tag);
				$buffer[$val]=$tag[1];
			}
			$spielliste[]=$buffer;
		}
		return $spielliste;
	}
	
	private function parse_Ranklist() //Generiert ein Array mit den gew�nschten Ranglisten
	{

		$spielliste = "";

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
				
				# Gew�nschte Tags auslesen
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
	
	private function get_XMLFile()
	{
		//L�dt das XML File von www.volleyballvrs.ch
		//Ben�tigt einen G�ltigen Request
		
		/*
		$request: Abfrage-String (Z.B.: 'liga=2d&teamID=84')
		Moegliche Abfragen:
		liga=Liga1[,Liga2,...] (generiert f�r jede Liga eine Ranglistentabelle)
		teamID=id[,id,...] (rendert f�r ein oder mehrere Teams alle Spiele)
		vereinID=id (rendert alle Spiele des Vereins mit der id
		refID=id (rendert alle Spiele, f�r die der Schiedsrichter mit der id aufgeboten ist)
		suche=suchtext (rendert alle Spiele, in denen im Teamname der suchtext enthalten ist)
		von=dd.mm.yyyy (rendert alle Spiele ab diesem Datum)
		bis=dd.mm.yyyy (rendert alle Spiele bis diesem Datum)
		woche=x (rendert alle Spiele in aktueller [x=0], vorheriger [x=-1], n�chster [x=1] usw. Woche)
		*/
		
		
		
		//L�dt den XML Stream mit Curl
		$this->xml_request = str_replace(" ","%20",$this->xml_request);
		$xml_file = curl_init($this->xml_baseurl.$this->xml_request);
		
		curl_setopt($xml_file, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($xml_file, CURLOPT_TIMEOUT, 10);
		$this->xml_output = curl_exec($xml_file);
		//echo $this->xml_output;
		curl_close($xml_file);
		
		
		//New Line und Tabs entfernen
		$this->xml_output=preg_replace("/[\\n\\r\\t]+/", '', $this->xml_output);
	}
}
?>
