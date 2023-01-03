<?php

namespace App\Controllers;
use App\Models\AnimeModel;

class Anime extends BaseController
{
    public function findAllAnimes()
    {
        $animeModel = new AnimeModel();
        $animes = $animeModel->findAll();
        $_data = [
            'animes'=>$animes
        ];
        $this->display('anime/index');
    }
}
