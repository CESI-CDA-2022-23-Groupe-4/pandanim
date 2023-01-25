<?php

namespace App\Controllers;

//use App\Entities\Review_entity;
use App\Models\ReviewModel;

class Review extends BaseController
{
    public function __construct(){
    }

    public function findAllReview()
    {
        $reviewModel = new ReviewModel();
        $reviews = $reviewModel->joinR();

        $this->_data = [
            'reviews'=>$reviews
        ];
        
        return $reviews;
    }

    public function ListeR()
    {
        $review = new Review();
        $this->_data = $review->findAllReview();
        $this->display('review/review');
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

                $objReviewModel = new ReviewModel(); // Instanciation du modèle

                $objReview     = new \App\Entities\Review_entity(); // Instanciation de l'entité

                $objReview->fill($this->request->getPost());

                $objReviewModel->save($objReview); // On sauvegarde l'objet

                return redirect()->to('/review'); // redirection vers l'action par défaut du controller Product

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
      $this->display('review/review_add');
}
    
    public function editReview($anime_id, $user_id){
        // Déclare l'utilisation du helper
        helper('form');
      
        // Instanciation du modèle
        $objReviewModel = new ReviewModel(); 

        // Instanciation de l'entité
        $objReview     = new \App\Entities\Review_entity();
      
        if ($anime_id && $user_id){
            $data['title']      = "Edit Review";
            $objReview         = $objReviewModel->where('anime_id', $anime_id)->where('user_id', $user_id)->first();
        }else{
            $data['title']      = "Add Review";
        }

        // dd($objReview);

        // Il faut charger la librairie
        $validation =  \Config\Services::validation();
      
        // On donne des règles de validation
        // $validation->setRules('comment', 'Comment', 'required');

        $arrErrors = array();
        // Le formulaire a été envoyé ?
        if (count($this->request->getPost()) > 0) {
            // dd($objReview);
            $objReview->fill($this->request->getPost());
            //on teste la validation du formulaire sur les données
            if ($validation->run($this->request->getPost())){
                // On sauvegarde l'objet
                $objReviewModel->save($objReview);
                // redirection vers l'action par défaut du controller Product
                return redirect()->to('/review');
            }else{
                // on récupère les erreurs pour les afficher
                $arrErrors = $validation->getErrors();
            }
        }
    
        $this->_data['form_open']      = form_open("review/edit/$anime_id/$user_id");
        $this->_data['form_id']        = form_hidden("review_id", $objReview->review_id??'', "id='review_id'");
        $this->_data['label_comment']     = form_label("Comment", "comment");
        $this->_data['form_comment']      = form_textarea("comment", "", "id='comment'");
        $this->_data['form_submit']    = form_submit("submit", "Envoyer");
        $this->_data['form_close']     = form_close();
        $this->_data['review'] = $objReview;
        $this->display('review/review_edit');
    }
      
    public function delete($intId){
	
        $objReviewModel   = new ReviewModel();
	
        $objReviewModel->delete($intId);
	
        return redirect()->to('/review');
	
    }
    
}
