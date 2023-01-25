<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class User_entity extends Entity
{
    public function setPwdHash(string $password) {
        $this->password = password_hash(hash('sha512', $password), PASSWORD_DEFAULT);
        return $this->password;
    }

    public function setDefaultRole() {
        $this->roles = '["ROLE_USER"]';
        return $this->roles;
    }
}