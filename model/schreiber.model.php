<?php

// no direct access
defined( '_MYVBC' ) or die( 'Restricted access' );

require_once('model/game.model.php');

class MSchreiber extends MyModel {
	public $table = 'schreiber';
	
	public function addSchreiber($schreiberID, $gameID) {
		
		if ($schreiberID > 0) {
			
			//Check if there is already a Entry
			$sql_check = "SELECT 
							* 
						FROM 
							schreiber 
						WHERE 
							game = " . $this->db->qstr($gameID) . " AND
							person = " . $this->db->qstr($schreiberID);
			
			$rs = $this->db->Execute($sql_check);
			
			if ($rs->RecordCount() == 0) {
				$sql = "INSERT INTO schreiber (game, person) 
					VALUES(" . $this->db->qstr($gameID) . "," . $this->db->qstr($schreiberID) .")
				";
				
				$this->db->Execute($sql);
			}
		}
	}
	
	public function removeSchreiber($schreiberID, $gameID) {
		$sql = "DELETE FROM 
					schreiber 
				WHERE 
				game = " . $this->db->qstr($gameID) . " AND person = " . $this->db->qstr($schreiberID);
		$this->db->Execute($sql);
	}
	
	public function getSchreiberProposal($gameID) {
		
		$mgame = new MGame();
		$rs_game = $mgame->getRS("id=" . $this->db->qstr($gameID));
		$game = $rs_game->getArray();
		
		list($datum, $zeit) = explode(" ", $game[0]["date"]);
		
		$sql = "SELECT 
					persons.name AS name,
					persons.prename AS prename,
					games.ort AS ort,
					games.halle AS halle,
					games.date AS date,
					COUNT(schreiber.person) AS anzahl
				FROM
  					games
				INNER JOIN
  					teams ON games.team = teams.id
				INNER JOIN
  					players ON teams.id = players.team
				INNER JOIN
 					persons ON players.person = persons.id
 				LEFT JOIN
 					schreiber ON persons.id = schreiber.person
				WHERE
					games.date LIKE '" . $datum . "%'
					AND NOT games.date = '" . $game[0]["date"] . "'
					AND games.heimspiel = 1
					AND persons.schreiber = 1
					AND persons.active = 1
					AND persons.refid = 0
				GROUP BY
					persons.id
				ORDER BY
					anzahl
				";
		return $this->db->Execute($sql);
	}
	
}
?>
