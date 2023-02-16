<?php 

namespace App\Database;

use PDO;

Abstract Class Connection{
    private static $instance = null;
    private const PDO_OPTIONS = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ];

    public static function getConnection() : PDO
    {
        if(self::$instance === null) {
            self::$instance = new PDO('mysql:host=localhost;dbname=EcoFrume', 'metarar22', 'root', self::PDO_OPTIONS);
        }
        return self::$instance;
    }
}

?>

