<?php
// no direct access
defined( '_MYVBC' ) or die( 'Restricted access' );

$config = array();


$config["db"]["host"] = getenv('MYSQL_DB_HOST') ? getenv('MYSQL_DB_HOST') : "127.0.0.1";
$config["db"]["port"] = getenv('MYSQL_DB_PORT') ? getenv('MYSQL_DB_PORT') : "3306";
$config["db"]["username"] = getenv('MYSQL_DB_USERNAME') ? getenv('MYSQL_DB_USERNAME') : "myvbc";
$config["db"]["password"] = getenv('MYSQL_DB_PASSWORD') ? getenv('MYSQL_DB_PASSWORD') : "myvbc";
$config["db"]["database"] = getenv('MYSQL_DB_NAME') ? getenv('MYSQL_DB_NAME') :  "myvbc";



$config["db"]["url"] = "mysql:host=" .  $config["db"]["host"] . ":" . $config["db"]["port"] . ";dbname=" . $config["db"]["database"];


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

$config["mailman"]["baseurl"] = "";
$config["mailman"]["adminpw"] = "";


?>
