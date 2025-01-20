<?php
include "../ressources/fonction/db_connect.php";

session_start();
$conn = connectDB();

if (!isset($_SESSION['captcha_result'])) {
    $num1 = rand(1, 10); 
    $num2 = rand(1, 10);  
    $_SESSION['captcha_num1'] = $num1;
    $_SESSION['captcha_num2'] = $num2;
    $_SESSION['captcha_result'] = $num1 + $num2;  
}

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

    // Vérification des champs
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