<?php
include('../src/Entity/AbstractEntity/AbstractProduct.php');

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
    if(!empty($_GET["productId"]))
    {
      // Récupérer une seule facture par l'ID
      $id = ($_GET["productId"]);
      getProductById($id);
    }
    elseif(!empty($_GET["productName"]))
    {
        $name = ($_GET["productName"]);
        getProductByName($name);
    } else {
        listAllproduct();
    }
    break;

  case 'POST':
    //Ajouter une Facture
    addProduct();
    break;
  
  case 'DELETE';

    deleteProduct();
    break;

  default:

    header("Method Not Allowed");
    break;
  
}

