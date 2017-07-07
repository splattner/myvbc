<?php
// no direct access
defined( '_MYVBC' ) or die( 'Restricted access' );

$config = array();

$config["db"]["server"] = "127.0.0.1";
$config["db"]["username"] = "root";
$config["db"]["password"] = "root";
$config["db"]["database"] = "myvbc";
$config["db"]["url"] = $config["db"]["url"] = "mysql:host=" .  $config["db"]["server"] . ";dbname=" . $config["db"]["database"];

if (getenv('OPENSHIFT_MYSQL_DB_USERNAME') != "") {
	$config["db"]["username"] = getenv('OPENSHIFT_MYSQL_DB_USERNAME');
}
if (getenv('OPENSHIFT_MYSQL_DB_PASSWORD') != "") {
	$config["db"]["password"] = getenv('OPENSHIFT_MYSQL_DB_PASSWORD');
}
if (getenv('OPENSHIFT_MYSQL_DB_URL') != "") {
	$config["db"]["url"] = getenv('OPENSHIFT_MYSQL_DB_URL');
} 

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
