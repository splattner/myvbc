<?php

namespace sebastianplattner\myvbc\models;
use sebastianplattner\framework\Model;

// no direct access
defined( '_MYVBC' ) or die( 'Restricted access' );


class MLicence extends Model {
	public $table = 'licences';
	
	public function getLicenceList() {
		$sql = "SELECT
					*
				FROM 
					" . $this->table . "
				ORDER BY
					typ";
		return $this->db->Execute($sql);
	}
	
}

?>