<?php

namespace App\Controllers;

class API extends BaseController
{
    public function __construct(){}
    
    /// Gets the requested anime page from Jikan API and returns it as JSON
    public function getAnimePage($page = 1) {
        $response = [];
        $data = json_decode(file_get_contents('https://api.jikan.moe/v4/anime?page='.$page), true);
        $response = array_merge($response, $data['data']);
        $anime = new Anime();
        $anime->save($response);
        return redirect()->to('/api/ge');
    }


    /// Gets all anime from Jikan API and returns it as JSON
    /// This function will take a long time to run, so be patient
    public function getAllAnime() {
        $page = 1;
        $response = [];
        set_time_limit(3600);
        ini_set('memory_limit', '5G');
        while(true) {
            $data = json_decode(file_get_contents('https://api.jikan.moe/v4/anime?page='.$page), true);
            $response = array_merge($response, $data['data']);
            $page++;
            if(!$data['pagination']['has_next_page']) {
                break;
            }
            $anime = new Anime();
            $anime->save($response);
            // sleep(0.1);
        }
        return redirect()->to('/');
        // return $this->response->setJSON($response);
    }
}
