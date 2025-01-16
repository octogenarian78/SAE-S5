<?php
include "../ressources/fonction/header.php";
include "../ressources/fonction/db_connect.php";

session_start();
$conn = connectDB();

if (isset($_SESSION["util_id"])) {
    $util_id = $_SESSION["util_id"];
    $stmt = $conn->prepare("SELECT admin FROM Utilisateurs WHERE util_id = :util_id");
    $stmt->bindParam(":util_id", $util_id, PDO::PARAM_INT);
    $stmt->execute();

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        echo "Erreur : utilisateur introuvable.";
        exit;
    }
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="../ressources/style.css">
    <style>
        body{
            overflow-x: hidden;
            overflow-y: hidden;
        }
    </style>
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
<div class="chartContainer">
    <div class="prime">
        <div id="ScalaFortePrime" class="forte" style="width: 975px; height: 420px;"></div>
        <div id="ScalaFaiblePrime" class="faible" style="width: 975px; height: 420px;"></div>
    </div>
    <div class="montecarlo">
        <div id="ScalaForteMonte" class="forte" style="width: 975px; height: 420px;"></div>
        <div id="ScalaFaibleMonte" class="faible" style="width: 975px; height: 420px;"></div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/echarts@5.2.2/dist/echarts.min.js"></script>
<script src="../ressources/script/graphique.js"></script>

<footer>

</footer>
</body>
</html>
