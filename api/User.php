<?php


//Se connecter à la base de données
try{
    $connection = new PDO('mysql:host=localhost;dbname=EcoFrume', 'metarar22', 'root');
    }
    catch (PDOException $erreur){
        die('Erreur: ' . $erreur->getMessage());
    }

$request_method = $_SERVER['REQUEST_METHOD'];
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=utf-8");

switch($request_method)
{
  case 'GET':
    if(!empty($_GET["userId"]))
    {
      // Récupérer une seule facture par l'ID
      $id = ($_GET["userId"]);
      getUserById($id);
    }
    elseif(!empty($_GET["userName"]))
    {
        $name = ($_GET["userName"]);
        getUserByName($name);
    } else {
        listAllUser();
    }
    break;

  case 'POST':
    //Ajouter une Facture
    addUser();
    break;
  
  case 'DELETE';
  //Supprimer une facture
    deleteUser();
    break;

  default:
    // Requête invalide
    header("Method Not Allowed");
    break;
  
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

  function getUserByName($name){
    global $connection;
    $sql = "SELECT * FROM User WHERE UserName = $name";
    $stmt = $connection->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($result);
  }

  function addUser(){
    global $connection;  
    $userEmail = $_POST["userEmail"];
    $userPassword = $_POST["userPassword"];
    $userFname = $_POST["userFname"];
    $userLname = $_POST["userLname"];
    $userAdress = $_POST["userAdress"];
    $userRole = $_POST["userRole"];
    
    try{
      header('Content-Type: application/json');
      $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $sql = "INSERT INTO User(userEmail, userPassword, userFname, userLname, userAdress, userRole) VALUES('$userEmail', '$userPassword', '$userFname', '$userLname', '$userAdress', '$userRole')";
      $stmt = $connection->prepare($sql);
      $stmt->execute();
      echo "Insertion réussie";
      }catch (PDOException $erreur){
        die('Erreur: ' . $erreur->getMessage());
  
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
