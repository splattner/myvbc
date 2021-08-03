<?php
// no direct access
defined( '_MYVBC' ) or die( 'Restricted access' );

$config = array();

$config["mail"]["host"] = $_ENV['MAIL_HOST'] ? $_ENV['MAIL_HOST'] : "localhost";
$config["mail"]["port"] = $_ENV['MAIL_PORT'] ? $_ENV['MAIL_PORT'] : "25";
$config["mail"]["username"] = $_ENV['MAIL_USERNAME'] ? $_ENV['MAIL_USERNAME'] : "";
$config["mail"]["password"] = $_ENV['MAIL_PASSWORD'] ? $_ENV['MAIL_PASSWORD'] : "";
$config["mail"]["from"] = $_ENV['MAIL_FROM'] ? $_ENV['MAIL_FROM'] : "";
$config["mail"]["from_name"] = $_ENV['MAIL_FROM_NAME'] ? $_ENV['MAIL_FROM_NAME'] : "";
$config["mail"]["admin"] = $_ENV['MAIL_ADMIN'] ? $_ENV['MAIL_FROM'] : "";
$config["mail"]["admin_name"] = $_ENV['MAIL_ADMIN_NAME'] ? $_ENV['MAIL_ADMIN_NAME'] : "";


$config["db"]["host"] = $_ENV['MYSQL_DB_HOST'] ? $_ENV['MYSQL_DB_HOST'] : "mysql";
$config["db"]["port"] = $_ENV['MYSQL_DB_PORT'] ? $_ENV['MYSQL_DB_PORT'] : "3306";
$config["db"]["username"] = $_ENV['MYSQL_DB_USERNAME'] ? $_ENV['MYSQL_DB_USERNAME'] : "myvbc";
$config["db"]["password"] = $_ENV['MYSQL_DB_PASSWORD'] ? $_ENV['MYSQL_DB_PASSWORD'] : "myvbc";
$config["db"]["database"] = $_ENV['MYSQL_DB_NAME'] ? $_ENV['MYSQL_DB_NAME'] :  "myvbc";
$config["db"]["url"] = "mysql:host=" .  $config["db"]["host"] . ":" . $config["db"]["port"] . ";dbname=" . $config["db"]["database"];
$config["db"]["version"] = 20210803062630;

$config["template"]["default"] = "default";
$config["template"]["master"] = "master.tpl";

$config["system"]["name"] = "VBC Langenthal - Web Administration";
$config["system"]["debug"] = false;
$config["system"]["dev"] = $_ENV['DEVELOPMENT'] ? $_ENV['DEVELOPMENT'] : "false";



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

$config["aspsms"]["enable"] = $_ENV['ASPSMS_ENABLED'] ? filter_var($_ENV['ASPSMS_ENABLED'], FILTER_VALIDATE_BOOLEAN) : false;
$config["aspsms"]["username"] = $_ENV['ASPSMS_USERNAME'] ? $_ENV['ASPSMS_USERNAME'] : "";
$config["aspsms"]["password"] = $_ENV['ASPSMS_PASSWORD'] ? $_ENV['ASPSMS_PASSWORD'] : "";

$config["mailman"]["enable"] = $_ENV['MAILMAN_ENABLED'] ? filter_var($_ENV['MAILMAN_ENABLED'], FILTER_VALIDATE_BOOLEAN) : false;
$config["mailman"]["baseurl"] = $_ENV['MAILMAN_BASEURL'] ? $_ENV['MAILMAN_BASEURL'] : "";
$config["mailman"]["adminpw"] = $_ENV['MAILMAN_ADMINPW'] ? $_ENV['MAILMAN_ADMINPW'] : "";

$config["smsnotification"]["key"] = $_ENV['SMS_NOTIFICATION_KEY'] ? $_ENV['SMS_NOTIFICATION_KEY'] : "";
$config["smsnotification"]["numberofdays"] = $_ENV['SMS_NOTIFICATION_DAYS'] ? $_ENV['SMS_NOTIFICATION_DAYS'] : "2";
$config["smsnotification"]["enabled"] = $_ENV['SMS_NOTIFICATION_ENABLED'] ? $_ENV['SMS_NOTIFICATION_ENABLED'] : "";

$config["sentry"]["dsn"] = $_ENV['SENTRY_DSN'] ? $_ENV['SENTRY_DSN'] : "";
$config["sentry"]["environment"] = $_ENV['SENTRY_ENVIRONMENT'] ? $_ENV['SENTRY_ENVIRONMENT'] : "dev";

?>
