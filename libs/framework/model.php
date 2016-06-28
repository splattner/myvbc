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
        $values = array();

		foreach($this->fields as $key => $value)
		{
			$sql .= $key . " = ?, ";
            $values[] =  $value;

		}
			
		$sql = substr($sql, 0, -2); // Remove last ","
		$sql .= " WHERE " . $where;

        $sql = $this->db->Prepare($sql);
		$this->db->Execute($sql, $values);
	
	}
	
	public function insert() {
		
		$sql = "INSERT INTO `" . $this->table . "` (";
        $values = array();
		
		foreach($this->fields as $key => $value)
		{
			$sql .= $key . ", ";
		}
		$sql = substr($sql, 0, -2); // Remove last ","
		$sql .= ") VALUES (";
		
		foreach($this->fields as $key => $value)
		{
			$sql .= "? , ";
            $values[] =  $value;
		}
		$sql = substr($sql, 0, -2); // Remove last ","
		$sql  .= ")";

        $sql = $this->db->Prepare($sql);
		$this->db->Execute($sql, $values);
		
		return $this->db->Insert_ID();
	}
	
	public function getRS($where = "", $orderby = "") {
		$sql = "SELECT * FROM `" . $this->table . "`";
		
		
		
		if($where != "") {
			$sql .= " WHERE " . $where;
            //$sql .= " WHERE ? ";
		}
		
		if($orderby != "") {
			$sql .= " ORDER BY " . $orderby;
            //$sql .= " ORDER BY ? ";
		}
/*
        $sql = $this->db->Prepare($sql);

        //print_r($sql);

        if($where != "" && $orderby != "") {
            return $this->db->Execute($sql, array($where, $orderby));
        } else if($where != "") {
            return $this->db->Execute($sql, array($where));
        } else if($orderby != "") {
            return $this->db->Execute($sql, array($orderby));
        } else {*/
            return $this->db->Execute($sql);
        /*}*/

	}
	
	public function delete($id) {

        $sql = $this->db->Prepare("DELETE FROM `" . $this->table . "` WHERE ?");

		$this->db->Execute($sql, array($id));
	}
	
	public function __get($name) {
		return $this->fields[$name];
	}
	
	public function __set($name, $value) {
		$this->fields[$name] = $value;
	}
}
?>
