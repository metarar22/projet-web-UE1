<?php

namespace App\Entity;

use PDO;
use PDOException;


class Cart {
    protected int $productId;
    protected string $productName;
    protected string $productPrice;
    private $connection;

    public function __construct()
    {
        try{
            $connection = new PDO('mysql:host=localhost;dbname=EcoFrume', 'metarar22', 'root');
            }
            catch (PDOException $erreur){
                die('Erreur: ' . $erreur->getMessage());
            }
    }
    

    function listAllCart(){
        $sql = "SELECT * FROM Cart";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($result);
      }   
    
      function getCartByCartId($id){
        $sql = "SELECT * FROM Cart WHERE cartId = $id";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($result);
      }
    
      function getCartByClientId($CId){
        $sql = "SELECT * FROM Cart WHERE cartId = $CId";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($result);
      }
    
      function deleteCart($cartId){
        $sql = "DELETE FROM Cart WHERE cartId = $cartId";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':cartId', $cartId, PDO::PARAM_INT);
        if ($stmt->execute()){
          echo 'Cart deleted';
        }
        
      }
}