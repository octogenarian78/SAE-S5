<?php
// Démarrer la session PHP
session_start();

// Configuration de la base de données
$host = "localhost";
$dbname = "GestionCalculs";
$username = "root"; // Remplace par ton utilisateur MySQL si nécessaire
$password = ""; // Remplace par ton mot de passe MySQL

// Connexion à la base de données
try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

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
    $stmt = $conn->prepare("SELECT login FROM Utilisateurs WHERE login = :login");
    $stmt->bindParam(":login", $login);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        echo "Ce login est déjà utilisé. Veuillez en choisir un autre.";
        exit;
    }

    // Hachage du mot de passe
    $hashed_password = password_hash($mdp, PASSWORD_BCRYPT);

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
        header("Location: ../profil/index.php");
        exit;

    } catch (PDOException $e) {
        echo "Erreur lors de l'inscription : " . $e->getMessage();
    }
}
