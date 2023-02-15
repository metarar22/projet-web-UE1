<?php
use App\Entity\AbstractEntity\AbstractProduct;

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
function listAllproduct(){
    global $connection;
    $sql = "SELECT * FROM Product";
    $stmt = $connection->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($result);
  }   

  function getProductById($id){
    global $connection;
    $sql = "SELECT * FROM Product WHERE productId = $id";
    $stmt = $connection->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($result);
  }

  function getProductByName($name){
    global $connection;
    $sql = "SELECT * FROM Product WHERE productName = $name";
    $stmt = $connection->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($result);
  }

  function addProduct(){
    global $connection;  
    $productName = $_POST["productName"];
    $productCategory = $_POST["productCategory"];
    $productPrice = $_POST["productPrice"];
    $productStock = $_POST["productStock"];
    $productPicture = $_POST["productPicture"];
    if(empty($_POST['productName']) or empty($_POST['productCategory']) or empty($_POST['productPrice']) or empty($_POST['productStock']) or empty($_POST['productPicture']))
    {
      $errors[] = "Veuillez remplir tous les champs";
      return $errors;
    }else{  
    
    try{
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO Product(productName, productCategory, productPrice, productStock, productPicture) VALUES('$productName', '$productCategory', '$productPrice', '$productStock', '$productPicture')";
        $stmt = $connection->prepare($sql);
        $stmt->execute();
        var_dump($stmt);
        echo "Insertion réussie";
        }catch (PDOException $erreur){
          die('Erreur: ' . $erreur->getMessage());
    
  }
  }
}

  function deleteProduct(){
    global $connection;
    $productId = $_GET['productId'];
    $sql = "DELETE FROM Product WHERE productId = :productId";
    $stmt = $connection->prepare($sql);
    $stmt->bindParam(':productId', $productId, PDO::PARAM_INT);
    if ($stmt->execute()){
      echo 'Product deleted';
    }
    
  }

