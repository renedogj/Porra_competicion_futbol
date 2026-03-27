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
Router::get('clasificaciones', 'clasificacionesController@index');
Router::get('partidos', 'partidosController@index');

Router::get('obtenerClasificaciones', 'clasificacionesController@obtenerClasificaciones');
Router::get('obtenerPartidosApuestas', 'partidosController@obtenerPartidosApuestas');
Router::get('obtenerPaises', 'clasificatoriaController@obtenerPaises');
Router::get('obtenerApuestas', 'clasificatoriaController@obtenerApuestas');
Router::get('obtenerApuestaUsuario', 'clasificatoriaController@obtenerApuestaUsuario');
Router::get('apuesta', 'apuestaController@index');

Router::get('instrucciones', 'instruccionesController@index');

Router::post('apostar', 'clasificatoriaController@apostar');
Router::post('obtenerPartido', 'apuestaController@obtenerPartido');
Router::post('obternerApuestaspartido', 'apuestaController@obternerApuestaspartido');

Router::post('logout', 'AuthController@logout');
Router::post('login', 'AuthController@login');