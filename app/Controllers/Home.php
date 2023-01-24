<?php

namespace App\Controllers;
use App\Controllers\Anime;

class Home extends BaseController
{
    public function index()
    {
        $anime = new Anime();
        $this->_data = [
            $anime->findAllAnimes(),
            'objuser' => $this->session->get('user')
        ];
        $this->display('home/index');
    }
}
