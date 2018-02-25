<?php

/**
 * Created by PhpStorm.
 * User: barthclem
 * Date: 2/22/18
 * Time: 9:41 AM
 */

namespace App\core;
class Router
{
    private $routes = [
        'GET' => [],
        'POST' => [],
        'PUT' => [],
        'DELETE' => []
    ];

    public static function load($file){
        $router = new static;

        require $file;

        return $router;

    }

    public function define($routes)
    {
        $this->routes = $routes;
    }

    public function get($uri, $controller) {
        $this->routes['GET'][$uri] = $controller;
    }

    public function delete($uri, $controller) {
        $this->routes['DELETE'][$uri] = $controller;
    }

    public function post($uri, $controller) {
        $this->routes['POST'][$uri] = $controller;
    }

    public function put($uri, $controller) {
        $this->routes['PUT'][$uri] = $controller;
    }

    public function direct($uri, $request_method) {

        if(array_key_exists($uri, $this->routes[$request_method])) {
            return $this->callAction(
                ...explode('@',$this->routes[$request_method][$uri])
            );
        }
        echo "{";
            echo "message: routes not exist";
        echo "}";

        return new Exception("routes does not exist");
    }

    protected function callAction($controller, $action) {

        if( !method_exists($controller, $action)) {
            throw new Exception("
            please check the route $action and try again
            ");
        }

        return (new $controller)->$action();
    }
}