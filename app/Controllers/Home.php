<?php

namespace App\Controllers;
use App\Controllers\Anime;

class Home extends BaseController
{
    public function index()
    {
        $anime = new Anime();
        $this->_data = $anime->findAllAnimes();
        // dd($this->_data);
        $this->display('home/index');
    }
}
