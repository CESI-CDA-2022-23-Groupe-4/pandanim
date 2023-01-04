<?php

namespace App\Controllers;

use App\Entities\Anime_entity;
use App\Models\AnimeModel;

class Anime extends BaseController
{
    public function __construct(){
    }

    public function findAllAnimes()
    {
        $animeModel = new AnimeModel();
        $animes = $animeModel->findAll();
        $this->_data = [
            'animes'=>$animes
        ];
        
        return $animes;
    }
    
    public function save($data)
    {
        // if($data instanceof Anime::class){        }
        $animeModel = new AnimeModel();
        $anime_entity = new Anime_entity();
        foreach ($data as $anime) {
            if($animeModel->find($anime->id)) {
                $animeModel->update($anime->id, $anime);
            }else{
                $anime_entity->fill($anime);
                $animeModel->insert($anime_entity);
            }   
        }

    }
}
