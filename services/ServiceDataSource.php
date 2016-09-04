<?php

namespace splattner\myvbc\service;
use splattner\framework\Service;

abstract class ServiceDataSource extends Service {
	
	public $games;
	public $games_raw;
	
	abstract public function getGamesByTeamID($teamID);
	
	
}




?>