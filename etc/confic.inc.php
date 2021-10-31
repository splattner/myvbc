<?php
// no direct access
defined( '_MYVBC' ) or die( 'Restricted access' );

$config = array();

$config["mail"]["host"] = array_key_exists("MAIL_HOST", $_ENV) ? $_ENV['MAIL_HOST'] : "localhost";
$config["mail"]["port"] = array_key_exists("MAIL_PORT", $_ENV) ? $_ENV['MAIL_PORT'] : "25";
$config["mail"]["username"] = array_key_exists("MAIL_USERNAME", $_ENV) ? $_ENV['MAIL_USERNAME'] : "";
$config["mail"]["password"] = array_key_exists("MAIL_PASSWORD", $_ENV) ? $_ENV['MAIL_PASSWORD'] : "";
$config["mail"]["from"] = array_key_exists("MAIL_FROM", $_ENV) ? $_ENV['MAIL_FROM'] : "";
$config["mail"]["from_name"] = array_key_exists("MAIL_FROM_NAME", $_ENV) ? $_ENV['MAIL_FROM_NAME'] : "";
$config["mail"]["admin"] = array_key_exists("MAIL_ADMIN", $_ENV) ? $_ENV['MAIL_FROM'] : "";
$config["mail"]["admin_name"] = array_key_exists("MAIL_ADMIN_NAME", $_ENV) ? $_ENV['MAIL_ADMIN_NAME'] : "";


$config["db"]["host"] = array_key_exists("MYSQL_DB_HOST", $_ENV) ? $_ENV['MYSQL_DB_HOST'] : "mysql";
$config["db"]["port"] = array_key_exists("MYSQL_DB_PORT", $_ENV) ? $_ENV['MYSQL_DB_PORT'] : "3306";
$config["db"]["username"] = array_key_exists("MYSQL_DB_USERNAME", $_ENV) ? $_ENV['MYSQL_DB_USERNAME'] : "myvbc";
$config["db"]["password"] = array_key_exists("MYSQL_DB_PASSWORD", $_ENV) ? $_ENV['MYSQL_DB_PASSWORD'] : "myvbc";
$config["db"]["database"] = array_key_exists("MYSQL_DB_NAME", $_ENV) ? $_ENV['MYSQL_DB_NAME'] :  "myvbc";
$config["db"]["url"] = "mysql:host=" .  $config["db"]["host"] . ":" . $config["db"]["port"] . ";dbname=" . $config["db"]["database"];
$config["db"]["version"] = 20210803062630;

$config["template"]["default"] = "default";
$config["template"]["master"] = "master.tpl";

$config["system"]["name"] = "VBC Langenthal - Web Administration";
$config["system"]["debug"] = false;
$config["system"]["dev"] = array_key_exists("DEVELOPMENT", $_ENV) ? $_ENV['DEVELOPMENT'] : "false";



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

$config["aspsms"]["enable"] = array_key_exists("ASPSMS_ENABLED", $_ENV) ? filter_var($_ENV['ASPSMS_ENABLED'], FILTER_VALIDATE_BOOLEAN) : false;
$config["aspsms"]["username"] = array_key_exists("ASPSMS_USERNAME", $_ENV) ? $_ENV['ASPSMS_USERNAME'] : "";
$config["aspsms"]["password"] = array_key_exists("ASPSMS_PASSWORD", $_ENV) ? $_ENV['ASPSMS_PASSWORD'] : "";

$config["mailman"]["enable"] = array_key_exists("MAILMAN_ENABLED", $_ENV) ? filter_var($_ENV['MAILMAN_ENABLED'], FILTER_VALIDATE_BOOLEAN) : false;
$config["mailman"]["baseurl"] = array_key_exists("MAILMAN_BASEURL", $_ENV) ? $_ENV['MAILMAN_BASEURL'] : "";
$config["mailman"]["adminpw"] = array_key_exists("MAILMAN_ADMINPW", $_ENV) ? $_ENV['MAILMAN_ADMINPW'] : "";

$config["smsnotification"]["key"] = array_key_exists("SMS_NOTIFICATION_KEY", $_ENV) ? $_ENV['SMS_NOTIFICATION_KEY'] : "";
$config["smsnotification"]["numberofdays"] = array_key_exists("SMS_NOTIFICATION_DAYS", $_ENV) ? $_ENV['SMS_NOTIFICATION_DAYS'] : "2";
$config["smsnotification"]["enabled"] = array_key_exists("SMS_NOTIFICATION_ENABLED", $_ENV) ? $_ENV['SMS_NOTIFICATION_ENABLED'] : "";

$config["sentry"]["dsn"] = array_key_exists("SENTRY_DSN", $_ENV) ? $_ENV['SENTRY_DSN'] : "";
$config["sentry"]["environment"] = array_key_exists("SENTRY_ENVIRONMENT", $_ENV) ? $_ENV['SENTRY_ENVIRONMENT'] : "dev";

?>
