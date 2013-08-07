#!/usr/bin/php -q
<?php

// Set flag that this is a parent file
define( '_MYVBC', 1 );

require_once "../etc/confic.inc.php";
require_once "../libs/adodb5/adodb.inc.php";
require_once "../libs/sms/SMS.php";
require_once "../libs/PHPMailer_v5.0.2/class.phpmailer.php";

//require_once "../etc/confic.inc.php";
//require_once "../libs/adodb5/adodb.inc.php";
//require_once "../libs/sms/SMS.php";

/**
 * Initialize the Database Connection
 */
$dsn = "mysql://" 
. $config["db"]["username"] . ":" 
. $config["db"]["password"] . "@"
. $config["db"]["server"] . "/"
. $config["db"]["database"];
$db = NewADOConnection($dsn);

$days = 2;
$send = "";




$day = date('Y-m-d', strtotime('+' . $days . ' days'));
$sql = "SELECT
			games.date AS date,
			games.ort AS ort,
			games.halle AS halle,
			persons.name AS name,
			persons.prename AS prename,
			persons.mobile AS mobile,
			persons.email AS email,
			persons.sms AS sms,
			teams.name AS teamname
		FROM
			games
		LEFT JOIN
			schreiber ON games.id = schreiber.game
		LEFT JOIN
			persons ON schreiber.person = persons.id
		LEFT JOIN
			teams ON games.team = teams.id
		WHERE
			date LIKE '" . $day . "%'
			AND heimspiel = 1
			AND schreiber.game IS NOT NULL
			 ";

$rs = $db->Execute($sql);

$mail = new PHPMailer();
$mail->IsSMTP();
$mail->Host = "localhost";
$mail->SetFrom("myVBC@vbclangenthal.ch", "myVBC");
$mail->AddAddress("sebastian@vbclangenthal.ch","Sebastian Plattner");
$mail->Subject = "myVBC SMS Notification Report";
$mail->IsHTML(false);

$mailcontent = "Report for Today: \n\n";

while ($row = $rs->FetchRow()) {
		list($datum, $zeit) = explode(" ", $row["date"]);
		list($jahr, $monat, $tag) = explode ("-", $datum);
		list($stunden, $minuten, $sekunden) = explode(":", $zeit);
		
$smstext = 
"Hallo " . $row["prename"] ."\nErrinnerung an Schreibereinsatz!
Datum: " . $tag . "." . $monat . "." . $jahr .
" Spielbeginn: " . $stunden . ":" . $minuten ."\n" .
"Halle: " . $row["halle"] . "\nTeam: " . $row["teamname"];
	
	if($row["sms"] && $row["mobile"] != "") {
		
		$mailcontent .= $smstext . "\n\n";
		
		list($datum, $zeit) = explode(" ", $row["date"]);
		list($jahr, $monat, $tag) = explode ("-", $datum);
		list($stunden, $minuten, $sekunden) = explode(":", $zeit);
		
		if ($send == "send") {
			$sms = new SMS($config["aspsms"]["username"], $config["aspsms"]["password"]);
			$sms->setOriginator("myVBC");
			$sms->addRecipient($row["mobile"]);
			$sms->setContent($smstext);
			$sms->sendSMS();
			$sms = NULL;
		}


	}

}

if($send != "send") {
	$mailcontent .= "<p>Test mode without send Command</p>";
}

echo $mailcontent . "\n";

$mail->Body = $mailcontent;
$mail->Send();
?>
