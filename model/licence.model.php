<?php
// no direct access
defined( '_MYVBC' ) or die( 'Restricted access' );

class MLicence extends MyModel {
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