<?php

class Router {

    private static $routes = [];

    public static function get($path, $controller) {
        self::$routes['GET'][$path] = $controller;
    }

    public static function post($path, $controller) {
        self::$routes['POST'][$path] = $controller;
    }

    public static function dispatch($url) {

        $method = $_SERVER['REQUEST_METHOD'];

        if(isset(self::$routes[$method][$url])) {

            $controllerAction = self::$routes[$method][$url];

            list($controller, $action) = explode('@', $controllerAction);

            require "../app/controllers/$controller.php";

            $controllerInstance = new $controller();

            $controllerInstance->$action();

        } else {

            echo "404 - Ruta no encontrada";

        }

    }

}

Router::get('/', 'homeController@index');
Router::get('clasificatoria', 'clasificatoriaController@index');