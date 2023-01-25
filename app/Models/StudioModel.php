<?php

namespace App\Models;

use CodeIgniter\Model;

class StudioModel extends Model
{
    protected $table = 'studio';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        "id",
        "type",
        "name",
        "url"
    ];	
    protected $returnType = 'App\Entities\Studio_entity';
}