<?php

abstract class MyPlugin {


	/**
	 * Provides the Smarty Functions
	 * @access public
	 * @var mixed
	 */
	public $smarty;

	/**
	 * Notification Object
	 * @access public
	 * @var mixes
	 */
	public $notification;

	/**
	 * Manage the db connection
	 * @access public
	 * @var mixed
	 */
	public $db;

	/**
	 * Page Object
	 * @access public
	 * @var mixes
	 */
	public $page;

	/**
	 * The Session object to manage all Session related stuff
	 * @access public
	 * @var mixed
	 */
	public $session;

	/**
	 * Provides the PHPGACL Functions
	 * @access public
	 * @var mixed
	 */
	public $acl;

	
	/*
	 * Contains the HTLM Skin File for this Plugin
	 */
	public $contentFile;

	/*
	 * Structure to Passing Datas
	 */
	protected $data;


	static public function loadPlugin($pluginName) {

		require_once "plugins/" . $pluginName . ".plugin.php";

	}

	public function setData($data) {
		$this->data = $data;
	}

	private function registerPlugin($registerAs) {
		$this->page->plugins[$registerAs] = $this;
	}

	public function __construct($registerAs) {

		$this->page = MyApplication::getInstance("page");
		$this->smarty = MyApplication::getInstance("smarty");
		$this->session = MyApplication::getInstance("session");
		$this->db = MyApplication::getInstance("db");
		$this->notification = MyApplication::getInstance("notification");
		$this->acl = MyApplication::getInstance("acl");

		$this->registerPlugin($registerAs);
		
	}


	abstract public function run($action);

	public function __toString() {
		return $this->smarty->fetch($this->contentFile);
	}



}

?>
