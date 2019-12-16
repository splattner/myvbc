<?php

namespace splattner\myvbc\models;

use splattner\framework\Application;
use splattner\framework\Model;
use splattner\mailmanapi\MailmanAPI;

// no direct access
defined('_MYVBC') or die('Restricted access');


class MPerson extends Model
{
    public $table = 'persons';

    public function getMyGames($personID)
    {
        $sql = "SELECT
          games.extid as extid,
					games.date as date,
					games.gegner as gegner,
					games.ort as ort,
					games.halle as halle,
					games.heimspiel as heimspiel,
					teams.name as name

				FROM games
				LEFT JOIN
					players ON games.team = players.team
				LEFT JOIN
					persons ON players.person = persons.id
				LEFT JOIN
					teams ON games.team = teams.id
				WHERE
					persons.id = ?
				ORDER BY
					teams.id,
					games.date";
        $sql = $this->pdo->Prepare($sql);
        $sql->Execute(array($personID));
        return $sql;
    }

    public function getMyTeams($personID)
    {
        $sql = "SELECT
					teams.name AS name,
					players.typ AS typ,
					teams.id AS id
				FROM
					teams
				LEFT JOIN
					players ON teams.id = players.team
				LEFT JOIN
					persons ON players.person = persons.id
				WHERE
					persons.id = ?";

        $sql = $this->pdo->Prepare($sql);
        $sql->Execute(array($personID));
        return $sql;
    }


    public function getAddressEntry($where = array(), $orderby = array())
    {
        $whereValues = array();


        $sql = "SELECT
  				persons.id,
  				persons.name,
  				persons.prename,
  				persons.address,
  				persons.plz,
  				persons.ort,
  				persons.email,
  				persons.email_parent,
  				persons.phone,
  				persons.mobile,
  				persons.birthday,
  				persons.gender,
  				persons.schreiber,
  				persons.sms,
  				persons.licence,
  				persons.licence_comment,
  				persons.active,
  				persons.signature,
  				persons.refid,
  				CONCAT('[', GROUP_CONCAT(CONCAT('{\"name\": \"', teams.name , '\",', '\"liga\": \"', teams.liga , '\"}')), ']') as teams,
  				GROUP_CONCAT(CONCAT(teams.liga, ' als ', REPLACE(REPLACE(REPLACE(REPLACE(players.typ,1,'Spieler'),2,'Captain'),3,'Coach'),4,'Sonstige Funktion')) SEPARATOR '<br />\n') as liga
  			FROM
  				persons
  			LEFT JOIN
  				players ON persons.id = players.person
  			LEFT JOIN
  				teams on players.team = teams.id";

        if (count($where) > 0) {
            $sql .= " WHERE ";

            $i = 0;
            foreach ($where as $key => $value) {
                $i++;
                $sql .= $key . " ?";
                $whereValues[] = $value;

                if (count($where) > 1 && $i < count($where)) {
                    $sql .= " AND ";
                }
            }
        }

        $sql .= " GROUP BY persons.id";

        if (count($orderby) > 0) {
            $sql .= " ORDER BY";
            foreach ($orderby as $key => $value) {
                $sql .= " " . $key . " " . $value . ",";
            }
            $sql = substr($sql, 0, -1); // Remove last AND
        }

        if (count($where) > 0) {
            $sql = $this->pdo->Prepare($sql);
            $sql->Execute($whereValues);
        } else {
            $sql = $this->pdo->query($sql);
        }

        return $sql;
    }

    public function getMySchreibers($personID)
    {
        $sql = "SELECT
					games.date AS date,
					teams.name AS name,
					games.gegner AS gegner,
					games.ort AS ort,
					games.halle AS halle
				FROM
					schreiber
				LEFT JOIN
					persons ON schreiber.person = persons.id
				LEFT JOIN
					games ON schreiber.game = games.id
				LEFT JOIN
					teams ON games.team = teams.id
				WHERE
					persons.id = ?";

        $sql = $this->pdo->Prepare($sql);
        $sql->execute(array($personID));
        return $sql;
    }

    public function changePassword($personID, $newPassword)
    {
        $sql = "UPDATE persons SET password = MD5(?) WHERE id = ?";

        $sql = $this->pdo->Prepare($sql);
        $sql->execute(array($newPassword,$personID));
    }

