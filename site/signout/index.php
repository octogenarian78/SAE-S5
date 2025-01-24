<?php
// Démarre la session
session_start();

// Vérifie si la variable de session "jeton" existe
if (isset($_SESSION["jeton"])) {
    // Supprime le jeton
    unset($_SESSION["jeton"]);
}

// Détruit les données de session
session_destroy();

// Redirection vers la page d'accueil après la déconnexion
header('Location: ../'); 
exit;
?>