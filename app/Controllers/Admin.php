<?php

namespace App\Controllers;
use App\Entities\User_entity;
use App\Models\User_model;

Class Admin extends BaseController {

    public function index()
    {
        if (!isset($this->session->get('user')->id)) {
            return redirect()->to('/signin');
        } elseif ($this->session->get('user')->roles != 'ROLE_ADMIN') {
            return redirect()->to('/signin');
        } else {
            $objUserModel = new User_model();
            $this->_data = [
                'user' => $objUserModel->findAll(),
                'session' => $this->session->get('user')
            ];
            $this->display('admin/index');
        }
    }

    public function edit($intId)
    {
        // Déclare l'utilisation du helper
        helper('form');

        // Instanciation du modèle
        $objUserModel = new User_model();
        // Instanciation de l'entité
        $objUser = $objUserModel->find($intId);

        // Il faut charger la librairie
        $validation = \Config\Services::validation();

        // On donne des règles de validation
        $validation->setRules([
            'username' => [
                'rules' => 'required|min_length[3]|max_length[30]',
                'errors' => [
                    'required' => 'Le {field} est obligatoire',
                ],
            ],
            'firstname' => [
                'rules' => 'required|min_length[3]|max_length[40]',
                'errors' => [
                    'required' => 'Le {field} est obligatoire',
                ],
            ],
            'lastname' => [
                'rules' => 'required|min_length[3]|max_length[40]',
                'errors' => [
                    'required' => 'Le {field} est obligatoire',
                ],
            ],
            'email' => [
                'rules'  => 'required|valid_email',
                'errors' => [
                    'required' => 'Le {field} est obligatoire',
                ],
            ],
            'roles' => [
                'rules'  => 'required|in_list[ROLE_USER,ROLE_ADMIN,ROLE_SUPER_ADMIN,ROLE_MODERATOR]',
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
                if ($this->request->getPost('password') != '') {
                    $objUser->setPwdHash($objUser->password);
                }
                // On modifie l'utilisateur
                $objUserModel->save($objUser);
                // redirection vers l'action par défaut du controller Register
                return redirect()->to('/admin');
            } else {
                // on récupère les erreurs pour les afficher
                $arrErrors = $validation->getErrors();
            }
        }

        $this->_data = [
            'arrErrors' => $arrErrors,
            'form_open' => form_open("/admin/edit/$intId"),
            'form_id' => form_hidden("user_id",$objUser->id??'', "id='id'"),
            'label_username' => form_label("Username", "username"),
            'form_username' => form_input("username", $objUser->username??'', "id='username'"),
            'label_firstname' => form_label("Firstname", "firstname"),
            'form_firstname' => form_input("firstname", $objUser->firstname??'', "id='firstname'"),
            'label_lastname' => form_label("Lastname", "lastname"),
            'form_lastname' => form_input("lastname", $objUser->lastname??'', "id='lastname'"),
            'label_email' => form_label("Email", "email"),
            'form_email' => form_input("email", $objUser->email??'', "id='email'"),
            'label_password' => form_label("Password", "password"),
            'form_password' => form_input("password", '', "id='password'"),
            'label_roles' => form_label("Roles", "roles"),
            'form_roles' => form_input("roles", $objUser->roles??'', "id='roles'"),
            'form_submit' => form_submit("submit", "Edit", "class='btn btn-success'"),
            'form_close' => form_close(),
        ];

        $this->display('admin/edit');
    }

    public function delete($intId){
        $objUserModel   = new User_model();
        $objUserModel->delete($intId);
        return redirect()->to('/admin');
    }



}

