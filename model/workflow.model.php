<?php
// no direct access
defined( '_MYVBC' ) or die( 'Restricted access' );

class MWorkflow extends MyModel {
	public $table = 'workflowtype';
	
	
	public function getAllWorkflows() {
		
		$sql = "SELECT
					persons.prename AS prename,
					persons.name AS name,
					workflowtype.name AS type,
					creator.prename as creatorPrename,
					creator.name AS creatorName,
					workflow.date AS date,
					workflow.state AS state
				FROM
					workflow
				LEFT JOIN
					persons ON workflow.person = persons.id
				LEFT JOIN
					persons AS creator ON workflow.creator = creator.id
				LEFT JOIN
					workflowtype ON workflowtype.id = workflow.type";
		
		return $this->db->Execute($sql);
		
	}
	
	
	
}
?>