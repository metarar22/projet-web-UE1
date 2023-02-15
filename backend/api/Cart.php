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
    if(!empty($_GET["cartId"]))
    {

      $id = ($_GET["cartId"]);
      getCartByCartId($id);

    } else {
        listAllCart();
    }
    break;

    case 'DELETE';

      deleteCart();
      break;

  default:

    header("Method Not Allowed");
    break;
  
}
function listAllCart(){
    global $connection;
    $sql = "SELECT * FROM Cart";
    $stmt = $connection->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($result);
  }   

  function getCartByCartId($id){
    global $connection;
    $sql = "SELECT * FROM Cart WHERE cartId = $id";
    $stmt = $connection->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($result);
  }


  function deleteCart(){
    global $connection;
    $cartId = $_GET['cartId'];
    $sql = "DELETE FROM Cart WHERE cartId = :cartId";
    $stmt = $connection->prepare($sql);
    $stmt->bindParam(':cartId', $cartId, PDO::PARAM_INT);
    if ($stmt->execute()){
      echo 'Cart deleted';
    }
    
  }