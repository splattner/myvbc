<?php
// no direct access
defined( '_MYVBC' ) or die( 'Restricted access' );

class MPerson extends MyModel {
	public $table = 'persons';
	
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
					persons.id = " . $this->db->qstr($personID) ."
				ORDER BY
					games.date";
		return $this->db->Execute($sql);
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
					persons.id = " . $this->db->qstr($personID);
				
		return $this->db->Execute($sql);
	}


	public function getAddressEntry($where = "", $orderby = "") {
		$sql = "SELECT
				persons.*,
				GROUP_CONCAT(teams.liga SEPARATOR '<br />') AS liga
			FROM
				persons
			LEFT JOIN
				players ON persons.id = players.person
			LEFT JOIN
				teams on players.team = teams.id";
			
		if($where != "") {
                       	$sql .= " WHERE " . $where;
        	}

		$sql .= " GROUP BY persons.id";

        	if($orderby != "") {
                       	$sql .= " ORDER BY " . $orderby;
		}

		return $this->db->Execute($sql);
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
					persons.id = " . $this->db->qstr($personID);
		return $this->db->Execute($sql);
	}
	
	public function changePassword($personID, $newPassword) {
		$sql = "UPDATE persons SET password = MD5('" . $newPassword . "') WHERE id = " . $this->db->qstr($personID);
		$this->db->Execute($sql);
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
					changed = " . $this->db->qstr($value) ."
				WHERE id = " . $this->db->qstr($personID);
		
		$this->db->Execute($sql);
	}
	
	public function removeAccess($personID) {
		$aroID = $this->acl_api->get_object_id("user",$personID,"ARO");
		$this->acl_api->del_object($aroID, "ARO", true);
	}
	
	
	/* Override the update Function to create Notification Messages */
	public function update($where, $personID) {
			
		/* Generate Notification befor */
		$personold = new MPerson();
		$personoldRS = $personold->getRS("id=".$personID);
		$personoldData = $personoldRS->getArray();
		
		parent::update($where);
		
		/* Generate Notification after */
		$personnew = new MPerson();
		$personnewRS = $personnew->getRS("id=" . $personID);
		$personnewData = $personnewRS->getArray();
		
		/* Add Notification */
		$notification = MyApplication::getInstance("notification");
		$notification->addChangeAddressNotification($personoldData, $personnewData);
	
	}
	
	public function insert() {
		$personID = parent::insert();
		
		
		/* Add Notification */
		$notification = MyApplication::getInstance("notification");
		$notification->addNewAdressNotifcation($personID);
		
	}
	
	public function setState($personID, $newState) {
		
		$sql = "UPDATE persons SET active = $newState WHERE id = " . $personID;
		$this->db->Execute($sql);
	}
}
?>
