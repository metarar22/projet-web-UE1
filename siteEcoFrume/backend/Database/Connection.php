<?php 

namespace App\Database;

use PDO;
use PDOException;

Class Connection{
    private $connection;


    public function getConnection()
    {
        try{
            $this->connection = new PDO('mysql:host=localhost;dbname=EcoFrume', 'metarar22', 'root');
            }
            catch (PDOException $erreur){
                die('Erreur: ' . $erreur->getMessage());
            }
    }
}

?>

