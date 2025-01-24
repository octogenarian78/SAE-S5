<?php
include "../ressources/fonction/db_connect.php";

session_start();
$conn = connectDB();

// Traitement du formulaire
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $password = htmlspecialchars($_POST["password"]);
    $confirmed_password = htmlspecialchars($_POST["confirmed_password"]);
    $ancien_password = htmlspecialchars($_POST["ancien_password"]);

    if (empty($ancien_password)){
        header("Location: update_password.php?id=1d");
        exit;
    }
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

    // Vérifier que l'ancien mot de passe est correct
    $login = $_SESSION['login'];
    $stmt = $conn->prepare("SELECT mdp FROM Utilisateurs WHERE login = :login");
    $stmt->bindParam(":login", $login);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user || sha1($ancien_password) !== $user['mdp']) {
        header("Location: update_password.php?id=3");
        exit;
    }

    // Vérifier que le nouveau mot de passe est différent de l'ancien
    if (sha1($ancien_password) === sha1($password)) {
        header("Location: update_password.php?id=2");
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
