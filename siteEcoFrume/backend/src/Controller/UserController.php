<?php

namespace App\Controller;

use PDO;
use PDOException;
use App\Entity\Client;

class UserController{

    public function __construct()
    {
        try{
            $connection = new PDO('mysql:host=localhost;dbname=EcoFrume', 'metarar22', 'root');
            }
            catch (PDOException $erreur){
                die('Erreur: ' . $erreur->getMessage());
            }
    
    }

    public function Signin($email, $password, $Fname, $Lname, $Adress)
    {
        global $connection;
        $sql = "INSERT INTO User(userEmail, userPassword, userFname, userLname, userAdress) VALUES(:userEmail, :userPassword, :userFname, :userLname, :userAdress)";
        $query = $connection->prepare($sql);
        $query->execute([
            'userEmail' => $email,
            'userPassword' => $password,
            'userFname' => $Fname,
            'userLname' => $Lname,
            'userAdress' => $Adress
        ]);
    }

    public function handleRequest()
    {
        $errors = [];
        if($_SERVER["REQUEST_METHOD"] == "POST"){
      
            if(empty($_POST['userEmail']) or empty($_POST['userFname']) or empty($_POST['userLname']) or empty($_POST['userAdress']) or empty($_POST['userPassword']))
            {
                $errors[] = "Veuillez remplir tous les champs";
                return $errors;
            }else{
                $user = new Client();
                $user->setUserEmail($_POST['userEmail']);
                $user->setUserFname($_POST['userFname']);
                $user->setUserLname($_POST['userLname']);
                $user->setUserAdress($_POST['userAdress']);
                $user->setUserPassword(password_hash($_POST["userPassword"], PASSWORD_DEFAULT));
                $this->Signin($user->getUserEmail(), $user->getUserPassword(), $user->getUserFname(), $user->getUserLname(), $user->getUserAdress());

            }
        }
    }

    function listAllUser(){
        global $connection;
        $sql = "SELECT * FROM User";
        $stmt = $connection->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($result);
      }   
    

    
      function addUser($userEmail, $userPassword, $userFname, $userLname, $userAdress){
        global $connection;
        $sql = "INSERT INTO User(userEmail, userPassword, userFname, userLname, userAdress) VALUES('$userEmail', '$userPassword', '$userFname', '$userLname', '$userAdress')";
        $stmt = $connection->prepare($sql);
        $stmt->execute();
        echo "Insertion réussie";

      
      }
      
      
      function deleteUser($userId){
        global $connection;
        $sql = "DELETE FROM User WHERE userId = $userId";
        $stmt = $connection->prepare($sql);
        $stmt->execute();
        
      }
}