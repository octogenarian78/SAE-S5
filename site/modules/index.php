<?php
include "../ressources/fonction/header.php";
include "../ressources/fonction/db_connect.php";
include "modules.php";

session_start();
// Vérification si l'utilisateur est connecté
if (!isset($_SESSION["util_id"])) {
    // Rediriger vers la page de connexion si l'utilisateur n'est pas connecté
    header("Location: ../login/index.html");
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
            <tr><td id="result">123456.789</td></tr>
            </tbody>
        </table>
    </div>
</div>
<div class="module-select-button">
<?php

$stmt = $conn->prepare("SELECT id_prog, nom_programme FROM Programmes");
$stmt->execute();

// Récupérer toutes les lignes sous forme de tableau associatif
$programmes = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Vérifiez si le tableau est vide
if (empty($programmes)) {
    echo '<a class="btn-module-select">Aucun modules n\'est disponible</a>';
} else {
    foreach ($programmes as $programme) {
        $nomProgramme = str_replace(' ', '', $programme['nom_programme']);
        echo '<a class="btn-module-select" data-programme="' . htmlspecialchars($nomProgramme) . '">' . htmlspecialchars($programme['nom_programme']) . '</a>';
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

    moduleButtons.forEach(button => {
        button.addEventListener('click', (e) => {
            e.preventDefault();
            const programme = button.getAttribute('data-programme');
            const popup = document.getElementById(`popup-${programme}`);
            const popupOverlay = document.querySelector('.popup-overlay');

            if (popup) {
                popup.style.display = 'block';
                popupOverlay.style.display = 'block';
            }

            // Fermer les popups au clic sur l'overlay
            popupOverlay.addEventListener('click', () => {
                popup.style.display = 'none';
                popupOverlay.style.display = 'none';
            });

            // Attacher les événements pour les boutons OK et Annuler
            const btnOk = popup.querySelector('.btn-ok');
            const btnCancel = popup.querySelector('.btn-cancel');
            if (btnOk && btnCancel) {
                // Bouton Annuler : fermer le popup
                btnCancel.addEventListener('click', () => {
                    popup.style.display = 'none';
                    popupOverlay.style.display = 'none';
                });

                // Bouton OK : envoyer la requête AJAX
                btnOk.addEventListener('click', () => {
                    popup.style.display = 'none';
                    popupOverlay.style.display = 'none';
                    const row_result = document.getElementById("result")
                    row_result.textContent = "Calcul en cours..."
                    fetch('../ressources/fonction/exec_module.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                        },
                        body: `programme=${encodeURIComponent(programme)}`
                    })
                        .then(response => {
                            return response.json();
                        })
                        .then(data => {
                            if (data.success) {
                                row_result.textContent = data.output;
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
        });
    });

</script>

</body>
</html>