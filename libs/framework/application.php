<?php


class MyApplication {
	
	static private $instances = array();
	
	static public function getInstance($className) {
		if (!isset(self::$instances[$className])) {
			self::$instances[$className] = new $className();
		}
		return self::$instances[$className];
	}
	
	static public function setInstance($className, $object){
		self::$instances[$className] = $object;
	} 
	
	static public function createPage() {
		$session = MyApplication::getInstance("session");
		
		include_once "pages/" . $session->currentPage . ".page.php";
		$pageClass = "Page" . $session->currentPage;
		
		$page =  new $pageClass();
		MyApplication::setInstance("page", $page);
	}
	
	static public function run() {
		$page = MyApplication::getInstance("page");
		
		$page->init();
		$page->work();
		$page->render();
	}
	
	static public function finish() {
		$session = MyApplication::getInstance("session");
		
		unset($session);
	}
	
}
?>