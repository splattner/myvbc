<?php

class MyModel {
	
	public $table;
	
	public $fields;

	protected $db;
	protected $session;
	protected $acl;
	protected $acl_api;
	
	public function __construct() {
		$this->db = MyApplication::getInstance("db");
		$this->session = MyApplication::getInstance("session");
		$this->acl = MyApplication::getInstance("acl");
		$this->acl_api = MyApplication::getInstance("acl_api");
		$this->fields = array();
		
	}

	public static function loadModel($modelName) {

		require_once "model/" . $modelName . ".model.php";

	}
	
	public function update($where) {
		
		$sql = "UPDATE `" . $this->table . "` SET ";
		
		foreach($this->fields as $key => $value)
		{
			$sql .= $key . " = " . $this->db->qstr($value) .", ";
		}
			
		$sql = substr($sql, 0, -2); // Remove last ","
		$sql .= " WHERE " . $where;
		$this->db->Execute($sql);
	
	}
	
	public function insert() {
		
		$sql = "INSERT INTO `" . $this->table . "` (";
		
		foreach($this->fields as $key => $value)
		{
			$sql .= $key . ", ";
		}
		$sql = substr($sql, 0, -2); // Remove last ","
		$sql .= ") VALUES (";
		
		foreach($this->fields as $key => $value)
		{
			$sql .= $this->db->qstr($value) . ", ";
		}
		$sql = substr($sql, 0, -2); // Remove last ","
		$sql  .= ")";
							
		$this->db->Execute($sql);
		
		return $this->db->Insert_ID();
	}
	
	public function getRS($where = "", $orderby = "") {
		$sql = "SELECT * FROM `" . $this->table . "`";
		
		
		
		if($where != "") {
			$sql .= " WHERE " . $where;
		}
		
		if($orderby != "") {
			$sql .= " ORDER BY " . $orderby;
		}
		
		return $this->db->Execute($sql);
	}
	
	public function delete($id) {
		$this->db->Execute("DELETE FROM `" . $this->table . "` WHERE " . $id);
	}
	
	public function __get($name) {
		return $this->fields[$name];
	}
	
	public function __set($name, $value) {
		$this->fields[$name] = $value;
	}
}
?>
