<?php
include "../ressources/fonction/header.php";
include "../ressources/fonction/db_connect.php";

session_start();
$conn = connectDB();

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

$menuButtons = [];
$menuLinks = [];

if (isset($_SESSION["util_id"])){
    $menuButtons[] = "Accueil";
    $menuLinks[] = "../index.php";
    $loginButtons = ["Profil"];
    $loginLinks = ["profile/index.php"];
}else{
    $loginButtons = ["Connexion"];
    $loginLinks = ["../signin/index.html"];
}

if (isset($_SESSION["util_id"]) && $user['admin']){
    $menuButtons[] = "Administration";
    $menuLinks[] = "../administration/index.php";
}

echo genererHeader('../ressources/img/logo.png',$menuButtons, $menuLinks, $loginButtons, $loginLinks);
?>
<div class="centered_content">
    <div name="calcul-result" class="calcul-result">
        <table>
            <thead>
            <tr><th>Résultat du Calcul</th></tr>
            </thead>
            <tbody>
            <tr><td>123456.789</td></tr>
            </tbody>
        </table>
    </div>
</div>
<div class="module-select-button">
<?php

$stmt = $conn->prepare("SELECT nom_programme FROM Programmes");
$stmt->execute();

$programmes = $stmt->fetch(PDO::FETCH_ASSOC);

foreach ($programme as $programmes) {
    echo '<a href="#" class="btn-module-select">'. $programme["nom_programme"] .'</a>';
}

?>
</div>

<!-- Popup et overlay -->
<div class="popup-overlay"></div>
<div class="popup">
    <div class="popup-title">Entrée(s) du programme</div>
    <p>Entrez un chiffre :</p>
    <input type="number" placeholder="Exemple : 42">
    <div class="popup-buttons">
        <a href="#" class="btn-ok">OK</a>
        <a href="#" class="btn-cancel">Annuler</a>
    </div>
</div>

<script>
    // Sélection des éléments
    const moduleButtons = document.querySelectorAll('.btn-module-select');
    const popup = document.querySelector('.popup');
    const popupOverlay = document.querySelector('.popup-overlay');
    const btnOk = document.querySelector('.btn-ok');
    const btnCancel = document.querySelector('.btn-cancel');

    // Fonction pour ouvrir le popup
    const openPopup = () => {
        popup.style.display = 'block';
        popupOverlay.style.display = 'block';
    };

    // Fonction pour fermer le popup
    const closePopup = () => {
        popup.style.display = 'none';
        popupOverlay.style.display = 'none';
    };

    // Attacher les événements d'ouverture aux boutons module
    moduleButtons.forEach(button => {
        button.addEventListener('click', (e) => {
            e.preventDefault(); // Empêche la redirection
            openPopup();
        });
    });

    // Attacher les événements de fermeture aux boutons OK et Annuler
    btnOk.addEventListener('click', closePopup);
    btnCancel.addEventListener('click', closePopup);

    // Fermer le popup si on clique en dehors
    popupOverlay.addEventListener('click', closePopup);
</script>

</body>
</html>