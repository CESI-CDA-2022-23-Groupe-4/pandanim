<?php

namespace App\Controllers;

class API extends BaseController
{
    public function __construct(){}

    public function getAnimePage($page = 1) {
        $strUrl = 'https://api.jikan.moe/v4/anime?page='.$page;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $strUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
        // $response = json_decode($response, true);
        dd ($response);
    }
}
