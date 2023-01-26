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
        // Déclare l'utilisation du helper
        helper('form');
        // Il faut charger la librairie
        $validation = \Config\Services::validation();
        // On donne des règles de validation 
        $validation->setRules([
            'search' => [
                'rules' => 'required|min_length[3]|max_length[30]',
                'errors' => [
                    'required' => 'Le {field} est obligatoire',
                ],
            ],
        ]);
        $arrErrors = array();
        // Le formulaire a été envoyé ?
        if (count($this->request->getPost()) > 0) {
            $search = $this->request->getGet();
            $this->display('home/index');
        }
        $this->_data = [
            'searchForm' => [
                'arrErrors' => $arrErrors,
                'form_open' => form_open("/search", "class= 'd-flex'"),
                'label_search' => form_label("Search", "search"),
                'form_search' => form_input("search", "", "class= 'form-control me-2'"),
                'form_submit' => form_submit("submit", "search", "class='btn btn-outline-success'"),
                'form_close' => form_close(),
            ],
            'animes' => $anime->findAllAnimes(),
            'objuser' => $this->session->get('user')
        ];
        $this->display('home/index');
    }

    public function animeDetails($id = 1)
    {
        $animeModel = new AnimeModel();
        $this->_data = $animeModel->find($id);
        $this->display('home/details');
    }

    public function search()
    {
        if (count($this->request->getPost()) > 0) {
            $search = $this->request->getPost('search') ?? "";
            $animeModel = new AnimeModel();
            // dd($animeModel->where('title',$search)->findAll());
            helper('form');
            $arrErrors = array();
            $this->_data = [
                'searchForm' => [
                    'arrErrors' => $arrErrors,
                    'form_open' => form_open("/search", "class= 'd-flex'"),
                    'label_search' => form_label("Search", "search"),
                    'form_search' => form_input("search", $search, "class= 'form-control me-2'"),
                    'form_submit' => form_submit("submit", "search", "class='btn btn-outline-success'"),
                    'form_close' => form_close(),
                ],
                'objuser' => $this->session->get('user'),
                'animes' => $animeModel->like('title', $search)->orLike('title_english', $search)
                    ->orLike('title_japanese', $search)->orLike('synopsis', $search)->findAll()
            ];
            $this->display('home/index');
        };
    }
}
