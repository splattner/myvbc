<?php

namespace splattner\myvbc\models;

use splattner\framework\Model;

use PHPMailer\PHPMailer\PHPMailer;

// no direct access
defined('_MYVBC') or die('Restricted access');




class MNotification extends Model
{
    public $table = 'notification';
    
    
    public function newNotification($type, $message, $objectID, $personID)
    {
        $sql = "INSERT INTO 
			notification (type, message, objectid, date, personid) 
			VALUES (
				?,
				?,
				?,
				NOW(),
				?
			)";
        $sql = $this->pdo->Prepare($sql);
        $sql->Execute(array($type, $message, $objectID, $personID));
        $notificationid = $this->pdo->lastInsertId();
        
        //Get all Subscriptions for this Notification type
        $sql = "SELECT personid, email FROM notificationsubscription  WHERE typeid = ?";
        $sql = $this->pdo->Prepare($sql);
        $sql->Execute(array($type));

        
        //Add new notificationstatus
        while ($res = $sql->fetch()) {
            $sql2 = "INSERT INTO notificationstatus (notificationid, personid) VALUES(?,?)";
            $sql2 = $this->pdo->Prepare($sql2);
            $sql2->Execute(array($notificationid, $res["personid"]));
            
            // Send E-Mail if enabled for this person
            if ($res["email"] == 1) {
                $sql3 = "SELECT prename, name, email FROM persons WHERE id = ?";

                $sql3 = $this->pdo->Prepare($sql3);
                $sql3->Execute(array($res["personid"]));
                $currentPerson = $sql3->fetch();
                
                $content = "<p>Du hast eine neue Benachrichtigung auf myVBC erhalten:</p><p>" . $message . "</p>";
                $mail = new PHPMailer();
                $mail->IsSMTP();
                $mail->Host       = "localhost"; // sets the SMTP server
                $mail->Port       = 25;                    // set the SMTP port for the GMAIL server
                
                $mail->SetFrom("myVBC@vbclangenthal.ch", "myVBC");
                $mail->AddAddress($currentPerson["email"], $currentPerson["prename"] . " " . $currentPerson["name"]);
                $mail->Subject = "[myVBC] neue Benachrichtigung";
                $mail->IsHTML(true);
                $mail->Body = $content;
                $mail->Send();
            }
        }
    }
    
    public function deleteNotificationStatus($notificationID, $personID)
    {

        //Check if we should delete all Notifications
        if ($notificationID == 0) {
            $sql = "DELETE FROM notificationstatus WHERE personid = ?";
            $sql = $this->pdo->Prepare($sql);
            $sql->Execute(array($personID));
        } else {
            $sql = "DELETE FROM notificationstatus WHERE notificationid = ? AND personid = ?";
            $sql = $this->pdo->Prepare($sql);
            $sql->Execute(array($notificationID, $personID));
        }
    }
    
    public function deleteSubscribtion($typeID, $personID)
    {
        $sql = "DELETE FROM notificationsubscription WHERE typeid = ? AND personid = ?";
        $sql = $this->pdo->Prepare($sql);
        $sql->Execute(array($typeID, $personID));
    }
    
    public function addSubscription($typeID, $personID, $email)
    {
        $sql = "INSERT INTO notificationsubscription (typeid, personid, email) VALUES(?,?,?)";
        $sql = $this->pdo->Prepare($sql);
        $sql->Execute(array($typeID, $personID, $email));
    }
    
    
    public function getNotificationStatus($personID)
    {
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
					notificationstatus.personid = ?
				ORDER BY
					notification.date";

        $sql = $this->pdo->Prepare($sql);
        $sql->Execute(array($personID));
        return $sql;
    }
    
    public function getAllNotifications($from = null, $to = null)
    {
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
			notification.date DESC";

        if (!is_Null($from)) {
            $sql .= "LIMIT " . $from;
        }
        if (!is_Null($to)) {
            $sql .=", " . $to;
        }

        return $this->pdo->query($sql);
    }
    
    public function getAllSubscriptions()
    {
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
        
        return $this->pdo->query($sql);
    }
    
    public function getAllNotificationTypes()
    {
        $sql = "SELECT
					id,
					name
				FROM
					notificationtype
				ORDER BY
					name";
        
        return $this->pdo->query($sql);
    }
    
    public function getHistory($personID)
    {
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
					notification.objectid = ?
				ORDER BY
					notification.date DESC";

        $sql = $this->pdo->Prepare($sql);
        $sql->Execute(array($personID));
        return $sql;
    }
}
