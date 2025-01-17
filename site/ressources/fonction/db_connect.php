<?php

function connectDB(){
    // Connexion à la base de données
    $host = "localhost";
    $dbname = "GestionCalculs";
    $username = "root"; // Remplace par ton utilisateur MySQL si nécessaire
    $password = ""; // Remplace par ton mot de passe MySQL

    try {
        $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die("Erreur de connexion : " . $e->getMessage());
    }
    return $conn;
}