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
        $animes = $animeModel->findAll(1000);
        $this->_data = [
            'animes'=>$animes
        ];
        
        return $animes;
    }
    
    public function save($data)
    {
        // if($data instanceof Anime::class){        }
        // Query builder à créer pour mettre toutes les données sur active = false
        $animeModel = new AnimeModel();
        $anime_entity = new Anime_entity();
        foreach ($data as $anime) {
            $apiData = [
                'id'=> $anime['mal_id'],
                'title'=> $anime['title'],
                'title_english'=> $anime['title_english'],
                'title_japanese'=> $anime['title_japanese'],
                'image_url'=> $anime['trailer']['images']['image_url'],
                'small_image_url'=> $anime['trailer']['images']['small_image_url'],
                'large_image_url'=> $anime['trailer']['images']['large_image_url'],
                'trailer'=> $anime['trailer']['youtube_id'],
                'type'=> $anime['type'],
                'episodes'=> $anime['episodes'],
                'status'=> $anime['status'],
                'aired_from'=> date_format($anime['aired']['from'], 'Y-m-d)'),
                'aired_to'=> date_format($anime['aired']['to'], 'Y-m-d'),
                'duration'=> $anime['duration'],
                'mal_score'=> $anime['score'],
                'scored_by'=> $anime['scored_by'],
                'rating'=> $anime['rating'],
                'synopsis'=> $anime['synopsis'],
                'broadcoast'=> $anime['broadcast']['string'],
                'active'=>1
            ]
            ;
            if($animeModel->find($anime['mal_id'])) {
                $animeModel->update($anime['mal_id'], $apiData);
            }else{
                $anime_entity->fill($apiData);
                $animeModel->insert($anime_entity);
            }   
        }

    }
}
