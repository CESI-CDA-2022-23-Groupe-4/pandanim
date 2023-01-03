<?php

namespace App\Controllers;
use App\Controllers\Anime;

class Home extends BaseController
{
    public function index()
    {
        $anime = new Anime();
        $anime->findAllAnimes();
    }
}
