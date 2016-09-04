<?php

namespace splattner\myvbc\models;
use splattner\framework\Model;

// no direct access
defined( '_MYVBC' ) or die( 'Restricted access' );


class MPerson extends Model {
	public $table = 'persons';

    private $acl_api;


    public function __construct()
    {
        parent::__construct();

        $this->acl_api = new \gacl_api(array("db" => $this->db, "debug" => $this->db->debug));
    }

    public function getMyGames($personID) {
		
		$sql = "SELECT 
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
					games.date";
		$sql = $this->db->Prepare($sql);
		return $this->db->Execute($sql, array($personID));
	}
	
	public function getMyTeams($personID) {
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

		$sql = $this->db->Prepare($sql);
		return $this->db->Execute($sql, array($personID));
	}


	public function getAddressEntry($where = array(), $orderby = array()) {

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
				GROUP_CONCAT(teams.liga SEPARATOR '\n') AS liga
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
            return $this->db->Execute($sql, $whereValues);
        } else {
            return $this->db->Execute($sql);
        }
    }

	public function getMySchreibers($personID) {
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

		$sql = $this->db->Prepare($sql);
		return $this->db->Execute($sql, array($personID));
	}
	
	public function changePassword($personID, $newPassword) {
		$sql = "UPDATE persons SET password = MD5(?) WHERE id = ?";

		$sql = $this->db->Prepare($sql);
		$this->db->Execute($sql, array($newPassword,$personID));
	}
	
	public function getPersonsWithAccess() {
		$sql = "SELECT 
					persons.name AS name,
					persons.prename AS prename,
					persons.id AS personID,
					persons.email AS email,
					aro.id AS aroID,
					aro_groups.name AS groupName,
					persons.password AS password
				FROM
					aro
				LEFT JOIN
					persons ON aro.value = persons.id
				LEFT JOIN
					groups_aro_map ON aro.id = groups_aro_map.aro_id
				LEFT JOIN
					aro_groups ON groups_aro_map.group_id = aro_groups.id
				WHERE
					aro_groups.id != 10
				ORDER BY aro_groups.name";
				
		return $this->db->Execute($sql);
	}
	
	public function createAccess($personID, $groupID = "11") {
		if ($this->acl_api->get_object_id("user", $personID, "ARO") == "") {
			$aroID = $this->acl_api->add_object("user",$personID, $personID, 1, 0, "ARO");
			$this->acl_api->add_group_object($groupID,"user",$personID,"ARO");
		}
	}
	
	public function setChanged($personID, $value) {
		$sql = "UPDATE 
				`" . $this->table . "` 
				SET 
					changed = ?
				WHERE id = ?";

		$this->db->Prepare($sql);
		$this->db->Execute($sql, array($value, $personID));
	}
	
	public function removeAccess($personID) {
		$aroID = $this->acl_api->get_object_id("user",$personID,"ARO");
		$this->acl_api->del_object($aroID, "ARO", true);
	}
	
	
	/* Override the update Function to create Notification Messages */
	public function update($where) {

		$personID = $where[$this->pk];
			
		/* Generate Notification befor */
		$personold = new MPerson();
		$personoldRS = $personold->getRS(array($personold->pk . " =" => $personID));
		$personoldData = $personoldRS->getArray();
		
		parent::update($where);
		
		/* Generate Notification after */
		$personnew = new MPerson();
		$personnewRS = $personnew->getRS(array($personnew->pk . " =" => $personID));
		$personnewData = $personnewRS->getArray();
		
		/* Add Notification */
		$notification = Application::getService("notification");;
		$notification->addChangeAddressNotification($personoldData, $personnewData);
	
	}
	
	public function insert() {
		$personID = parent::insert();
		
		
		/* Add Notification */
		$notification = Application::getService("notification");
		$notification->addNewAdressNotifcation($personID);
		
	}
	
	public function setState($personID, $newState) {
		
		$sql = "UPDATE persons SET active = ? WHERE id = ?";
		$sql = $this->db->Prepare($sql);
		$this->db->Execute($sql, array($newState, $personID));
	}

	public function setSignature($personID, $newState) {

		/* Generate Notification befor */
		$personold = new MPerson();
		$personoldRS = $personold->getRS(array($personold->pk ." =" => $personID));
		$personoldData = $personoldRS->getArray();


		$this->setState($personID,$newState);

		/* Generate Notification after */
		$personnew = new MPerson();
		$personnewRS = $personnew->getRS(array($personnew->pk ." =" => $personID));
		$personnewData = $personnewRS->getArray();

		/* Add Notification */
		$notification = Application::getService("notification");
		$notification->addChangeAddressNotification($personoldData, $personnewData);
	}
}
?>
