<?php
include "../ressources/fonction/header.php";
include "../ressources/fonction/db_connect.php";
include "modules.php";

session_start();
// Vérification si l'utilisateur est connecté
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

if (!$user) {
    echo "Erreur : utilisateur introuvable.";
    exit;
}

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

$logoLink = "../";

if (isset($_SESSION["util_id"])){
    $menuButtons[] = "Accueil";
    $menuLinks[] = "../index.php";
    $loginButtons = ["Profil", "Graphique"];
    $loginLinks = ["../profile/index.php", "../graphique/"];
}else{
    $loginButtons = ["Connexion"];
    $loginLinks = ["../signin/index.html"];
}

if (isset($_SESSION["util_id"]) && $user['admin']){
    $menuButtons[] = "Administration";
    $menuLinks[] = "../administration/index.php";
}

echo genererHeader('../ressources/img/logo.png',$menuButtons, $menuLinks, $loginButtons, $loginLinks, $logoLink);
?>
<div class="centered_content">
    <div name="calcul-result" class="calcul-result">
        <table>
            <thead>
            <tr>
                <th>Résultat du Calcul</th>
                <th>Temps</th>
                <th>Nombre de processeur utilisé</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td id="result">Aucun calcul n'a été lancé</td>
                <td id="temps"></td>
                <td id="tab_nbRPI"></td>
            </tr>
            </tbody>
        </table>
    </div>
</div>
<div class="module-select-button">
<?php

$stmt = $conn->prepare("SELECT prog_id, nom_programme FROM Programmes");
$stmt->execute();

// Récupérer toutes les lignes sous forme de tableau associatif
$programmes = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Vérifiez si le tableau est vide
if (empty($programmes)) {
    echo '<p class="btn-module-select">Aucun modules n\'est disponible</p>';
} else {
    foreach ($programmes as $programme) {
        $nomProgramme = str_replace(' ', '', $programme['nom_programme']);
        echo '<a class="btn-module-select" data-programme="' . htmlspecialchars($nomProgramme) . '" id="' . htmlspecialchars($programme['prog_id']) . '">' . htmlspecialchars($programme['nom_programme']) . '</a>';
    }
}
?>
</div>
<div class="popup-overlay"></div>
<?php
// Génération des popups
foreach ($programmes as $programme) {
    $nomProgramme = str_replace(' ', '', $programme['nom_programme']);
    if (function_exists("popup{$nomProgramme}")) {
        echo call_user_func("popup{$nomProgramme}");
    }
}

?>
<script>
const moduleButtons = document.querySelectorAll('.btn-module-select');
const popupOverlay = document.querySelector('.popup-overlay');

moduleButtons.forEach(button => {
    button.addEventListener('click', (e) => {
        e.preventDefault();
        const programme = button.getAttribute('data-programme');
        const popup = document.getElementById(`popup-${programme}`);

        if (popup) {
            popup.style.display = 'block';
            popupOverlay.style.display = 'block';
            const btnOk = popup.querySelector('.btn-ok');
            const btnCancel = popup.querySelector('.btn-cancel');
            
            const numberInput = document.getElementById(`number-${programme}`);
            const nbRPIInput = document.getElementById(`nbRPI-${programme}`);

            // Fermer les popups au clic sur Annuler ou Overlay
            btnCancel.addEventListener('click', () => {
                popup.style.display = 'none';
                popupOverlay.style.display = 'none';
            });
            popupOverlay.addEventListener('click', () => {
                popup.style.display = 'none';
                popupOverlay.style.display = 'none';
            });

            if (btnOk && numberInput && nbRPIInput) {
                btnOk.addEventListener('click', () => {
                    popup.style.display = 'none';
                    popupOverlay.style.display = 'none';

                    const row_result = document.getElementById("result");
                    const row_time = document.getElementById("temps");
                    const row_rpi = document.getElementById("tab_nbRPI");

                    row_result.textContent = "Calcul en cours...";
                    row_time.textContent = "Calcul en cours...";
                    row_rpi.textContent = "Calcul en cours...";

                    fetch('../ressources/fonction/exec_module.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                        },
                        body: `programme=${encodeURIComponent(button.getAttribute("id"))}&number=${encodeURIComponent(numberInput.value)}&nbRPI=${encodeURIComponent(nbRPIInput.value)}`
                    })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                row_result.textContent = parseFloat(data.output.value);
                                row_time.textContent = parseFloat(data.output.temps);
                                row_rpi.textContent = JSON.stringify(data.output.size, null, 2);
                            } else {
                                row_result.textContent = data.message;
                            }
                        })
                        .catch(error => {
                            console.error('Erreur lors de l\'exécution :', error);
                            alert('Une erreur est survenue.');
                        });
                });
            }
        }
    });
});

</script>

</body>
</html>
