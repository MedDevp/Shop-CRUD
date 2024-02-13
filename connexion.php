<?php

$username = "root";
$password = "";
$DataBase = "dbcrud";
try{
    $connexion = new PDO("mysql:host=localhost;dbname=$DataBase", $username, $password);
    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

}catch(PDOException $e){
    echo "Erreur de connexion : " . $e->getMessage();
}

