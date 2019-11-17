<?php

namespace App\Controllers;

class ApiController
{
    protected $okStatus = 'ok';
    protected $errStatus = 'error';

    protected $method = ''; //GET|POST|PUT|DELETE

    public $requestUri = [];
    public $requestParams = [];
    
    
    public function __construct() {
        header("Access-Control-Allow-Orgin: *");
        header("Access-Control-Allow-Methods: *");
        header("Content-Type: application/json");
    }

    

    protected function response($textStatus, $data, $message = '', $status = 500) {
        header("HTTP/1.1 " . $status . " " . $this->requestStatus($status));
        $response = ['status' => $textStatus, 'payload' => $data, 'message' => $message];
        return json_encode($response);
    }
    
    protected function notifyResponse($textStatus, $message = '', $status = 500) {
        header("HTTP/1.1 " . $status . " " . $this->requestStatus($status));
        $response = ['status' => $textStatus, 'message' => $message];
        return json_encode($response);
    }

    protected function requestStatus($code) {
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