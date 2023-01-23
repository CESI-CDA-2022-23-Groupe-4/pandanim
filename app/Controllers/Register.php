<?php

namespace App\Controllers;
use App\Entities\User_entity;
use App\Models\User_model;

Class Register extends BaseController {

    public function signin() {

//        // Instanciation du modèle
//        $objUserModel = new User_model();
//
//        // On fournit les variables pour la vue
//        $this->_data = [
//            'title' => 'Signin',
//        ];
//
//        // Affichage de la vue
//        $this->display('register/signin');

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
                'rules'  => 'required|valid_email',
                'errors' => [
                    'required' => 'Le {field} est obligatoire',
                ],
            ],
            'password' => [
                'rules'  => 'required|min_length[8]',
                'errors' => [
                    'required' => 'Le {field} est obligatoire',
                ],
            ],
        ]);

        $arrErrors = array();
        // Le formulaire a été envoyé ?
        if (count($this->request->getPost()) > 0) {
            $objUser->fill($this->request->getPost());
            //on teste la validation du formulaire sur les données
            if ($validation->run($this->request->getPost())) {
                // on vérifie que l'email et le password correspondent au données en base
                $objUser = $objUserModel->where('email', $objUser->email)->first();
                if ($objUser) {
                    // on vérifie que le password est correct
                    if (password_verify(hash('sha512', $this->request->getPost()["password"]), $objUser->password)) {
                        // on stocke l'objet en session
//                        $this->session->set('user', $objUser);
                        // redirection vers l'action par défaut du controller Register
                        return redirect()->to('/');
                    } else {
                        $arrErrors['password'] = 'Le mot de passe est incorrect';
                    }
                } else {
                    $arrErrors['email'] = 'L\'email est incorrect';
                }
            } else {
                // on récupère les erreurs pour les afficher
                $arrErrors = $validation->getErrors();
            }
        }

        $this->_data = [
            'arrErrors' => $arrErrors,
            'form_open' => form_open("register/signin"),
            'form_id' => form_hidden("user_id",'', "id='id'"),
            'label_email' => form_label("Email", "email"),
            'form_email' => form_input("email", '', "id='email'"),
            'label_password' => form_label("Password", "password"),
            'form_password' => form_input("password", '', "id='password'", "password"),
            'form_submit' => form_submit("submit", "Signin", "class='btn btn-success'"),
            'form_close' => form_close(),
        ];

        $this->display('register/signin');

    }

    public function signup()
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
                'rules'  => 'required|valid_email|is_unique[user.email]',
                'errors' => [
                    'required' => 'Le {field} est obligatoire',
                ],
            ],
            'password' => [
                'rules'  => 'required|min_length[8]',
                'errors' => [
                    'required' => 'Le {field} est obligatoire',
                ],
            ],
            // Vérifier que le password et la confirmation sont identiques
            'password_confirm' => [
                'rules'  => 'required|matches[password]',
                'errors' => [
                    'required' => 'Le {field} est obligatoire',
                ],
            ],
        ]);

        $arrErrors = array();
        // Le formulaire a été envoyé ?
        if (count($this->request->getPost()) > 0) {
            $objUser->fill($this->request->getPost());
            //on teste la validation du formulaire sur les données
            if ($validation->run($this->request->getPost())) {
                // on hash le password
                $objUser->setPwdHash($objUser->password);
                // On sauvegarde l'objet
                $objUserModel->save($objUser);
                // redirection vers l'action par défaut du controller Register
                return redirect()->to('/register/signin');
            } else {
                // on récupère les erreurs pour les afficher
                $arrErrors = $validation->getErrors();
            }
        }

        $this->_data = [
            'arrErrors' => $arrErrors,
            'form_open' => form_open("register/signup"),
            'form_id' => form_hidden("user_id",'', "id='id'"),
            'label_email' => form_label("Email", "email"),
            'form_email' => form_input("email", '', "id='email'"),
            'label_password' => form_label("Password", "password"),
            'form_password' => form_input("password", '', "id='password'", "password"),
            'label_pass_confirm' => form_label("Password confirm", "pass_confirm"),
            'form_pass_confirm' => form_input("password_confirm", '', "id='pass_confirm'", "password"),
            'form_submit' => form_submit("submit", "Register", "class='btn btn-success'"),
            'form_close' => form_close(),
        ];

        $this->display('register/signup');
    }
}