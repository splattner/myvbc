<?php

namespace sebastianplattner\myvbc\models;
use sebastianplattner\framework\Model;

// no direct access
defined( '_MYVBC' ) or die( 'Restricted access' );


class MKey extends Model {
    public $table = 'accesskeys';



    public function getAllKeys() {

        $sql = "SELECT
					accesskeys.id AS id,
					accesskeys.label AS label,
					accesskeys.nr as nr,
					CONCAT(persons.prename, ' ', persons.name) AS person,
					accesskeys.lastUpdate as lastUpdate
				FROM
				    accesskeys
				LEFT JOIN
					persons ON accesskeys.person = persons.id
                ORDER BY
                  persons.name,
                  persons.prename";

        return $this->db->Execute($sql);
    }

	public function getMyKeys($personID) {
		$sql = "SELECT
					accesskeys.id AS id,
					accesskeys.label AS label,
					accesskeys.nr as nr,
					CONCAT(persons.prename, ' ', persons.name) AS person,
					accesskeys.lastUpdate as lastUpdate
				FROM
				    accesskeys
				LEFT JOIN
					persons ON accesskeys.person = persons.id
				WHERE
                	person = ?
                ORDER BY
                  persons.name,
                  persons.prename";

        $sql = $this->db->Prepare($sql);
		return $this->db->Execute($sql, array($personID));

	}


}

?>