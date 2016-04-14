<?php


if($_SERVER["HTTPS"] != "on") {
   header("HTTP/1.1 301 Moved Permanently");
   header("Location: https://" . $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"]);
   exit();
}

header("Content-Type: text/html; charset=utf-8");

@session_start();

// Set flag that this is a parent file
define( '_MYVBC', 1 );

/**
 * Include 3-Party libs
 */
require_once "libs/adodb5/adodb.inc.php";
require_once "libs/phpgacl-3.3.7/gacl.class.php";
require_once "libs/phpgacl-3.3.7/gacl_api.class.php";
require_once "libs/smarty-3.1.29/libs/Smarty.class.php";
require_once "libs/xajax-0.6-beta1/xajax_core/xajax.inc.php";
require_once "libs/PHPMailer_v5.0.2/class.phpmailer.php";
require_once "libs/sms/SMS.php";

/**
 * Include my libs
 */
require_once "libs/framework/helper.php";
require_once "libs/framework/application.php";
require_once "libs/framework/page.php";
require_once "libs/framework/session.php";
require_once "libs/framework/model.php";
require_once "libs/framework/notification.php";
require_once "libs/framework/plugin.php";


/**
 * Include Configuration file
 */
require_once "etc/confic.inc.php";
MyApplication::setInstance("config", $config);



/**
 * Initialize the Database Connection
 */
$dsn = "mysqli://"
. $config["db"]["username"] . ":" 
. $config["db"]["password"] . "@"
. $config["db"]["server"] . "/"
. $config["db"]["database"];
$db = NewADOConnection($dsn);
$db->debug = $config["system"]["debug"];
$db->EXECUTE("set names 'utf8'");
MyApplication::setInstance("db", $db);

/**
 * Initialize the PHPGACL Object
 */
$acl = new gacl(array("db" => $db, "debug" => $db->debug));
$acl_api = new gacl_api(array("db" => $db, "debug" => $db->debug));
MyApplication::setInstance("acl", $acl);
MyApplication::setInstance("acl_api",$acl_api);

/**
 * Initialize the Smarty Template Engine
 */
$smarty = new Smarty();
$smarty->template_dir = "skins/" . $config["template"]["default"] . "/templates";
$smarty->compile_dir = "skins/" . $config["template"]["default"] . "/templates_c";
$smarty->cache_dir = "tmp/smarty";
$smarty->config_dir = "etc/smarty";
MyApplication::setInstance("smarty", $smarty);


/**
 * SEO Stuff
 */
if (isset($_GET["schreiberplan"])) {
	$_GET["page"] = "report";
	$_GET["action"] = "getReport";
	$_GET["reportID"] = "5";
}

if(isset($_GET["register"])) {
	$_GET["page"] = "auth";
	$_GET["action"] = "createAccess";
}

/**
 * Session Management
 */
$session = new MySession();
MyApplication::setInstance("session",$session);

/**
 * Initialize the XAJAX Object
 */
$xajax = new xajax("index.php?ajax&page=" . $session->currentPage);
$xajax->configure("javascript URI", "libs/xajax-0.6-beta1");
$xajax->configure('debug',$config["system"]["ajaxdebug"]);
MyApplication::setInstance("xajax", $xajax);


/**
 * Initialize the notification Stuff
 */
$notification = new MyNotification();
MyApplication::setInstance("notification",$notification);



MyApplication::createPage();
MyApplication::run();
MyApplication::finish();
?>

