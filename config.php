<?php
require __DIR__.'/vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

function getConnection() {
    $con = mysqli_connect($_ENV['MYSQL_HOST'], $_ENV['MYSQL_USER'],$_ENV['MYSQL_PASS'], $_ENV['MYSQL_DB']);	
    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
        exit;
    }
    return $con;
} 
?>
