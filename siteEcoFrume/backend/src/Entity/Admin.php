<?php

namespace App\Entity;
use App\Entity\AbstractEntity\AbstractUser;

class Client extends AbstractUser {
    public function __construct(){
        $this->userRole = 1;
    }
}