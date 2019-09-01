<?php


namespace splattner\myvbc;

use splattner\framework\Application;

header("Content-Type: text/html; charset=utf-8");

@session_start();

// Set flag that this is a parent file
define('_MYVBC', 1);


/**
 * Composer
 */
require __DIR__ . '/vendor/autoload.php';


// Load Environment from .env File
$dotenv = new \Dotenv\Dotenv(__DIR__);
$dotenv->safeLoad();

/**
 * Include Configuration file
 */
require_once "etc/confic.inc.php";

$composerJSON = json_decode(file_get_contents('composer.json'), true);


if ($config["system"]["dev"]) {
  $release = $composerJSON["version"] . "-dev";
} else {
  $release = $composerJSON["version"];
}

\Sentry\init([
  'dsn' => $config["sentry"]["dsn"],
  'environment' => $config["sentry"]["environment"],
  'release' => $release

 ]);


Application::init($config);


Application::createPage();
Application::run();
Application::finish();
