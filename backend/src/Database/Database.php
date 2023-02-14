<?php

namespace App\Database;
use PDO;
use PDOException;


//Connection à la DB
try{
    $connection = new PDO('mysql:host=localhost;dbname=EcoFrume', 'metarar22', 'root');
    }
    catch (PDOException $erreur){
        die('Erreur: ' . $erreur->getMessage());
    }

//Creation de la table Product (FRUIT ET LEGUME)
$Query1 = 'CREATE TABLE IF NOT EXISTS Product(
    productId INT AUTO_INCREMENT PRIMARY KEY,
    productName varchar(30) NOT NULL,
    productCategory varchar(30) NOT NULL,
    productPrice INT NOT NULL,
    productStock INT NOT NULL,
    productPicture Text NOT NULL
    )';

$statement1 = $connection->prepare($Query1);
$statement1->execute();

//Creation de la table USER (ADMIN ET CLIENT)
$Query2 = 'CREATE TABLE IF NOT EXISTS User(
    userId INT AUTO_INCREMENT PRIMARY KEY,
    userEmail varchar(50) NOT NULL,
    userPassword varchar(250) NOT NULL,
    userFname varchar(20) NOT NULL,
    userLname varchar(20) NOT NULL,
    userAdress Text NOT NULL,
    userRole INT NOT NULL DEFAULT 0,
    UNIQUE (userEmail)
    )';

$statement2 = $connection->prepare($Query2);
$statement2->execute();

//Creation de la table Panier
$Query3 = 'CREATE TABLE IF NOT EXISTS Cart(
    cartId INT AUTO_INCREMENT PRIMARY KEY,
    clientId INT NOT NULL,
    productId INT NOT NULL,
    amount INT NOT NULL,
    statut Text NOT NULL,
    FOREIGN KEY (clientId)
        REFERENCES User(userId),
    FOREIGN KEY (productId)
        REFERENCES Product(productId)   
    )';

$statement3 = $connection->prepare($Query3);
$statement3->execute();

//Creation de la table Commande
$Query4 = 'CREATE TABLE IF NOT EXISTS OrderSum(
    orderId INT AUTO_INCREMENT PRIMARY KEY,
    cartId INT NOT NULL,
    clientId INT NOT NULL,
    amount INT NOT NULL,
    dateAchat Text NOT NULL,
    statut Text NOT NULL,
    FOREIGN KEY (clientId)
        REFERENCES User(userId),
    FOREIGN KEY (cartId)
        REFERENCES Cart(cartId)
    )';

$statement4 = $connection->prepare($Query4);
$statement4->execute();



//Insertion des données dans la table Produit (Liste des fruits et légumes commercialisés)
$Query5 = 'INSERT INTO Product(productName, productCategory, productPrice, productStock, productPicture) VALUES(:productName, :productCategory, :productPrice, :productStock, :productPicture)';

$Fruits = [
    [
        'productName' => 'Citron',
        'productCategory' => 'Fruit',
        'productPrice' => '3',
        'productStock' => '200',
        'productPicture' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/e/e4/Lemon.jpg/800px-Lemon.jpg?20050214195124'
    ],
    [
        'productName' => 'Orange',
        'productCategory' => 'Fruit',
        'productPrice' => '4',
        'productStock' => '200',
        'productPicture' => 'https://images.pexels.com/photos/161559/background-bitter-breakfast-bright-161559.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1'
    ],
    [
        'productName' => 'Fraise',
        'productCategory' => 'Fruit',
        'productPrice' => '2',
        'productStock' => '200',
        'productPicture' => 'https://www.aprifel.com/wp-content/uploads/2019/02/fraise.jpg'
    ],
    [
        'productName' => 'Framboise',
        'productCategory' => 'Fruit',
        'productPrice' => '2',
        'productStock' => '200',
        'productPicture' => 'https://tous-les-fruits.com/wp-content/uploads/2018/02/framboise.jpg'
    ],
    [
        'productName' => 'Abricot',
        'productCategory' => 'Fruit',
        'productPrice' => '4',
        'productStock' => '200',
        'productPicture' => 'https://st.depositphotos.com/1002351/1330/i/600/depositphotos_13300741-stock-photo-ripe-apricot-fruit.jpg'
    ],
    [
        'productName' => 'Melon',
        'productCategory' => 'Fruit',
        'productPrice' => '6',
        'productStock' => '200',
        'productPicture' => 'https://static.libertyprim.com/files/familles/melon-large.jpg?1574629891'
    ],
    [
        'productName' => 'Pasteque',
        'productCategory' => 'Fruit',
        'productPrice' => '7',
        'productStock' => '200',
        'productPicture' => 'https://africaprofarmer.com/storage/farmProducts/7PWpuwcN9qQVRJO5qTFh2IBJQnxrAXwXK57jJjnl.jpeg'
    ],
    [
        'productName' => 'Pomme',
        'productCategory' => 'Fruit',
        'productPrice' => '3',
        'productStock' => '200',
        'productPicture' => 'https://www.conservation-nature.fr/wp-content/uploads/visuel/fruit/shutterstock_575378506.jpg'
    ],
    [
        'productName' => 'Poire',
        'productCategory' => 'Fruit',
        'productPrice' => '3',
        'productStock' => '200',
        'productPicture' => 'https://www.conservation-nature.fr/wp-content/uploads/visuel/fruit/shutterstock_1482501713.jpg'
    ],
    [
        'productName' => 'Cerise',
        'productCategory' => 'Fruit',
        'productPrice' => '5',
        'productStock' => '200',
        'productPicture' => 'https://img.freepik.com/photos-gratuite/grande-cerise-fond-blanc_1387-556.jpg'
    ],
];

