<?php

namespace models;

class Receipt extends Model
{
    protected $table = 'receipts';

    protected $primaryKey = [
        'recepit_id'
    ];

    public function __construct()
    {
        parent::__construct();
    }
}
