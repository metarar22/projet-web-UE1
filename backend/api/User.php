<?php
use App\Entity\Client;

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

      $id = ($_GET["userId"]);
      getUserById($id);
    }
    elseif(!empty($_GET["userEmail"]))
    {
        $email = ($_GET["userEmail"]);
        getUserByEmail($email);
    } else {
        listAllUser();
    }
    break;

  case 'POST':

    if(isset($_POST['submit'])){
      userConnect();
    }else{
    addUser();
    }
    break;
  
  case 'DELETE';

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