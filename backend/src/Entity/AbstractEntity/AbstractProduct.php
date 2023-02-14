<?php

namespace App\Entity\AbstractEntity;

use PDO;
use PDOException;

Abstract class AbstractProduct {
    protected int $productId;
    protected string $productName;
    protected string $productCategory;
    protected int $productPrice;
    protected int $productStock;
    protected string $productPicture;




    /**
     * Get the value of productId
     */ 
    public function getProductId()
    {
        return $this->productId;
    }

    /**
     * Set the value of productId
     *
     * @return  self
     */ 
    public function setProductId($productId)
    {
        $this->productId = $productId;

        return $this;
    }

    /**
     * Get the value of productName
     */ 
    public function getProductName()
    {
        return $this->productName;
    }

    /**
     * Set the value of productName
     *
     * @return  self
     */ 
    public function setProductName($productName)
    {
        $this->productName = $productName;

        return $this;
    }

    /**
     * Get the value of productCategory
     */ 
    public function getProductCategory()
    {
        return $this->productCategory;
    }

    /**
     * Set the value of productCategory
     *
     * @return  self
     */ 
    public function setProductCategory($productCategory)
    {
        $this->productCategory = $productCategory;

        return $this;
    }

    /**
     * Get the value of productPrice
     */ 
    public function getProductPrice()
    {
        return $this->productPrice;
    }

    /**
     * Set the value of productPrice
     *
     * @return  self
     */ 
    public function setProductPrice($productPrice)
    {
        $this->productPrice = $productPrice;

        return $this;
    }

    /**
     * Get the value of productStock
     */ 
    public function getProductStock()
    {
        return $this->productStock;
    }

    /**
     * Set the value of productStock
     *
     * @return  self
     */ 
    public function setProductStock($productStock)
    {
        $this->productStock = $productStock;

        return $this;
    }

    /**
     * Get the value of productPicture
     */ 
    public function getProductPicture()
    {
        return $this->productPicture;
    }

    /**
     * Set the value of productPicture
     *
     * @return  self
     */ 
    public function setProductPicture($productPicture)
    {
        $this->productPicture = $productPicture;

        return $this;
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
    
}