<?php

namespace sebastianplattner\myvbc;
use sebastianplattner\framework\Application;


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
 * Include Configuration file
 */
require_once "etc/confic.inc.php";


/**
 * Composer
 */
require __DIR__ . '/vendor/autoload.php';

/**
 * Include 3-Party libs
 */
require_once "libs/phpgacl-3.3.7/gacl.class.php";
require_once "libs/phpgacl-3.3.7/gacl_api.class.php";


/**
 * Init Application
 */
require "libs/framework/application.php";
Application::init($config);


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


Application::createPage();
Application::run();
Application::finish();
?>

