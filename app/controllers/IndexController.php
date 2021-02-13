<?php

namespace controllers;

use models\Receipt;

class IndexController extends Controller
{
    protected $params;
    protected $request;

    public function __construct()
    {
        parent::__construct();
    }

    public function list()
    {
        $receipt = new Receipt();

        $data['receipts'] = $receipt->all();

        $data['title'] = '一覧';

        $this->View('list', $data);
    }
}