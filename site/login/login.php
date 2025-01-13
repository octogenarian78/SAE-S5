<?php
include "../ressources/fonction/db_connect.php";

session_start();
$conn = connectDB();

// Traitement du formulaire
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $login = htmlspecialchars($_POST["username"]);
    $mdp = htmlspecialchars($_POST["password"]);

    if (empty($login)){
        header("Location: index.html?error=1a");
        exit;
    }
    if (empty($mdp)){
        header("Location: index.html?error=1b");
        exit;
    }
   
    // Vérification si le login existe déjà
    $stmt = $conn->prepare("SELECT util_id, mdp FROM Utilisateurs WHERE login = :login");
    $stmt->bindParam(":login", $login);
    $stmt->execute();

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Hachage du mot de passe
    $hashed_password = sha1($mdp);

    if($user["mdp"]!=$hashed_password){
        header("Location: index.html?error=2");
        exit;
    }

    $_SESSION["util_id"] = $user["util_id"];
    $_SESSION["login"] = $login;

    header("Location: ../profile/index.php");
    exit;
}
