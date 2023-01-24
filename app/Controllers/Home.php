<?php

namespace App\Controllers;
use App\Controllers\Anime;
use App\Models\AnimeModel;
use CodeIgniter\HTTP\IncomingRequest;

class Home extends BaseController
{
    public function __construct()
    {
       
    }

    public function index()
    {
        $anime = new Anime();
        $this->_data = [
            $anime->findAllAnimes(),
            'objuser' => $this->session->get('user')
        ];
        $this->display('home/index');
    }

    public function animeDetails($id = 1){
        $animeModel = new AnimeModel();
        $this->_data = $animeModel->find($id);
        $this->display('home/details');
    }
    
    public function search(){
        $request = new IncomingRequest('get');
        dd($request->getGet());
    }
}
