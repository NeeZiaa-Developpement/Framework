<?php

namespace NeeZiaa\Router;

use http\Header;
use NeeZiaa\Router\RouterException;

class Router
{
    private string $url;
    private array $routes = array();
    private array $namedRoutes = array();

    /**
     *  constructor
     * @param string $url
     * @return void
     */
    public function __construct(string $url)
    {
        $this->url = $url;
    }

    /**
     * Get method
     *
     * @param string $path
     * @param mixed $callable
     * @param string|null $name
     *
     * @return Route
     */
    public function get(string $path, mixed $callable, string $controller, ?string $name = null): Route
    {
        return $this->add($path, $callable, $name, 'GET');
    }

    /**
     * Post method
     *
     * @param string $path
     * @param mixed $callable
     * @param string|null $name
     * @return Route
     */
    public function post(string $path, mixed $callable, ?string $name = null): Route
    {
        return $this->add($path, $callable, $name, 'POST');
    }

    /**
     * Add - Register Route
     *
     * @param string $path
     * @param mixed $callable
     * @param string|null $name
     * @param string $method
     * @return Route
     */
    private function add(string $path, mixed $callable, ?string $name, string $method): Route
    {
        $route = new Route($path, $callable);
        $this->routes[$method][] = $route;
        if ($name) $this->namedRoutes[$name] = $route;
        return $route;
    }

    /**
     * @throws \NeeZiaa\Router\RouterException
     */
    public function run()
    {
        if (!isset($this->routes[$_SERVER['REQUEST_METHOD']])) throw new RouterException('REQUEST_METHOD does not exist');

        foreach($this->routes[$_SERVER['REQUEST_METHOD']] as $route) {
            if ($route->match($this->url)) return $route->call();
        }
        throw new RouterException('No matching routes');
    }

    /**
     * Generate link
     * @throws \NeeZiaa\Router\RouterException
     */
    public function url(string $name, array $params = [])
    {
        if (!isset($this->namedRoutes[$name])) throw new RouterException('No route matches this name');
        return $this->namedRoutes[$name]->getUrl($params);
    }

    /**
     * Redirect to route
     * @throws \NeeZiaa\Router\RouterException
     */
    public function redirect(string $route, array $params = []): void
    {
        header('Location: '. $this->url($route, $params));
    }
}