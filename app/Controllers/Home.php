<?php

namespace App\Controllers;
use App\Controllers\Anime;
use App\Models\AnimeModel;

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

    public function animeDetails($id = 1){
        $animeModel = new AnimeModel();
        $this->_data = $animeModel->find($id);
        $this->display('home/details');
    }
    
}
