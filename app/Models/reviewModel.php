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

    public function joinR(){
        $builder = $db->table('review');
        $builder->select('*');
        $builder->from('review');
        $builder->join('user', 'user.id = review.user_id');
        $builder->join('anime', 'anime.id = review.anime_id');
        $query = $builder->get();
    }

    protected $returnType = 'App\Entities\Review_entity';
}