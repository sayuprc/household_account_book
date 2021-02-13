<?php

namespace controllers;

class ReceiptController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function create()
    {
       $this->view('create');
    }

    public function new()
    {
    }
}
