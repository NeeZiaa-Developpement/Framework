<?php

namespace NeeZiaa;

use JetBrains\PhpStorm\NoReturn;
use NeeZiaa\Database\DatabaseException;
use NeeZiaa\Router\Routes;
use NeeZiaa\Utils\Config;

class App {

    private static ?App $_instance = null;
    private Config $settings;
    private ?Routes $route_instance = null;

    /**
     * @return App
     */
    public static function getInstance(): App
    {
        if(is_null(self::$_instance)) self::$_instance = new App(Config::getInstance());
        return self::$_instance;
    }

    public function __construct(Config $config)
    {
        $this->settings = Config::getInstance();
    }

    /**
     * @throws Router\RouterException
     */
    public function getRoutes(): Routes
    {
        if(is_null($this->route_instance)){
            $this->route_instance = new Routes();
            $this->route_instance->routes();
        }
        return dd($this->route_instance);
    }

    /**
     * @throws DatabaseException
     */
    public function getDb(): callable
    {
        $all_drivers = array('pdo_mysql');
        $driver = $this->settings->get('DB_DRIVER');
        if(in_array($driver, $all_drivers))
        {
            return (new $driver.'Database'());
        }
        throw new DatabaseException('Undefined driver');
    }



}