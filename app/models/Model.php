<?php

namespace models;

class  Model
{
    protected $dbh;

    public function __construct()
    {
        $this->dbh = Db::getInstance();
    } 
}
