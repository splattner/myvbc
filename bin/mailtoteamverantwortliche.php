#!/usr/bin/php -q
<?php

ob_start();


/**
 * Composer
 */
require __DIR__ . '..//vendor/autoload.php';

require_once "../etc/confic.inc.php";


mysqli_connect($config["db"]["server"],$config["db"]["username"],$config["db"]["password"]);
mysqli_select_db($config["db"]["database"]);


// read from stdin
$fd = fopen("php://stdin", "r");


$parser = new MimeMailParser();
$parser->setStream($fd);

$subject = $parser->getHeader('subject');
$from = $parser->getHeader('from');

$text = $parser->getMessageBody('text');
$html = $parser->getMessageBody('html');
$attachments = $parser->getAttachments();

$mail = new PHPMailer();
$mail->SetFrom('info@vbclangenthal.ch', 'VBC Langenthal');
$mail->AddReplyTo('info@vbclangenthal.ch', 'VBC Langenthal');

$mail->Subject = "[VBC Langenthal] " . $subject;


$mail->AddAddress("info@vbclangenthal.ch", "VBC Langenthal");


$sql = "
SELECT
  persons.prename as prename,
  persons.name as name,
  persons.email as email
FROM
  players
LEFT JOIN
  persons ON players.person = persons.id
LEFT JOIN
  teams ON players.team = teams.id
WHERE
  players.typ = 2 OR players.typ = 3
ORDER BY
  teams.name";

$query = mysql_query($sql);

while ($row = mysql_fetch_array($query)) {

	if ($row["email"] != "") {
		$mail->AddBCC($row["email"], $row["prename"] . " " . $row["name"]);

	}
}

if ($html == "") {
	$mail->isHTML(false);
	$mail->Body = $text;
} else {
	$mail->MsgHTML($html);
}




$save_dir = '../tmp/';
foreach($attachments as $attachment) {
	// get the attachment name
	$filename = $attachment->filename;
	// write the file to the directory you want to save it in
	if ($fp = fopen($save_dir.$filename, 'w')) {
		while($bytes = $attachment->read()) {
			fwrite($fp, $bytes);
		}
		fclose($fp);
	}
	
	$mail->AddAttachment($save_dir.$filename);
}


$mail->Send();

foreach($attachments as $attachment) {
	$filename = $attachment->filename;
	unlink($save_dir.$filename);
}


ob_clean();
?>
