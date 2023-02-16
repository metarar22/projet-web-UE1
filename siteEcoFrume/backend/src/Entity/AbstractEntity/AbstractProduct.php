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

    protected $connection;



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
    
      function getProductById($id){
        $sql = "SELECT * FROM Product WHERE productId = $id";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($result);
      }
    
      function getProductByName($name){
        $sql = "SELECT * FROM Product WHERE productName = $name";
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
