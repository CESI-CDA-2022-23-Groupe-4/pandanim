<?php

namespace App\Models;

use CodeIgniter\Model;

class ReviewModel extends Model
{
    protected $table = 'review';
    protected $primaryKey = 'anime_id, user_id';
    protected $allowedFields = [
        'anime_id',
        'user_id',
        'score',
        'comment',
        'created_at',
        'updated_at'
    ];	
    protected $returnType = 'App\Entities\Review_entity';
    

    public function joinR(){
        return $this->select('*')->join('user', 'user.id = review.user_id')->join('anime', 'anime.id = review.anime_id')->findAll();
    }

}