    public function getPersonsWithAccess()
    {
        $sql = "SELECT
					persons.name AS name,
					persons.prename AS prename,
					persons.id AS personID,
					persons.email AS email,
					persons.role AS groupName,
					persons.password AS password
				FROM
					persons
				WHERE
					NOT persons.role LIKE '' AND NOT persons.role LIKE 'guest'
				ORDER BY persons.role";
        $sql = $this->pdo->Prepare($sql);
        $sql->execute();
        return $sql;
    }

    public function createAccess($personID, $group = "guest")
    {
        $sql = "UPDATE
				`" . $this->table . "`
				SET
					role = ?
				WHERE id = ?";

        $sql = $this->pdo->Prepare($sql);
        $sql->Execute(array($group, $personID));
    }

    public function setChanged($personID, $value)
    {
        $sql = "UPDATE
				`" . $this->table . "`
				SET
					changed = ?
				WHERE id = ?";

        $sql = $this->pdo->Prepare($sql);
        $sql->Execute(array($value, $personID));
    }

    public function removeAccess($personID)
    {
        $sql = "UPDATE
				`" . $this->table . "`
				SET
					role = 'guest'
				WHERE id = ?";

        $sql = $this->pdo->Prepare($sql);
        $sql->Execute(array($personID));
    }


    /* Override the update Function to create Notification Messages */
    public function update($where)
    {
        $personID = $where[$this->pk];

        /* Generate Notification befor */
        $personold = new MPerson();
        $personoldData = $personold->getRS(array($personold->pk . " =" => $personID))->fetch();

        parent::update($where);

        /* Generate Notification after */
        $personnew = new MPerson();
        $personnewData = $personnew->getRS(array($personnew->pk . " =" => $personID))->fetch();

        /* Add Notification */
        $notification = Application::getService("ServiceNotification");
        ;
        $notification->addChangeAddressNotification($personoldData, $personnewData);


        // Change Mail Address in Mailman
        $changedMail = false;
        $changedMailParent = false;


        // Send changes to Mailman (if enabled)
        if ($this->config["mailman"]["enable"]) {
            // Case: New Address
            if ($personoldData["email"] == "" && $personnewData["email"] != "" && $personnewData["active"] == 1) {
                $mailman = new MailmanAPI($this->config["mailman"]["baseurl"], $this->config["mailman"]["adminpw"]);
                $mailman->addMembers([$personnewData["email"]]);
                $changed = true;
            }
            if ($personoldData["email_parent"] == "" && $personnewData["email_parent"] != ""  && $personnewData["active"] == 1) {
                $mailman = new MailmanAPI($this->config["mailman"]["baseurl"], $this->config["mailman"]["adminpw"]);
                $mailman->addMembers([$personnewData["email_parent"]]);
                $changedMailParent = true;
            }

            // Case: Remove Address
            if (($personoldData["email"] != "" && $personnewData["email"] == "") ||  $personnewData["active"] == 0) {
                $mailman = new MailmanAPI($this->config["mailman"]["baseurl"], $this->config["mailman"]["adminpw"]);
                $mailman->removeMembers([$personoldData["email"]]);
                $changed = true;
            }
            if (($personoldData["email_parent"] != "" && $personnewData["email_parent"] == "") ||  $personnewData["active"] == 0) {
                $mailman = new MailmanAPI($this->config["mailman"]["baseurl"], $this->config["mailman"]["adminpw"]);
                $mailman->removeMembers([$personoldData["email_parent"]]);
                $changedMailParent = true;
            }

            // Case: Change Address{
            if (!$changedMail && $personoldData["email"] != $personnewData["email"] && $personnewData["active"] == 1) {
                $mailman = new MailmanAPI($this->config["mailman"]["baseurl"], $this->config["mailman"]["adminpw"]);
                $mailman->changeMember($personoldData["email"], $personnewData["email"]);
            }
            if (!$changedMailParent && $personoldData["email_parent"] != $personnewData["email_parent"] && $personnewData["active"] == 1) {
                $mailman = new MailmanAPI($this->config["mailman"]["baseurl"], $this->config["mailman"]["adminpw"]);
                $mailman->changeMember($personoldData["email_parent"], $personnewData["email_parent"]);
            }
        }
    }

