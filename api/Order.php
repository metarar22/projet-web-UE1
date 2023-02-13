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
    if(!empty($_GET["orderId"]))
    {
      // Récupérer une seule facture par l'ID
      $id = ($_GET["orderId"]);
      getOrderByOrderId($id);
    }
    elseif(!empty($_GET["clientId"]))
    {
        $name = ($_GET["clientId"]);
        getOrderByClientId($CId);
    } else {
        listAllOrder();
    }
    break;


  default:
    // Requête invalide
    header("Method Not Allowed");
    break;
  
}
function listAllOrder(){
    global $connection;
    $sql = "SELECT * FROM OrderSum";
    $stmt = $connection->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($result);
  }   

  function getOrderByOrderId($id){
    global $connection;
    $sql = "SELECT * FROM OrderSum WHERE orderId = $id";
    $stmt = $connection->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($result);
  }

  function getOrderByClientId($CId){
    global $connection;
    $sql = "SELECT * FROM OrderSum WHERE clientId = $CId";
    $stmt = $connection->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($result);
  }