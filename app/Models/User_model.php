<?php

namespace App\Models;
use CodeIgniter\Model;

class User_model extends Model
{
    // Nom de la table à utiliser
    protected $table         = 'user';
    // Nom du champ de la clé primaire
    protected $primaryKey    = 'id';
    // Champs utilisables
    protected $allowedFields = ['username', 'firstname', 'lastname', 'email', 'password', 'roles'];

    // Type de retour => Chemin de l'entité à utiliser
    protected $returnType    = 'App\Entities\User_entity';

    // Utilisation ou non des dates (création / modification)
    protected $useTimestamps = false;

}