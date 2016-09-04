<?php

namespace sebastianplattner\framework;

use sebastianplattner\myvbc\models\MNotification;


abstract class Page {

	/**
	 * Contains all global config options defindet in /etc/confic.inc.php
	 * @access public
	 * @var mixed
	 */
	public $config;

	/**
	 * Manage the db connection
	 * @access public
	 * @var mixed
	 */
	public $db;

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


	/**
	 * Provides the Smarty Functions
	 * @access public
	 * @var mixed
	 */
	public $smarty;

	/**
	 * Template Name
	 * @access public
	 * @var string
	 */
	public $template;

	/**
	 * The Current Template Dir
	 * @access public
	 * @var string
	 */
	public $templateDir;
	

	/**
	 * Current Action
	 * @access public
	 * @var string
	 */
	public $action;

	/**
	 * Current Page Name
	 * @access public
	 * @var string
	 */
	public $pagename;

	/**
	 * Add some customer JavaScript Code for this Page
	 * @access public
	 * @var string
	 */
	public $envJavaScript;

	
	/**
	 * All Actions defindet in this array don't need acl check!
	 * @access public
	 * @var mixed
	 */
	public $noACL;


	/**
	 * All Plugins loaded for this Page
	 * @access public
	 * @var mixed
	 */
	public $plugins;


    /**
	 * Constructor for the MyPage Class
	 * @param mixed $config
	 * @param mixed $db
	 * @param mixed $session
	 * @param mixed $acl
	 * @param mixed $acl_api
	 * @param mixed $smarty
	 */
	public function __construct() {
		$this->config = Application::getConfig();
		$this->db = Application::getInstance("db");
		$this->session = Application::getInstance("session");
		$this->acl = Application::getInstance("acl");
		$this->smarty = Application::getInstance("smarty");
		
		/**
		 * Set templatedir var
		 */
		$this->templateDir = $this->config["system"]["skins-folder"] . "/" . $this->config["template"]["default"];
		
		/**
		 * Initialize noACL Array
		 */
		$this->noACL = array();


		/**
		 * Get the Action from $_GET, default is main
		 */
		if(isset($_GET["action"])) {
			$this->action = $_GET["action"];
		} else {
			$this->action = "main";
		}

		/**
		 * Init Plugin Array
		 */
		$this->plugins = array();
	}


	
	/**
	 * This is the main action and has to be defined
	 */
	abstract public function mainAction();


	/**
	 * Additional init Funktions can be placed here
	 */
	public function init() {

		// TODO: Should be done in a other way! This is too static
		$this->smarty->assign("canOrder", $this->acl->acl_check("order", "main", "user", $this->session->uid));
		$this->smarty->assign("canAddress", $this->acl->acl_check("address", "main", "user", $this->session->uid));
		$this->smarty->assign("canTeam", $this->acl->acl_check("team", "main", "user", $this->session->uid));
		$this->smarty->assign("canGames", $this->acl->acl_check("games", "main", "user", $this->session->uid));
		$this->smarty->assign("canAdmin", $this->acl->acl_check("admin", "main", "user", $this->session->uid));
		$this->smarty->assign("canReport", $this->acl->acl_check("report", "main", "user", $this->session->uid));
		$this->smarty->assign("canNotification", $this->acl->acl_check("notification", "main", "user", $this->session->uid));
		$this->smarty->assign("canKey", $this->acl->acl_check("key", "main", "user", $this->session->uid));



	}
	
	/**
	 * This is a cleanup Function. When the page gets without a action, this Function is called
	 */
	public function cleanup() {
		
		
	}
	
	
	/**
	 * Calls the corresponding Action Handler, and check ACL
	 * Continue until no more action is required
	 */
	public function work() {

        $actionFunction  = $this->action;
        while ($actionFunction != NULL) {
            if(isset($this->noACL[$actionFunction]) || $this->acl->acl_check($this->pagename, $actionFunction, 'user', $this->session->uid)) {
                $actionFunction .= "Action";
                $actionFunction = $this->$actionFunction();
            } else {
                $actionFunction = $this->notAllowed();
            }
        }

	}

	/**
	 * Set a new Template
	 */
	public function setTemplate($templateName) {
		$this->template = $templateName;
		$this->smarty->assign("content", $this->template);
	}

	/**
	 * Show a custom not Authorized Message
	 */
	protected function notAllowed() {
		$this->setTemplate("auth/notAuthorized.tpl");
		$this->smarty->assign("msg", "Sie sind nicht berechtigt, diese Funktion auszuf&uuml;hren");
	}
	
	
	/**
	 * Render the master Page
	 */
	public function render() {

        $this->envJavaScript .=
            "
            <script type=\"text/javascript\">
                var uid = " . $this->session->uid . "
            </script>
            ";


		
		$this->smarty->assign("isAuth", $this->session->isAuth);
		$this->smarty->assign("siteTitle", $this->config["system"]["name"]);
		$this->smarty->assign("currentPage", $this->pagename);
		$this->smarty->assign("currentAction", $this->action);
		$this->smarty->assign("templateDir", $this->templateDir);
        $this->smarty->assign("env_javascript", $this->envJavaScript);
		$this->smarty->assign("share", $this->session->share);
		$this->smarty->assign("plugins", $this->plugins);
		$this->smarty->assign("uid", $this->session->uid);


        $notification = new MNotification();
        $rs = $notification->getNotificationStatus($this->session->uid);
        $this->smarty->assign("numOfNotification", $rs->RecordCount());

        $this->smarty->display("master.tpl");

	}
	
}

?>
