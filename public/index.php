<?php

require dirname(__DIR__).'/vendor/autoload.php';

use NeeZiaa\Router\Routes;
use NeeZiaa\App;
$config = new \NeeZiaa\Utils\Config();

if($config->get('DEBUG'))
{
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    define('DEBUG_TIME', microtime(true));
    $whoops = new \Whoops\Run;
    $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
    $whoops->register();
}

$app = (new App($config));
$app->getRoutes();
dd('b');

session_start();

//! Code non exécuté !