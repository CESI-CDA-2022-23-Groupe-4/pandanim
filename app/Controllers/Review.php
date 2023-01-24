<?php

namespace App\Controllers;

use App\Entities\Review_entity;
use App\Models\ReviewModel;

class Review extends BaseController
{
    public function __construct(){
    }

    public function findAllReview()
    {
        $reviewModel = new ReviewModel();
        $reviews = $reviewModel->findAll();
        $this->_data = [
            'reviews'=>$reviews
        ];
        
        return $reviews;
    }

    public function ListeR()
    {
        $review = new Review();
        $this->_data = $review->findAllReview();
        $this->display('review');
    }

    public function addReview(){
        helper('form'); // Déclare l'utilisation du helper
    
      $this->_data['title']          = "Add a Review";

        // Il faut charger la librairie

        $validation =  \Config\Services::validation();



        // On donne des règles de validation une à une ou à travers d'un tableau (setRules)

        $validation->setRule('comment', 'Comment', 'required');



        $arrErrors = array();

        if (count($this->request->getPost()) > 0){ // Le formulaire a été envoyé ?

            if ($validation->run($this->request->getPost())){ //on teste la validation du formulaire sur les données

                $objCommentModel = new Comment_model(); // Instanciation du modèle

                $objComment     = new \App\Entities\Comment_entity(); // Instanciation de l'entité

                $objComment->fill($this->request->getPost());

                $objCommentModel->save($objComment); // On sauvegarde l'objet

                return redirect()->to('/comment'); // redirection vers l'action par défaut du controller Product

            }else{

                $arrErrors = $validation->getErrors(); // on récupère les erreurs pour les afficher

            }

        }

        $data['arrErrors'] 		= $arrErrors;

      $this->_data['form_open']      = form_open("review/add");
      $this->_data['label_comment']     = form_label("Comment", "comment");
      $this->_data['form_comment']      = form_textarea("comment", "", "id='comment'");
      $this->_data['form_submit']    = form_submit("submit", "Envoyer");
      $this->_data['form_close']     = form_close();
    //   echo view('reviews_add', $data);
      $this->display('review_add');
    }
    
    
}
