<?php
include "../ressources/fonction/header.php";
include "../ressources/fonction/db_connect.php";
include "../ressources/fonction/rpi_statut.php";

session_start();
if (!isset($_SESSION["util_id"])) {
    // Rediriger vers la page de connexion si l'utilisateur n'est pas connecté
    header("Location: ../login/index.php");
    exit;
}

$conn = connectDB();

$util_id = $_SESSION["util_id"];
$stmt = $conn->prepare("SELECT admin FROM Utilisateurs WHERE util_id = :util_id");
$stmt->bindParam(":util_id", $util_id, PDO::PARAM_INT);
$stmt->execute();

$user = $stmt->fetch(PDO::FETCH_ASSOC);
// Récupération des statuts des RPI
$statuses = getRpiStatus();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="../ressources/style.css">
</head>
<body>
<?php

$menuButtons = ["Accueil", "Modules"];
$menuLinks = ["../index.php", "../modules/index.php"];

$logoLink = "../";

$loginButtons = ["Profil"];
$loginLinks = ["../profile/index.php"];

echo genererHeader('../ressources/img/logo.png', $menuButtons, $menuLinks, $loginButtons, $loginLinks, $logoLink);
?>
<div name="connexion-state" class="connexion-state">
    <h3>Statut de connexion</h3>
    <div class="table">
        <table>
            <thead>
            <tr>
                <th>Architecture</th>
                <th>Statut</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>RPI Zero 1</td>
                <td style="background-color: <?= getStatusColor(isset($statuses["p1"]) ? $statuses["p1"] : "Inconnu") ?>;">
                    <?= isset($statuses["p1"]) ? $statuses["p1"] : "Inconnu" ?>
                </td>
            </tr>
            <tr>
                <td>RPI Zero 2</td>
                <td style="background-color: <?= getStatusColor(isset($statuses["p2"]) ? $statuses["p2"] : "Inconnu") ?>;">
                    <?= isset($statuses["p2"]) ? $statuses["p2"] : "Inconnu" ?>
                </td>
            </tr>
            <tr>
                <td>RPI Zero 3</td>
                <td style="background-color: <?= getStatusColor(isset($statuses["p3"]) ? $statuses["p3"] : "Inconnu") ?>;">
                    <?= isset($statuses["p3"]) ? $statuses["p3"] : "Inconnu" ?>
                </td>
            </tr>
            <tr>
                <td>RPI Zero 4</td>
                <td style="background-color: <?= getStatusColor(isset($statuses["p4"]) ? $statuses["p4"] : "Inconnu") ?>;">
                    <?= isset($statuses["p4"]) ? $statuses["p4"] : "Inconnu" ?>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</div>
<?php
$total_space = disk_total_space("/");
$free_space = disk_free_space("/");

$used_space = $total_space - $free_space;

// Conversion en Go
$total_space_gb = $total_space / (1024 ** 3);
$free_space_gb = $free_space / (1024 ** 3);
$used_space_gb = $used_space / (1024 ** 3);

// Calcul du pourcentage utilisé
$used_percentage = ($used_space / $total_space) * 100;

$color = "green";
if ($used_percentage >= 70){
    $color = "#d1d22e";
}
if ($used_percentage >= 90){
    $color = "#ad1328";
}
?>
<div name="stockage-restant" class="stockage">
    <h3>Stockage disponible</h3>
    <div class="progress-container">
        <div class="progress-bar" id="progressBar" style="width: <?= $used_percentage ?>%; background-color: <?= $color ?>;"></div>
        <div class="progress-text">
            <?= round($used_percentage, 2) ?>%
        </div>
    </div>
    <a href="#">Supprimer</a>
</div>
</body>
</html>

<?php
// Fonction pour retourner la couleur en fonction du statut du RPI
function getStatusColor($status) {
    switch ($status) {
        case "Déconnecté":
            return "red"; // Rouge
        case "Connecté":
            return "green"; // Vert
        case "En cours d'utilisation":
            return "yellow"; // Jaune
        case "Usage incertain":
            return "orange"; // Orange
        default:
            return "gray"; // Gris (Inconnu)
    }
}
?>
