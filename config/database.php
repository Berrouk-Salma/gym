<?php
// config/database.php

$host = 'localhost';
$dbname = 'GYM';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Set default fetch mode to associative array
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    // Set character set to UTF-8
    $pdo->exec("SET NAMES utf8");
    
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    die();
}
?>