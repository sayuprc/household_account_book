<?php

namespace libs;

class Request
{
    public $request;

    public static $instance = null;

    private function __construct()
    {
        $this->request = match($_SERVER['REQUEST_METHOD']) {
            'GET' => $_GET,
            'POST' => $_POST,
        };
    }
    
    public static function getInstance()
    {
        return static::$instance ?? static::$instance = new Request();
    }
}
