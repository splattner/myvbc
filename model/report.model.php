<?php

namespace splattner\myvbc\models;
use splattner\framework\Model;

// no direct access
defined( '_MYVBC' ) or die( 'Restricted access' );


class MReport extends Model {
	public $table = 'reports';
	
	
	public function getReport($reportID) {
		
		$rs = $this->getRS(array("id =" => $reportID));
		$currentReport = $rs->getArray();
		
		$sql = $currentReport[0]["query"];
		
		return $this->db->Execute($sql);
		
	}
	
	public function getTitle($reportID) {
		$rs = $this->getRS(array("id =" => $reportID));
		$currentReport = $rs->getArray();
		
		return $currentReport[0]["title"];
		
	}
	
	
}
?>