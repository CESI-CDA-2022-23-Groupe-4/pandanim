<?php

namespace App\Controllers;
use App\Controllers\Anime;

class Home extends BaseController
{
    public function __construct()
    {
       
    }

    public function index()
    {
        $anime = new Anime();
        $this->_data = $anime->findAllAnimes();
        $this->display('home/index');
    }

    
}
