<?php

namespace App\Models;

use CodeIgniter\Model;

class AnimeModel extends Model
{
    protected $table = 'anime';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'id',
        'image_url',
        'small_image_url',
        'large_image_url',
        'trailer',
        'title',
        'title_english',
        'title_japanese',
        'type',
        'episodes',
        'status',
        'aired_from',
        'aired_to',
        'duration',
        'mal_score',
        'scored_by',
        'rating',
        'synopsis',
        'broadcast',
        'studios'
    ];	
    protected $returnType = 'App\Entities\Anime_entity';
}