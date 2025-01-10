<?php
include "../ressources/fonction/db_connect.php";

session_start();
$conn = connectDB();

// Traitement du formulaire
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $login = htmlspecialchars($_POST["username"]);
    $mdp = $_POST["password"];
    $confirm_mdp = $_POST["confirm-password"];
    $prenom = htmlspecialchars($_POST["first-name"]);
    $nom = htmlspecialchars($_POST["last-name"]);
    $email = htmlspecialchars($_POST["email"]);

    // Vérification des champs
    if ($mdp !== $confirm_mdp) {
        echo "Les mots de passe ne correspondent pas.";
        exit;
    }

    // Vérification si le login existe déjà
    $stmt = $conn->prepare("SELECT util_id, mdp FROM Utilisateurs WHERE login = :login");
    $stmt->bindParam(":login", $login);
    $stmt->execute();

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Hachage du mot de passe
    //$hashed_password = password_hash($mdp, PASSWORD_BCRYPT);

    // Récupération de l'ID de l'utilisateur nouvellement créé
    if($user["mdp"]==$mdp){
        // Stockage des informations utilisateur dans la session
        $_SESSION["util_id"] = $user["util_id"];
        $_SESSION["login"] = $login;

    // Redirection vers la page profil
    header("Location: ../profile/index.php");
    exit;
    }
}
