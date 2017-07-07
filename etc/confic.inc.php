<?php
// no direct access
defined( '_MYVBC' ) or die( 'Restricted access' );

$config = array();

$config["db"]["host"] = "127.0.0.1";
$config["db"]["port"] = "8889";
$config["db"]["username"] = "root";
$config["db"]["password"] = "root";
$config["db"]["database"] = "myvbc-new";



if (getenv('MYSQL_DB_HOST') != "") {
	$config["db"]["host"] = getenv('MYSQL_DB_HOST');
}
if (getenv('MYSQL_DB_PORT') != "") {
	$config["db"]["port"] = getenv('MYSQL_DB_PORT');
}
if (getenv('MYSQL_DB_USERNAME') != "") {
	$config["db"]["username"] = getenv('MYSQL_DB_USERNAME');
}
if (getenv('MYSQL_DB_NAME') != "") {
	$config["db"]["database"] = getenv('MYSQL_DB_NAME');
}
if (getenv('MYSQL_DB_PASSWORD') != "") {
	$config["db"]["password"] = getenv('MYSQL_DB_PASSWORD');
}

$config["db"]["url"] = $config["db"]["url"] = "mysql:host=" .  $config["db"]["host"] . ":" . $config["db"]["port"] . ";dbname=" . $config["db"]["database"];


$config["db"]["version"] = 20170629181021;

$config["template"]["default"] = "default";
$config["template"]["master"] = "master.tpl";

$config["system"]["name"] = "VBC Langenthal - Web Administration";
$config["system"]["debug"] = false;


$config["system"]["models-folder"] = "model";
$config["system"]["pages-folder"] = "pages";
$config["system"]["api-folder"] = "api";
$config["system"]["plugin-folder"] = "plugins";
$config["system"]["service-folder"] = "services";
$config["system"]["skins-folder"] = "skins";

$config["system"]["namespace"] = "splattner\\myvbc";
$config["system"]["customPageClass"] = "MyVBCPage";

$acl = new \gburtini\ACL\ACL();
$acl->addRole("guest");
$acl->addRole("registered", ["guest"]);
$acl->addRole("manager", ["registered"]);
$acl->addRole("vorstand", ["manager"]);
$acl->addRole("administrator", ["vorstand"]);
$config["system"]["acl"] = $acl;


$config["aspsms"]["username"] = "";
$config["aspsms"]["password"] = "";


?>
