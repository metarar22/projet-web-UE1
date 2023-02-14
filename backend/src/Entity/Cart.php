<?php

namespace App\Entity;

use PDO;
use PDOException;


class Cart {
    protected int $productId;
    protected string $productName;
    protected string $productPrice;

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
    
      function getCartByClientId($CId){
        global $connection;
        $sql = "SELECT * FROM Cart WHERE cartId = $CId";
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
}