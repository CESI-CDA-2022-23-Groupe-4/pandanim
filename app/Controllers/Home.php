<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $test = 'test';
        $this->display('home/index', [
            'test'=>$test
        ]);
    }
}
