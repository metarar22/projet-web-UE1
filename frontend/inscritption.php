<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/bootstrap.css">
    <link rel="stylesheet" href="./css/style.css">
    <title>Shop EcoFrume</title>
</head>
<body>
    <body>
        <header>
            <div class="logo"> <span>Eco</span>Frume</div>
            <ul class="menu">
                <a href="./index.html">Acceuil</a>
                <a href="./inscritption.php">Inscription</a>
                <a href="./Connection.php">Connection</a>
                <a href="./Boutique.html">Nos Produits</a>
                <a href="">Panier</a>
            </ul>
        </header>


        <form class="row g-3 needs-validation" novalidate method="POST" action="">
        <div class="col-md-3">
            <label for="validationCustom01" class="form-label">First name</label>
            <input type="text" class="form-control" id="validationCustom01" value="Prenom" name="userFname" required>
            <div class="valid-feedback">
            Looks good!
            </div>
        </div>
            <div class="col-md-3">
                <label for="validationCustom02" class="form-label">Last name</label>
                <input type="text" class="form-control" id="validationCustom02" value="Nom" name="userLname" required>
                <div class="valid-feedback">
                Looks good!
                </div>
            </div>
            <div class="col-md-3">
                <label for="validationCustomUsername" class="form-label">Username</label>
                <div class="input-group has-validation">
                <span class="input-group-text" id="inputGroupPrepend">email@</span>
                <input type="text" class="form-control" id="validationCustomUsername" aria-describedby="inputGroupPrepend" name="userEmail" required>
                <div class="invalid-feedback">
                    Please choose a username.
                </div>
            </div>
            </div>
            <div class="col-md-4">
                <label for="validationCustom03" class="form-label">Password</label>
                <input type="text" class="form-control" id="validationCustom03" name="userPassword" required>
                <div class="invalid-feedback">
                Please provide a valid city.
                </div>
            </div>

            <div class="col-md-5">
                <label for="validationCustom03" class="form-label">Adress</label>
                <input type="text" class="form-control" id="validationCustom03" name="userAdress" required>
                <div class="invalid-feedback">
                Please provide a valid city.
                </div>
            </div>

            </div>
            <div class="col-12">
                <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="invalidCheck" name="terms" required>
                <label class="form-check-label" for="invalidCheck">
                    Agree to terms and conditions
                </label>
                <div class="invalid-feedback">
                    You must agree before submitting.
                </div>
                </div>
            </div>
            <div class="col-12">
            <button class="btn btn-primary" type="submit">S'inscrire</button>
            </div>
            </form>


        
        <div class="end"></div>
</body>
</html>


<?php
try{
    $connection = new PDO('mysql:host=localhost;dbname=EcoFrume', 'metarar22', 'root');
    }
    catch (PDOException $erreur){
        die('Erreur: ' . $erreur->getMessage());
    }

  
    $userEmail = $_POST["userEmail"];
    $userPassword = password_hash($_POST["userPassword"], PASSWORD_DEFAULT);
    $userFname = $_POST["userFname"];
    $userLname = $_POST["userLname"];
    $userAdress = $_POST["userAdress"];
    
    $sql = "INSERT INTO User(userEmail, userPassword, userFname, userLname, userAdress) VALUES('$userEmail', '$userPassword', '$userFname', '$userLname', '$userAdress')";
    $stmt = $connection->prepare($sql);
    if ($stmt->execute()) {
        echo "Bienvenue !";
    }else {
        echo "Veuillez réessayer";
        die('Erreur: ' . $erreur->getMessage());
    }
?>
