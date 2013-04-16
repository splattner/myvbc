#!/usr/bin/php -q
<?php

ob_start();


require_once('../libs/PHPMailer_v5.0.2/class.phpmailer.php');
require_once('../libs/MimeMailParser/MimeMailParser.class.php'); 


mysql_connect("localhost","vbcl_myvbc","f5hVN1fTuMEb");
mysql_select_db("vbcl_myvbc");


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


$sql = "Select
		persons.name AS name,
		persons.prename AS prename,
		persons.email AS email,
	FROM
		persons
	LEFT JOIN
		players ON persons.id = players.person
	LEFT JOIN
		teams ON teams.id = players.team
	WHERE
		teams.id = 12
	ORDER BY
		players.typ ASC, persons.name ASC, persons.prename ASC";

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
