<?php

namespace splattner\myvbc\models;
use splattner\framework\Model;

// no direct access
defined( '_MYVBC' ) or die( 'Restricted access' );


class MReport extends Model {
	public $table = 'reports';
	
	
	public function getReport($reportID) {
		
		$rs = $this->getRS(array("id =" => $reportID));
		$currentReport = $rs->fetch();
		
		$sql = $currentReport["query"];
		
		return $this->pdo->query($sql);
		
	}
	
	public function getTitle($reportID) {
		$rs = $this->getRS(array("id =" => $reportID));
		$currentReport = $rs->fetch();
		
		return $currentReport["title"];
		
	}
	
	
}
?>