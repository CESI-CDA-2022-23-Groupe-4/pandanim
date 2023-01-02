<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function __construct(private $twig = new \Kenjis\CI4Twig\Twig()){}
    public function index()
    {
        $test = 'test';
        $this->twig->display('home/index', [
            'test'=>$test
        ]);
    }
}