    public function insert()
    {
        $personID = parent::insert();

        /* Do not add to Mailman, only after state has changed to active
        $personnew = new MPerson();
        $personnewData = $personnew->getRS(array($personnew->pk . " =" => $personID))->fetch();

        // Insert E-Mails to Mailman
        if ($personnewData["email"] != "") {
            $mailman = new MailmanAPI($this->config["mailman"]["baseurl"],$this->config["mailman"]["adminpw"]);
            $mailman->addMembers([$personnewData["email"]]);
        }

        if ($personnewData["email_parent"] != "") {
            $mailman = new MailmanAPI($this->config["mailman"]["baseurl"],$this->config["mailman"]["adminpw"]);
            $mailman->addMembers([$personnewData["email_parent"]]);
        }
        */

        if ($personID == 0) {
          throw new Exception("Error adding new Person!");
        }

        /* Add Notification */
        $notification = Application::getService("ServiceNotification");
        $notification->addNewAdressNotifcation($personID);
    }

    public function delete($where)
    {
        $person = new MPerson();
        $personRS = $person->getRS(array($person->pk . " =" => $where[$person->pk]));
        $personData = $personRS->fetch();


        // Send changes to Mailman (if enabled)
        if ($this->config["mailman"]["enable"]) {
            if ($personData["email"] != "") {
                $mailman = new MailmanAPI($this->config["mailman"]["baseurl"], $this->config["mailman"]["adminpw"]);
                $mailman->removeMembers([$personData["email"]]);
            }

            if ($personData["email_parent"] != "") {
                $mailman = new MailmanAPI($this->config["mailman"]["baseurl"], $this->config["mailman"]["adminpw"]);
                $mailman->removeMembers([$personData["email_parent"]]);
            }


            $notification = Application::getService("ServiceNotification");
            $notification->addNewNotification(4, "Mailman Update nach dem Löschen einer Person", 0);
        }


        parent::delete($where);
    }

    public function setState($personID, $newState)
    {
        $sql = "UPDATE persons SET active = ? WHERE id = ?";
        $sql = $this->pdo->Prepare($sql);
        $sql->Execute(array($newState, $personID));


        // Send changes to Mailman (if enabled)
        if ($this->config["mailman"]["enable"]) {
            $person = new MPerson();
            $personData = $person->getRS(array($person->pk . " =" => $personID))->fetch();

            $mailman = new MailmanAPI($this->config["mailman"]["baseurl"], $this->config["mailman"]["adminpw"]);

            $mailman->removeMembers([$personData["email"]]);
            $mailman->removeMembers([$personData["email_parent"]]);

            if ($newState == 1) {
                $mailman->addMembers([$personData["email"]]);
                $mailman->addMembers([$personData["email_parent"]]);
            }

            $notification = Application::getService("ServiceNotification");
            $notification->addNewNotification(4, "Mailman Update nach Status Änderung", 0);
        }
    }

    public function setSignature($personID, $newState)
    {

        /* Generate Notification befor */
        $personold = new MPerson();
        $personoldRS = $personold->getRS(array($personold->pk ." =" => $personID));
        $personoldData = $personoldRS->fetch();


        $sql = "UPDATE persons SET signature = ? WHERE id = ?";
        $sql = $this->pdo->Prepare($sql);
        $sql->Execute(array($newState, $personID));

        /* Generate Notification after */
        $personnew = new MPerson();
        $personnewRS = $personnew->getRS(array($personnew->pk ." =" => $personID));
        $personnewData = $personnewRS->fetch();

        /* Add Notification */
        $notification = Application::getService("ServiceNotification");
        $notification->addChangeAddressNotification($personoldData, $personnewData);
    }

    public function getEMailActive()
    {
        $sql = "SELECT persons.email, persons.email_parent FROM persons WHERE persons.active = 1 ";
        $persons = $this->pdo->query($sql)->fetchAll();

        $addresses = array();

        foreach ($persons as $person) {
            if ($person["email"] != "") {
                $addresses[] = $person["email"];
            }

            if ($person["email_parent"] != "") {
                $addresses[] = $person["email_parent"];
            }
        }

        return $addresses;
    }
}
