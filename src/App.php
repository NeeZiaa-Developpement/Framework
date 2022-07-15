<?php

namespace NeeZiaa;

use NeeZiaa\Database\DatabaseException;
use NeeZiaa\Database\Mysql\MysqlDatabase;
use NeeZiaa\Router\Routes;
use NeeZiaa\Utils\Config;

class App {

    private static ?App $_instance = null;
    private ?Config $settings;
    private ?Routes $route_instance = null;
    private mixed $db = null;

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
        return $this->route_instance;
    }

    /**
     * @throws DatabaseException
     */
    public function getDb()
    {
        if(is_null($this->db)) {
            $settings = $this->settings->get_all();
            $all_drivers = array('mysql');
            $driver = $this->settings->get('DB_DRIVER');
            if(in_array($driver, $all_drivers))
            {
                $drivername = 'NeeZiaa\Database\\'.ucfirst($driver) . '\\' . ucfirst($driver).'Database';
                return (new $drivername)->getDb($settings['DB_HOST'], $settings['DB_NAME'], $settings['DB_USER'], $settings['DB_PASSWORD']);
            }
            throw new DatabaseException('Undefined driver');
        }
        return $this->db;

    }


}