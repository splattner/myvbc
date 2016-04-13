<?php
// no direct access
defined( '_MYVBC' ) or die( 'Restricted access' );


class MNotification extends MyModel {
	public $table = 'notification';
	
	
	public function newNotification($type, $message, $objectID, $personID) {
		
		
		$sql = "INSERT INTO 
			notification (type, message, objectid, date, personid) 
			VALUES (
				" . $this->db->qstr($type) .",
				" . $this->db->qstr($message) .",
				" . $this->db->qstr($objectID) .",
				NOW(),
				" . $this->db->qstr($personID)."
			)";
		
		$this->db->Execute($sql);
		echo $this->db->ErrorMsg();
		$notificationid = $this->db->Insert_ID();
		
		//Get all Subscriptions for this Notification type
		$sql = "SELECT personid, email FROM notificationsubscription  WHERE typeid = '" . $type ."'";
		$rs = $this->db->Execute($sql);

		
		//Add new notificationstatus
		while ($res = $rs->fetchRow()) {
			$sql = "INSERT INTO notificationstatus (notificationid, personid) VALUES(". $notificationid ."," . $res["personid"] .")";
			$this->db->Execute($sql);
			
			// Send E-Mail if enabled for this person
			if ($res["email"] == 1) {
				$sql = "SELECT prename, name, email FROM persons WHERE id = " . $this->db->qstr($res["personid"]);
				
				$rs_currentPerson = $this->db->Execute($sql);
				$currentPerson = $rs_currentPerson->fetchRow();
				
				$content = "<p>Du hast eine neue Benachrichtigung auf myVBC erhalten:</p><p>" . $message . "</p>";
				$mail = new PHPMailer();
				$mail->IsSMTP();
				$mail->Host       = "localhost"; // sets the SMTP server
				$mail->Port       = 25;                    // set the SMTP port for the GMAIL server
				
				$mail->SetFrom("myVBC@vbclangenthal.ch", "myVBC");
				$mail->AddAddress($currentPerson["email"],$currentPerson["prename"] . " " . $currentPerson["name"]);
				$mail->Subject = "[myVBC] neue Benachrichtigung";
				$mail->IsHTML(true);
				$mail->Body = $content;
				$mail->Send();
				
	
			}

		}
	}
	
	public function deleteNotificationStatus($notificationID, $personID) {
		
		$sql = "DELETE FROM notificationstatus WHERE notificationid = " . $this->db->qstr($notificationID) . " AND personid = " . $this->db->qstr($personID);
		$this->db->Execute($sql);
	}
	
	public function deleteSubscribtion($typeID, $personID) {
		$sql = "DELETE FROM notificationsubscription WHERE typeid = " . $this->db->qstr($typeID) . " AND personid = " . $this->db->qstr($personID);
		$this->db->Execute($sql);
	}
	
	public function addSubscription($typeID, $personID, $email) {
		$sql = "INSERT INTO notificationsubscription (typeid, personid, email) VALUES(
				" . $this->db->qstr($typeID) . ",
				" . $this->db->qstr($personID) .",
				" . $this->db->qstr($email) ."
				)";
		$this->db->Execute($sql);
	}
	
	
	public function getNotificationStatus($personID) {
		
		$sql = "SELECT 
					notification.id AS notificationID,
					notificationtype.name AS type,
					notification.message AS message,
					notification.date AS date,
					persons.prename AS prename,
					persons.name AS name
				FROM
					notificationstatus
				LEFT JOIN
					notification ON notificationstatus.notificationid = notification.id
				LEFT JOIN
					notificationtype ON notificationtype.id = notification.type
				LEFT JOIN
					persons ON notification.personid = persons.id
				WHERE
					notificationstatus.personid = " . $this->db->qstr($personID) . "
				ORDER BY
					notification.date";

		return $this->db->Execute($sql);
	}
	
	public function getAllNotifications($from = 0, $to = 200) {
				$sql = "SELECT 
					notification.id AS notificationID,
					notificationtype.name AS type,
					notification.message AS message,
					notification.date AS date,
					persons.prename AS prename,
					persons.name AS name
				FROM
					notification
				LEFT JOIN
					notificationtype ON notificationtype.id = notification.type
				LEFT JOIN
					persons ON notification.personid = persons.id
				ORDER BY
					notification.date DESC
				LIMIT " . $from ." ," . $to;

		return $this->db->Execute($sql);
	}
	
	public function getAllSubscriptions() {
		
		$sql = "SELECT
					notificationsubscription.typeid AS typeid,
					notificationsubscription.email AS email,
					persons.id AS personid,
					notificationtype.name AS type,
					persons.prename AS prename,
					persons.name AS name
				FROM 
					notificationsubscription
				LEFT JOIN
					notificationtype ON notificationsubscription.typeid = notificationtype.id
				LEFT JOIN
					persons ON notificationsubscription.personid = persons.id
				ORDER BY
					notificationtype.name,
					persons.name,
					persons.prename";
		
		return $this->db->Execute($sql);
	}
	
	public function getAllNotificationTypes() {
		$sql = "SELECT
					id,
					name
				FROM
					notificationtype
				ORDER BY
					name";
		
		return $this->db->Execute($sql);
	}
	
	public function getHistory($personID) {
	
		$sql = "SELECT 
					notification.id AS notificationID,
					notificationtype.name AS type,
					notification.message AS message,
					notification.date AS date,
					persons.prename AS prename,
					persons.name AS name
				FROM
					notification
				LEFT JOIN
					notificationtype ON notificationtype.id = notification.type
				LEFT JOIN
					persons ON notification.personid = persons.id
				WHERE
					notification.objectid = " . $this->db->qstr($personID) . "
				ORDER BY
					notification.date DESC";

		return $this->db->Execute($sql);
	
	}
	
}
	

?>
