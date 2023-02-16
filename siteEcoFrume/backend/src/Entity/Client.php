<?php

namespace App\Entity;
use PDO;
use PDOException;
use App\Entity\AbstractEntity\AbstractUser;



class Client extends AbstractUser  {
    public function __construct(){
        $this->userRole = 0;

    }   

}