<?php

namespace controllers;

class DefaultController extends Controller
{
    public function __construct()
    {
        
    }

    public function defaultView()
    {
        $params['title'] = 'デフォルト';

        $this->View('default', $params);
    }
}
