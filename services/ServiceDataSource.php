<?php

namespace sebastianplattner\myvbc\service;
use sebastianplattner\framework\Service;

abstract class ServiceDataSource extends Service {
	
	public $games;
	public $games_raw;
	
	abstract public function getGamesByTeamID($teamID);
	
	
}




?>