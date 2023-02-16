<?php

namespace App\Controller;


use PDO;
use PDOException;




class cartController {
    private $connection;

    public function __construct()
    {

        try{
            $this->connection = new PDO('mysql:host=localhost;dbname=EcoFrume', 'metarar22', 'root');
            }
            catch (PDOException $erreur){
                die('Erreur: ' . $erreur->getMessage());
            }
            

    }


    function listAllproduct(){
        $sql = "SELECT * FROM Product";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($result);
      }   
    

    
      function addProduct($productName, $productCategory, $productPrice,  $productPicture, $productStock){
        $sql = "INSERT INTO Product(productName, productCategory, productPrice, productStock, productPicture) VALUES('$productName', '$productCategory', '$productPrice', '$productStock', '$productPicture')";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        echo "Insertion réussie";

        
      }
      
      function deleteProduct($productId){
        $sql = "DELETE FROM Product WHERE productId = $productId";
        $stmt = $this->connection->prepare($sql);
        if ($stmt->execute()){
          echo 'Product deleted';
        }
        
      }
}