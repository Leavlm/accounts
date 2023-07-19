<?php
use Dotenv\Dotenv;
require 'vendor/autoload.php';
$dotenv = Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();

$host = $_ENV['DB_HOST'];
$user = $_ENV['DB_USER'];
$password = $_ENV['DB_PASSWORD'];
try {
    $dbCo = new PDO($host, $user, $password);

require 'vendor/autoload.php';

    $dbCo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,
    PDO::FETCH_ASSOC);
   }

   catch (Exception $e) {
    die('Unable to connect to the database.
    '.$e->getMessage());
    }


?>