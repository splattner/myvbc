<?php
// no direct access
defined( '_MYVBC' ) or die( 'Restricted access' );

class MArogroup extends MyModel {
	public $table = 'aro_groups';
	
	public function getGroupList() {
		$sql = "SELECT
					*
				FROM 
					" . $this->table . "
				WHERE
					id != 10";
		return $this->db->Execute($sql);
	}
	
	
}

?>