<?php
session_start();
$dbhost = 'localhost';
$dbuser = 'test_ninja';
$dbpassword = 'test1234';
$dbname = 'ecommerce';

//Connect to DB and Check for Connection
try{
    $pdo = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpassword);
    // $pdo = setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e){
    die("Error");
}
?>