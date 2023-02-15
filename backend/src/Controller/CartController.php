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


public function addProductToCart(int $productId){
    $Query = "INSERT INTO Cart (productId, productName, productPrice)
    SELECT productId, productName, productPrice FROM Product WHERE productId = $productId ";
    $statement = $this->connection->prepare($Query);
    $statement->execute();
    return "Product added to cart" . PHP_EOL;
    
}
public function remProductFromCart(int $productId){
    $Query = "DELETE FROM Cart WHERE productId = $productId ";
    $statement = $this->connection->prepare($Query);
    $statement->execute();
    return "Product added to cart" . PHP_EOL;
}
public function EmptyCart(){
    $Query = "DELETE * FROM Cart";
    $statement = $this->connection->prepare($Query);
    $statement->execute();
    return "Product added to cart" . PHP_EOL;
}

public function Chekout(){
    $Query = "SELECT SUM(productPrice) FROM Cart";
    $statement = $this->connection->prepare($Query);
    $statement->execute();
    var_dump($statement);
    return "Régler votre total" . PHP_EOL;
    $this->EmptyCart();
}

public function listProduct(){
    $Query = "SELECT * FROM Cart";
    $statement = $this->connection->prepare($Query);
    $statement->execute();

}

}

