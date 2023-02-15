<?php

namespace App\Entity\AbstractEntity;

use PDO;
use PDOException;

Abstract class AbstractUser {
    protected int $userId;
    protected string $userEmail;
    protected string $userPassword;
    protected string $userFname;
    protected string $userLname;
    protected string $userAdress;
    protected int $userRole;

    protected $connection;

    /**
     * Get the value of userId
     */ 
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set the value of userId
     *
     * @return  self
     */ 
    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * Get the value of userEmail
     */ 
    public function getUserEmail()
    {
        return $this->userEmail;
    }

    /**
     * Set the value of userEmail
     *
     * @return  self
     */ 
    public function setUserEmail($userEmail)
    {
        $this->userEmail = $userEmail;

        return $this;
    }

    /**
     * Get the value of userPassword
     */ 
    public function getUserPassword()
    {
        return $this->userPassword;
    }

    /**
     * Set the value of userPassword
     *
     * @return  self
     */ 
    public function setUserPassword($userPassword)
    {
        $this->userPassword = $userPassword;

        return $this;
    }

    /**
     * Get the value of userFname
     */ 
    public function getUserFname()
    {
        return $this->userFname;
    }

    /**
     * Set the value of userFname
     *
     * @return  self
     */ 
    public function setUserFname($userFname)
    {
        $this->userFname = $userFname;

        return $this;
    }

    /**
     * Get the value of userLname
     */ 
    public function getUserLname()
    {
        return $this->userLname;
    }

    /**
     * Set the value of userLname
     *
     * @return  self
     */ 
    public function setUserLname($userLname)
    {
        $this->userLname = $userLname;

        return $this;
    }

    /**
     * Get the value of userAdress
     */ 
    public function getUserAdress()
    {
        return $this->userAdress;
    }

    /**
     * Set the value of userAdress
     *
     * @return  self
     */ 
    public function setUserAdress($userAdress)
    {
        $this->userAdress = $userAdress;

        return $this;
    }

    /**
     * Get the value of userRole
     */ 
    public function getUserRole()
    {
        return $this->userRole;
    }

    /**
     * Set the value of userRole
     *
     * @return  self
     */ 
    public function setUserRole($userRole)
    {
        $this->userRole = $userRole;

        return $this;
    }
    public function __construct()
    {

        try{
            $this->connection = new PDO('mysql:host=localhost;dbname=EcoFrume', 'metarar22', 'root');
            }
            catch (PDOException $erreur){
                die('Erreur: ' . $erreur->getMessage());
            }
            

    }

    function listAllUser(){
        $sql = "SELECT * FROM User";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($result);
      }   
    
      function getUserById($id){
        $sql = "SELECT * FROM User WHERE userId = $id";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($result);
      }
    
      function getUserByEmail($email){
        $sql = "SELECT * FROM User WHERE userEmail = $email";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($result);
      }
    
      function addUser($userEmail, $userPassword, $userFname, $userLname, $userAdress){
        $sql = "INSERT INTO User(userEmail, userPassword, userFname, userLname, userAdress) VALUES('$userEmail', '$userPassword', '$userFname', '$userLname', '$userAdress')";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        echo "Insertion réussie";

      
      }
      
      
      function deleteUser($userId){
        $sql = "DELETE FROM User WHERE userId = $userId";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        
      }
    
}