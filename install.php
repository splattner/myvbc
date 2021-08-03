<?php

define('_MYVBC', 1);


/**
 * Composer
 */
require __DIR__ . '/vendor/autoload.php';

// Load Environment from .env File
$dotenv = \Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();

/**
 * Include Configuration file
 */
require_once "etc/confic.inc.php";


/**
 * Check DB Version and initialize&seed if necessar
 */

echo "Check if Database upgrade is needed...";


$pdo = new \PDO($config["db"]["url"], $config["db"]["username"], $config["db"]["password"]);
$pdo->query("set names 'utf8'");


$phinxApp = new \Phinx\Console\PhinxApplication();
$phinxTextWrapper = new \Phinx\Wrapper\TextWrapper($phinxApp);

// Check if migration needed
$res = $pdo->query("SHOW TABLES LIKE 'phinxlog';");

$phinxlog_notAvailable = $res->rowCount() != 1;
$sql = "SELECT version from phinxlog WHERE version = " . $config["db"]["version"];
$version_query = $pdo->query($sql);

if ($phinxlog_notAvailable || $version_query->rowCount() == 0) {
    echo "needed\n";
    echo "Installing new database...";
    $phinxTextWrapper->getMigrate();
    echo "done\n";
} else {
    echo "not needed\n";
}

// Check if initial Data seeding is needed
$query = $pdo->query("SELECT * FROM config WHERE `key` = 'initialSeed'");
if ($query->rowCount() == 0 || $query->fetch()["value"] == "false") {
    echo "Importing initial database...";
    $phinxTextWrapper->getSeed();
    echo "done\n";
}

echo "Installing Database done\n";
