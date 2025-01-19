<?php
include "../ressources/fonction/db_connect.php";

session_start();
$conn = connectDB();

// Traitement du formulaire
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $password = htmlspecialchars($_POST["password"]);
    $confirmed_password = htmlspecialchars($_POST["confirmed_password"]);

    if (empty($password)){
        header("Location: update_password.php?id=1a");
        exit;
    }
    if (empty($confirmed_password)){
        header("Location: update_password.php?id=1b");
        exit;
    }

    if ($password !== $confirmed_password){
        header("Location: update_password.php?id=1c");
        exit;
    }

    // Hachage du mot de passe
    $hashed_password = sha1($password);
    $login = $_SESSION['login'];

    $stmt = $conn->prepare("UPDATE Utilisateurs SET mdp = :hashed_password WHERE login = :login");
    $stmt->bindParam(":hashed_password", $hashed_password);
    $stmt->bindParam(":login", $login);
    $stmt->execute();

    header("Location: ../profile/index.php");
    exit;
}
