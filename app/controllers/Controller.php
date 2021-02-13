<?php

namespace controllers;

use libs\Request;

class Controller
{
    protected $params;
    protected $request;

    private $notFoundPath;

    protected function __construct()
    {
        $this->notFoundPath = __DIR__ . '/../views/404.html';
        $this->request = Request::getInstance();
    }

    public function default()
    {

    }

    protected function View(string $viewName, array $data = [])
    {
        $filePath = sprintf("%s/../views/%s.php", __DIR__, $viewName);

        if (is_readable($filePath)) {
            require_once($filePath);
            flush();
        } else {
            require_once($this->notFoundPath);
            exit;
        }
    }
}
