<?php
// no direct access
defined( '_MYVBC' ) or die( 'Restricted access' );

class MTeam extends MyModel {
	public $table = 'teams';
	
	public function getAllMember($teamID) {
		$sql = "Select
					persons.id AS personID,
					persons.name AS name,
					persons.prename AS prename,
					persons.address AS address,
					persons.plz AS plz,
					persons.ort AS ort,
					persons.phone AS phone,
					persons.mobile AS mobile,
					persons.email AS email,
					persons.email_parent AS email_parent,
					persons.schreiber AS schreiber,
					persons.birthday AS birthday,
					players.typ AS typ,
					persons.signature AS signature,
					teams.id AS teamID
				FROM
					persons
				LEFT JOIN
					players ON persons.id = players.person
				LEFT JOIN
					teams ON teams.id = players.team
				WHERE
					teams.id = ?
				ORDER BY
					players.typ ASC, persons.name ASC, persons.prename ASC";
		$sql = $this->db->Prepare($sql);
		return $this->db->Execute($sql, array($teamID));
	}
	
}
?>