<?php 

abstract class MyDataSource {
	
	public $games;
	public $games_raw;
	
	abstract public function getGamesByTeamID($teamID);
	
	
}




?>