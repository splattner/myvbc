<?php
// no direct access
defined( '_MYVBC' ) or die( 'Restricted access' );

MyModel::loadModel("person");

class MGame extends MyModel {
	public $table = 'games';
	
	public function getValidSchreiber($gameID) {
		
		$schreiber = array();
		
		$game = new MGame();
		$rs_game = $game->getRS("id=" . $this->db->qstr($gameID));
		$arr_game = $rs_game->getArray(); //All Datas for the current Game
		$currentTeam = $arr_game[0]["team"]; // The team for the current Game
		
		$sql = "SELECT
					*
				FROM
					persons
				WHERE
					persons.schreiber = 1
					AND persons.active = 1
				ORDER BY
					persons.name, persons.prename";
		$rs = $this->db->Execute($sql); //RS of all Persons who are allowed to write
		


		$person = new MPerson;
		
		while($row = $rs->fetchRow()) {

			
			$rs_teams = $person->getMyTeams($row["id"]);
			$arr_teams = $rs_teams->getArray();

			$personTeams = array();
			foreach ($arr_teams as $arr_team) {
				$personTeams[] = $arr_team["id"];
			}

			
			if(!in_array($currentTeam,$personTeams)) {	
				$schreiber[] = $row;
			}			
		}
		return $schreiber;
	}
	
	public function getSchreiber($gameID) {
		
		$sql = "
				SELECT
					persons.id as id,
					persons.prename as prename,
					persons.name as name
				FROM
					schreiber
				LEFT JOIN
					persons ON schreiber.person = persons.id
				LEFT JOIN 
					games ON schreiber.game = games.id
				WHERE
					games.id = " . $this->db->qstr($gameID);
		return $this->db->Execute($sql);
	}
	
	public function getGamesFromPersonOnDate($personID, $date) {
		
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
					AND games.date like '" . $date . "%'
				ORDER BY
					games.date";
		return $this->db->Execute($sql);
	}

	public function clearGames() {
		$sql = "DELETE FROM games";


		$this->db->Execute($sql);
		
	}
	
}
?>
