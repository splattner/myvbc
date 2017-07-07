<?php

namespace splattner\myvbc;
use splattner\framework\Application;

/*
if($_SERVER["HTTPS"] != "on") {
   header("HTTP/1.1 301 Moved Permanently");
   header("Location: https://" . $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"]);
   exit();
}
*/


header("Content-Type: text/html; charset=utf-8");

@session_start();

// Set flag that this is a parent file
define( '_MYVBC', 1 );




/**
 * Composer
 */
require __DIR__ . '/vendor/autoload.php';

/**
 * Include Configuration file
 */
require_once "etc/confic.inc.php";


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

