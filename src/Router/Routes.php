<?php

namespace NeeZiaa\Router;

class Routes {

    private static Routes $_instance;

    public static function getInstance(): Routes
    {
        if(is_null(self::$_instance)) self::$_instance = new Routes();
        return self::$_instance;
    }


    /**
     * @throws RouterException
     */
    public function routes(): void
    {
        $router = new Router($_SERVER['REQUEST_URI']);

        // Public

        $router->get('/', 'home@index', 'home');

        // Test

        $router->get('/test', 'test@index', 'test');

        $router->run();
    }
}

