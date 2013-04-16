#!/usr/bin/php -q
<?php

//ob_start();


require_once('../libs/PHPMailer_v5.0.2/class.phpmailer.php');
require_once('../libs/MimeMailParser/MimeMailParser.class.php'); 


mysql_connect("localhost","sebasti4_vbclmyv","f5hVN1fTuMEb");
mysql_select_db("sebasti4_vbclmyvbc");


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
$mail->Subject = "[VBC Langenthal] " . $subject;


$mail->AddAddress("info@vbclangenthal.ch", "VBC Langenthal");


$sql = "SELECT prename, name, email FROM persons WHERE active=1";

$query = mysql_query($sql);

while ($row = mysql_fetch_array($query)) {

	if ($row["email"] != "") {
		//$mail->AddBCC($row["email"], $row["prename"] . " " . $row["name"]);
		$html .= $row["email"] . " -> " . $row["prename"] . " " . $row["name"] . "<br />\n";

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
