<?php

namespace App\Controllers;
use App\Entities\User_entity;
use App\Models\User_model;
use CodeIgniter\Controller;

Class Register extends BaseController {

    public function index() {

        // Instanciation du modèle
        $objUserModel = new User_model();

        // On fournit les variables pour la vue
        $this->_data = [
            'title' => 'Register',
//            'arrRegisters' => $objUserModel->findAll()
        ];

        // Affichage de la vue
        $this->display('register/index');

    }

    public function add()
    {
        // Déclare l'utilisation du helper
        helper('form');

        // Instanciation du modèle
        $objUserModel = new User_model();
        // Instanciation de l'entité
        $objUser = new User_entity();

        // Il faut charger la librairie
        $validation = \Config\Services::validation();

        // On donne des règles de validation
        $validation->setRules([
            'email' => [
                'label'  => 'Email de l\'utilisateur',
                'rules'  => 'required|valid_email',
                'errors' => [
                    'required' => 'Le {field} est obligatoire',
                ],
            ],
            'password' => [
                'label'  => 'Mot de passe utilisateur',
                'rules'  => 'required|min_length[8]',
                'errors' => [
                    'required' => 'Le {field} est obligatoire',
                ],
            ],
//            'pass_confirm' => [
//                'label'  => 'Confirmer mot de passe utilisateur',
//                'rules'  => 'required|matches[password]',
//                'errors' => [
//                    'required' => 'Le {field} est obligatoire',
//                ],
//            ],
        ]);

        $arrErrors = array();
        // Le formulaire a été envoyé ?
        if (count($this->request->getPost()) > 0) {
            $objUser->fill($this->request->getPost());
            //on teste la validation du formulaire sur les données
            if ($validation->run($this->request->getPost())) {
                // On sauvegarde l'objet
                $objUserModel->save($objUser);
                // redirection vers l'action par défaut du controller Register
                return redirect()->to('/register');
            } else {
                // on récupère les erreurs pour les afficher
                $arrErrors = $validation->getErrors();
            }
        }

        $this->_data = [
            'arrErrors' => $arrErrors,
            'form_open' => form_open("register/add"),
            'form_id' => form_hidden("user_id", $objUser->id ?? '', "id='id'"),
            'label_email' => form_label("Email", "email"),
            'form_email' => form_input("email", $objUser->email ?? '', "id='email'"),
            'label_password' => form_label("Password", "password"),
            'form_password' => form_input("password", $objUser->password ?? '', "id='password'"),
            'form_submit' => form_submit("submit", "Register"),
            'form_close' => form_close(),
        ];

        $this->display('register/add');
    }
}