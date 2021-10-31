#!/usr/bin/php -q
<?php

// Set flag that this is a parent file
define('_MYVBC', 1);


/**
 * Composer
 */
require '../vendor/autoload.php';


// Load Environment from .env File
$dotenv = new \Dotenv\Dotenv("../");
$dotenv->safeLoad();



use Aspsms\Aspsms;


/**
 * Config
 */
require_once "../etc/confic.inc.php";


if ($config["smsnotification"]["key"] != $_GET["key"]) {
	http_response_code(401);
	exit("Authorization Required");
}


/**
 * Initialize the Database Connection
 */
$pdo = new \PDO($config["db"]["url"], $config["db"]["username"], $config["db"]["password"]);

$days = $config["smsnotification"]["numberofdays"];
$send = $config["smsnotification"]["enabled"];

if (isset($_GET["days"])) {
    $days = $_GET["days"];
}


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
			teams.name AS teamname,
            schreiber.type AS type
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

$mail->IsSMTP();

$mail->Host = $config["mail"]["host"];
$mail->Port = $config["mail"]["port"];
$mail->SMTPAuth = true;
$mail->SMTPSecure = 'tls';
$mail->Username = $config["mail"]["username"];
$mail->Password = $config["mail"]["password"];


$mail->SetFrom($config["mail"]["from"], $config["mail"]["from_name"]);
$mail->AddAddress($config["mail"]["admin"], $config["mail"]["admin_name"]);
$mail->Subject = "myVBC SMS Notification Report";
$mail->IsHTML(false);


$mailcontent = "Report for Today, Games on " . $day . ": \n\n";


foreach ($pdoStatement->fetchAll() as $row) {
    list($datum, $zeit) = explode(" ", $row["date"]);
    list($jahr, $monat, $tag) = explode("-", $datum);
    list($stunden, $minuten, $sekunden) = explode(":", $zeit);

    $einsatz = "Schreibereinsatz";

    if ($row["type"] > 0) { 
        $einsatz = "Schiedsrichtereinsatz";
    }

    $smstext =
    "Hallo " . $row["prename"] ."\nErrinnerung an " . $einsatz . "!\nDatum: " . $tag . "." . $monat . "." . $jahr . " Spielbeginn: " . $stunden . ":" . $minuten ."\n" .
    "Halle: " . $row["halle"] . "\nTeam: " . $row["teamname"] . "\nBitte sei min. 30 Minuten vor Spielbeginn vor Ort.";



    if ($row["sms"] && $row["mobile"] != "") {
        $mailcontent .= $smstext . "\n\n";

        list($datum, $zeit) = explode(" ", $row["date"]);
        list($jahr, $monat, $tag) = explode("-", $datum);
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

if ($send != "send") {
    $mailcontent .= "\n\nTest mode without send Command";
}

echo $mailcontent . "\n";

$mail->Body = $mailcontent;

$mail->Send();
?>
