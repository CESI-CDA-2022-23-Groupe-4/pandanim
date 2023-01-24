<?php

namespace App\Models;

use CodeIgniter\Model;

class GenreModel extends Model
{
    protected $table = 'genre';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        "id",
        "type",
        "name",
        "url"
    ];	
    protected $returnType = 'App\Entities\Genre_entity';
}