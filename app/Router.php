<?php

namespace App;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Router
 *
 * @author ivelin
 */
class Router {

    //put your code here
    protected $routes;

    private static function getUri() {
        return trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
    }

    public function defineRoutes($routes) {
        $this->routes = $routes;
    }

    public function redirect() {
        $uri = self::getUri();
    }

    public function resolveUri() {
        $uri = self::getUri();

        $auth = Auth::isLogged();

        if ($auth) {

            if (array_key_exists($uri, $this->routes['auth'])) {
                $address = $this->routes['auth'][$uri];

                $destination = explode('@', $address);
                $controller = 'Controller\\' . $destination[0];
                $action = $destination[1];

                return (new $controller)->$action();
            }
        } else {
            if (array_key_exists($uri, $this->routes['guest'])) {
                $address = $this->routes['guest'][$uri];

                $destination = explode('@', $address);
                $controller = 'Controller\\' . $destination[0];
                $action = $destination[1];

                return (new $controller)->$action();
            }

            header('Location: /login');
            die;
        }
    }

}
