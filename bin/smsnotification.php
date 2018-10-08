#!/usr/bin/php -q
<?php

// Set flag that this is a parent file
define( '_MYVBC', 1 );


/**
 * Composer
 */
require '../vendor/autoload.php';


// Load Environment from .env File
$dotenv = new \Dotenv\Dotenv(__DIR__);
$dotenv->safeLoad();


/**
 * Config
 */
require_once "../etc/confic.inc.php";


use Aspsms\Aspsms;

/**
 * Initialize the Database Connection
 */
$pdo = new \PDO($config["db"]["url"], $config["db"]["username"], $config["db"]["password"]);

$days = 2;
$send = "send";


$day = date('Y-m-d', strtotime('+' . $days . ' days'));
$sqlquery = "SELECT
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
			AND schreiber.game IS NOT NULL";

$pdoStatement = $pdo->Prepare($sqlquery);
$pdoStatement->Execute();


$mail = new PHPMailer();
$mail->SMTPOptions = array(
    'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
    )
);
$mail->IsSMTP();
$mail->Host = "localhost";
$mail->SetFrom("myVBC@vbclangenthal.ch", "myVBC");
$mail->AddAddress("sebastian@vbclangenthal.ch","Sebastian Plattner");
$mail->Subject = "myVBC SMS Notification Report";
$mail->IsHTML(false);

$mailcontent = "Report for Today, Games on " . $day . ": \n\n";

while ($row = $pdoStatement->fetch()) {
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


			$aspsms = new Aspsms($config["aspsms"]["username"], $config["aspsms"]["password"], array(
					'Originator' => 'myVBC'
			));

			$status = $aspsms->sendTextSms($smstext, array(
					'0' => $row["mobile"]
			));

			// If something went wrong while sending, we want to see what happens.
			if (!$status) {
				echo "Aspsms Error: " . $aspsms->getSendStatus();
			}

		}


	}

}

if($send != "send") {
	$mailcontent .= "\n\nTest mode without send Command";
}

echo $mailcontent . "\n";

$mail->Body = $mailcontent;
$mail->Send();
?>
