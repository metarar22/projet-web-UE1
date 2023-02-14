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

    function listAllUser(){
        global $connection;
        $sql = "SELECT * FROM User";
        $stmt = $connection->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($result);
      }   
    
      function getUserById($id){
        global $connection;
        $sql = "SELECT * FROM User WHERE userId = $id";
        $stmt = $connection->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($result);
      }
    
      function getUserByEmail($email){
        global $connection;
        $sql = "SELECT * FROM User WHERE userEmail = $email";
        $stmt = $connection->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($result);
      }
    
      function addUser(){
        global $connection;  
        $userEmail = $_POST["userEmail"];
        $userPassword = password_hash($_POST["userPassword"], PASSWORD_DEFAULT);
        $userFname = $_POST["userFname"];
        $userLname = $_POST["userLname"];
        $userAdress = $_POST["userAdress"];
        
        if(empty($_POST['userEmail']) or empty($_POST['userFname']) or empty($_POST['userLname']) or empty($_POST['userAdress']) or empty($_POST['userPassword']))
                {
                  $errors[] = "Veuillez remplir tous les champs";
                  return $errors;
                }else{
                  try{
                  header('Content-Type: application/json');
                  $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                  $sql = "INSERT INTO User(userEmail, userPassword, userFname, userLname, userAdress) VALUES('$userEmail', '$userPassword', '$userFname', '$userLname', '$userAdress')";
                  $stmt = $connection->prepare($sql);
                  $stmt->execute();
                  echo "Insertion réussie";
                  }catch (PDOException $erreur){
                    die('Erreur: ' . $erreur->getMessage());
      
      }
      }
      }
    
      function deleteUser(){
        global $connection;
        $UserId = $_GET['userId'];
        $sql = "DELETE FROM User WHERE userId = :userId";
        $stmt = $connection->prepare($sql);
        $stmt->bindParam(':userId', $UserId, PDO::PARAM_INT);
        if ($stmt->execute()){
          echo 'User deleted';
        }
        
      }
    
      function userConnect(){
        global $connection;
        session_start();
        $email = $_POST['userEmail'];
        $password = $_POST['userPassword'];
        $sql = "SELECT FROM User WHERE userEmail = $email";
        $stmt = $connection->prepare($sql);
        $stmt->execute();
    
        if($stmt->rowCount() > 0){
          $data = $stmt->fetchAll();
          if(password_verify($password, $data[0]['userPassword'])){
            echo "Connexion réussie";
            $_SESSION['userEmail'] = $email;
          }else{
            echo "Veuillez vous inscrire";
          }
        }
      }
}