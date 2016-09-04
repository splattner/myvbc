<?php

namespace sebastianplattner\myvbc\models;
use sebastianplattner\framework\Model;


// no direct access
defined( '_MYVBC' ) or die( 'Restricted access' );

class MSchreiber extends Model {
	public $table = 'schreiber';
	
	public function addSchreiber($schreiberID, $gameID) {
		
		if ($schreiberID > 0) {
			
			//Check if there is already a Entry
			$sql_check = "SELECT 
							* 
						FROM 
							schreiber 
						WHERE 
							game = ? AND
							person = ?";

			$sql_check = $this->db->Prepare($sql_check);
			$rs = $this->db->Execute($sql_check, array($gameID, $schreiberID));
			
			if ($rs->RecordCount() == 0) {
				$sql = "INSERT INTO schreiber (game, person) 
					VALUES(?,?)
				";

				$sql = $this->db->Prepare($sql);
				$this->db->Execute($sql, array($gameID, $schreiberID));
			}
		}
	}
	
	public function removeSchreiber($schreiberID, $gameID) {
		$sql = "DELETE FROM 
					schreiber 
				WHERE 
				game = ? AND person = ?";
		$sql = $this->db->Prepare($sql);
		$this->db->Execute($sql, array($gameID, $schreiberID));
	}
	
	public function getSchreiberProposal($gameID) {
		
		$mgame = new MGame();
		$rs_game = $mgame->getRS(array($mgame->pk ." =" =>$gameID));
		$game = $rs_game->getArray();
		
		list($datum, $zeit) = explode(" ", $game[0]["date"]);

        $datum = $datum . "%";
		
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
					games.date LIKE ?
					AND NOT games.date = ?
					AND games.heimspiel = 1
					AND persons.schreiber = 1
					AND persons.active = 1
					AND persons.refid = 0
				GROUP BY
					persons.id
				ORDER BY
					anzahl
				";
		$sql = $this->db->Prepare($sql);
		return $this->db->Execute($sql, array($datum, $game[0]["date"]));
	}
	
}
?>
