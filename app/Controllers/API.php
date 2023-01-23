<?php

namespace App\Controllers;

class API extends BaseController
{
    public function __construct(){}
    
    /// Gets the requested anime page from Jikan API and returns it as JSON
    public function getAnimePage($page = 1) {
        $response = file_get_contents('https://api.jikan.moe/v4/anime?page='.$page);
        if ($response === false) {
            return $this->response->setStatusCode(404, 'Page not found');
        }
        return $this->response->setJSON($response);
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
            sleep(1);
        }
        return $this->response->setJSON($response);
    }

    
}