$Legumes = [
    [
        'productName' => 'Carotte',
        'productCategory' => 'Legume',
        'productPrice' => '3',
        'productStock' => '200',
        'productPicture' => 'https://static5.depositphotos.com/1000141/445/i/600/depositphotos_4459708-stock-photo-fresh-carrots.jpg'
    ],
    [
        'productName' => 'Cocombre',
        'productCategory' => 'Legume',
        'productPrice' => '4',
        'productStock' => '200',
        'productPicture' => 'https://beau-insolite.com/wp-content/uploads/2019/07/le-concombre-.jpg'
    ],
    [
        'productName' => 'Tomate',
        'productCategory' => 'Legume',
        'productPrice' => '2',
        'productStock' => '200',
        'productPicture' => 'https://africaprofarmer.com/storage/farmProducts/eWdvRzMYtS7YVkdN0g4kxl5cuJTpJx26FxMz7ZYq.jpeg'
    ],
    [
        'productName' => 'Poivron',
        'productCategory' => 'Legume',
        'productPrice' => '5',
        'productStock' => '200',
        'productPicture' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/d/de/Capsicum_annuum_fruits_IMGP0049.jpg/1200px-Capsicum_annuum_fruits_IMGP0049.jpg'
    ],
    [
        'productName' => 'Salade',
        'productCategory' => 'Legume',
        'productPrice' => '2',
        'productStock' => '200',
        'productPicture' => 'https://courses.monoprix.fr/images-v3/0c44253f-c4a3-4340-9d37-d41e42b9d14a/908b6dec-76d6-4b71-b931-aecf9080095f/500x500.jpg'
    ],
    [
        'productName' => 'Aubergine',
        'productCategory' => 'Legume',
        'productPrice' => '3',
        'productStock' => '200',
        'productPicture' => 'https://static.libertyprim.com/files/varietes/aubergine-graffiti-large.jpg?1569329704'
    ],
    [
        'productName' => 'Courgette',
        'productCategory' => 'Legume',
        'productPrice' => '5',
        'productStock' => '200',
        'productPicture' => 'https://static.libertyprim.com/files/familles/courgette-large.jpg?1569581583'
    ],
    [
        'productName' => 'Oignon',
        'productCategory' => 'Legume',
        'productPrice' => '3',
        'productStock' => '200',
        'productPicture' => 'https://static.libertyprim.com/files/familles/oignon-large.jpg?1569271817'
    ],
    [
        'productName' => 'Poireau',
        'productCategory' => 'Legume',
        'productPrice' => '5',
        'productStock' => '200',
        'productPicture' => 'https://p1.storage.canalblog.com/28/47/1583743/119148878_o.jpg'
    ],
    [
        'productName' => 'Brocoli',
        'productCategory' => 'Legume',
        'productPrice' => '4',
        'productStock' => '200',
        'productPicture' => 'https://static3.depositphotos.com/1001348/132/i/450/depositphotos_1328145-stock-photo-ripe-broccoli-cabbage-isolated-on.jpg'
    ],
];


/*
//Insertion des Fruits 
$statement5 = $connection->prepare($Query5);
foreach($Fruits as $Fruit) {
    $statement5->execute($Fruit);
}

//Insertion des Légumes
$statement6 = $connection->prepare($Query5);
foreach($Legumes as $Legume) {
    $statement6->execute($Legume);
}
*/