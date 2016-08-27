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

        $session = MyApplication::getInstance("session");

		/**
		 * Check if this is an API Call
		 */
		$request = explode('/', trim($_SERVER['PATH_INFO'],'/'));
		$isAPICall = ($request[0] == "api");
        $basicAuth = false;

		if ($isAPICall) {

            if ($session->isAuth || isset($_SERVER['PHP_AUTH_USER'])) {

                if (isset($_SERVER['PHP_AUTH_USER'])) {

                    $basicAuth = true;

                    $email = $_SERVER['PHP_AUTH_USER'];
                    $password = $_SERVER['PHP_AUTH_PW'];

                    if (!$session->auth($email, $password)) {
                        http_response_code(401);
						return;
                    }

                }

                $api = MyApplication::getInstance("API");
                $api->call();

                if ($basicAuth) {
                    $session->closeMySession();
                }
            } else {
                http_response_code(403);
                return;
            }

		} else {
			$page = MyApplication::getInstance("page");

			$page->init();
			$page->work();
			$page->render();

		}


	}
	
	static public function finish() {
		$session = MyApplication::getInstance("session");
		
		unset($session);
	}
	
}
?>