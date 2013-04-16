<?php
// no direct access
defined( '_MYVBC' ) or die( 'Restricted access' );

class MPlayer extends MyModel {
	public $table = 'players';
	
	public function updateStatus() {
		
		//Reset All Status
		$sql = "UPDATE persons SET active = 0";
		$this->db->Execute($sql);
		
		//Set new Status
		$sql = "UPDATE persons RIGHT JOIN players ON persons.id = players.person SET active = 1";
		$this->db->Execute($sql);
	}

	public function insert() {

		parent::insert();

		/* Add Notification */
                $notification = MyApplication::getInstance("notification");
                $notification->addNewTeamMemberNotification($this->person, $this->team);



	}


	public function delete($where) {

		parent::delete($where);

		/* Add Notification */
                $notification = MyApplication::getInstance("notification");
                $notification->addRemoveTeamMemberNofitication($this->person, $this->team);



	}
	
	
}
?>
