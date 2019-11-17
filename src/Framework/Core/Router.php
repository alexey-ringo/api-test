<?php
namespace Framework\Core;

use App\Controllers;
use Exception;

class Router {
    protected $routes = [];
    protected $params = [];
    protected $method = ''; //GET|POST|PUT|DELETE
    
    protected $urlParam;
    
    public function __construct() {
        //Определение метода запроса
        $this->method = $_SERVER['REQUEST_METHOD'];
        
        $arr = require 'config/routes.php';
        foreach ($arr as $key => $val) {
            $this->add($key, $val);
        }
        
        header("Access-Control-Allow-Orgin: *");
        header("Access-Control-Allow-Methods: *");
        header("Content-Type: application/json");
    }
    
    public function add($route, $params) {
        $route = preg_replace('/{([a-z]+):([^\}]+)}/', '(?P<\1>\2)', $route);
        $route = '#^'.$route.'$#';
        $this->routes[$route] = $params;
    }
    
    public function match() {
        $url = trim($_SERVER['REQUEST_URI'], '/');
        foreach ($this->routes as $route => $params) {
            if (preg_match($route, $url, $matches)) {
                foreach ($matches as $key => $match) {
                    if (is_string($key)) {
                        if (is_numeric($match)) {
                            $match = (int) $match;
                            $this->urlParam = (int) $match;
                        }
                        $params[$key] = $match;
                    }
                }
                $this->params = $params;
                return true;
            }
        }
        return false;
    }
    
    public function run(){
        if ($this->method !== 'POST') {
            //throw new Exception("Forbidden Method");
            return $this->notifyResponse('error', 'Метод запроса не соответствует требуемому методу POST!', 422);
        }
        
        //Обязательны условия, когда не сматчено или не найден класс/акция!
        if ($this->match()) {
            $controller = new $this->params['controller'];
            $action = $this->params['action'].'Action';
            if($this->urlParam) {
                return $controller->$action($this->urlParam);
            }
            else {
                return $controller->$action();
            }
        }
        else {
            //return json_encode('Маршрут не нейден!');
            return $this->notifyResponse('error', 'Маршрут запроса не нейден!', 422);
        }
    }
    
    private function notifyResponse($textStatus, $message = '', $status = 500) {
        header("HTTP/1.1 " . $status . " " . $this->requestStatus($status));
        $response = ['status' => $textStatus, 'message' => $message];
        return json_encode($response);
    }
    
    private function requestStatus($code) {
        $status = array(
            200 => 'OK',
            404 => 'Not Found',
            405 => 'Method Not Allowed',
            422 => 'Unprocessable Entity',
            500 => 'Internal Server Error',
        );
        return ($status[$code])?$status[$code]:$status[500];
    }
}