<?php

session_start(); 

include "../ressources/fonction/db_connect.php";
$conn = connectDB();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $captcha_answer = $_POST["captcha"];
    if ($captcha_answer != $_SESSION['captcha_result']) {
        header("Location: index.php?id=5"); // Erreur si le captcha est incorrect
        exit;
    }

    $login = htmlspecialchars($_POST["username"]);
    $mdp = $_POST["password"];
    $confirm_mdp = $_POST["confirm-password"];
    $prenom = htmlspecialchars($_POST["first-name"]);
    $nom = htmlspecialchars($_POST["last-name"]);
    $email = htmlspecialchars($_POST["email"]);

    // Vérification des longueurs pour login, prénom, nom
    if (strlen($login) < 5 || strlen($login) > 12) {
        header("Location: index.php?id=6"); // Erreur si login n'est pas entre 5 et 12 caractères
        exit;
    }
    if (strlen($prenom) < 5 || strlen($prenom) > 12) {
        header("Location: index.php?id=7"); // Erreur si prénom n'est pas entre 5 et 12 caractères
        exit;
    }
    if (strlen($nom) < 5 || strlen($nom) > 12) {
        header("Location: index.php?id=8"); // Erreur si nom n'est pas entre 5 et 12 caractères
        exit;
    }

    if (!preg_match('/^[\w\.-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/', $email) || strlen(substr(strrchr($email, '@'), 1)) < 4 || strlen(substr(strrchr($email, '.'), 1)) < 2) {
        header("Location: index.php?id=10"); // Erreur si l'email ne respecte pas les critères
        exit;
    }
    
   // Vérification du mot de passe (doit contenir 1 minuscule, 1 majuscule, 1 caractère spécial, 1 chiffre et entre 12 et 32 caractères)
    if (strlen($mdp) < 12 || strlen($mdp) > 32 || !preg_match('/[a-z]/', $mdp) || !preg_match('/[A-Z]/', $mdp) || !preg_match('/[\W_]/', $mdp) || !preg_match('/\d/', $mdp)) {
        header("Location: index.php?id=9"); // Erreur si mot de passe ne respecte pas les critères
        exit;
    }

    // Vérification que le mot de passe et la confirmation sont identiques
    if ($mdp !== $confirm_mdp) {
        header("Location: index.php?id=1");
        exit;
    }

    // Vérification si le login existe déjà
    $stmt = $conn->prepare("SELECT login FROM Utilisateurs WHERE login = :login");
    $stmt->bindParam(":login", $login);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        header("Location: index.php?id=2");
        exit;
    }

    // Hachage du mot de passe
    $hashed_password = sha1($mdp);

    // Insertion dans la base de données
    $stmt = $conn->prepare("INSERT INTO Utilisateurs (login, mdp) VALUES (:login, :mdp)");
    $stmt->bindParam(":login", $login);
    $stmt->bindParam(":mdp", $hashed_password);

    try {
        $stmt->execute();

        // Récupération de l'ID de l'utilisateur nouvellement créé
        $util_id = $conn->lastInsertId();

        // Stockage des informations utilisateur dans la session
        $_SESSION["util_id"] = $util_id;
        $_SESSION["login"] = $login;

        // Redirection vers la page profil
        header("Location: ../profile/index.php");
        exit;

    } catch (PDOException $e) {
        header("Location: index.php?id=4");
        exit;
    }
}
?>