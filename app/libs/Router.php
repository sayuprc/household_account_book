<?php

namespace libs;

class Router
{
    private $uri;
    private $method;
    private $controller;
    private $action;
    private $params;

    private $configs;

    # Domain/Controller/Action/params
/*
    public function __construct()
    {
        $this->uri = $_SERVER['REQUEST_URI'];
        $this->method = $_SERVER['REQUEST_METHOD'];
    }
*/

    public static function loadSetting()
    {

    }

    public static function Get(string $uri, string $controller, string $action): void
    {
        static::$configs[] = [
            'uri' => $uri,
            'method' => 'get',
            'controller' => $controller,
            'action' => $action
        ];
    }

    public static function Post(string $uri): void
    {

    }
}