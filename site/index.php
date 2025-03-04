<?php
include "ressources/fonction/header.php";
include "ressources/fonction/db_connect.php";

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
    <title>Page d'accueil</title>
    <link rel="stylesheet" href="ressources/style.css">
</head>
<body>
<?php 

$menuButtons = [];
$menuLinks = [];

$logoLink = "#";

if (isset($_SESSION["util_id"])){
    $menuButtons[] = "Modules";
    $menuLinks[] = "modules/index.php";
    $loginButtons = ["Profil", "Déconnexion"];
    $loginLinks = ["profile/index.php", "signout/index.php"];
}else{
    $loginButtons = ["Connexion"];
    $loginLinks = ["login/index.php"];
}

if (isset($_SESSION["util_id"]) && $user['admin']){
    $menuButtons[] = "Administration";
    $menuLinks[] = "administration/index.php";
}

echo genererHeader('ressources/img/logo.png',$menuButtons, $menuLinks, $loginButtons, $loginLinks, $logoLink);
?>
<div class="content">
    <div class="video-description">
        <div class="description">
            <p>Ce site offre une solution rapide et efficace pour le calcul de certains modules mathématiques, notamment la détermination des nombres premiers d'un nombre donné. <br><br> Grâce à une infrastructure distribuée reposant sur un réseau de plusieurs Raspberry Pi (RPI), le site permet de répartir les calculs entre différents nœuds, optimisant ainsi la vitesse et la précision des résultats. <br><br> Lorsqu'une requête est soumise, les calculs sont divisés et traités simultanément par plusieurs Raspberry Pi, offrant ainsi des réponses en un temps réduit, même pour des nombres de grande taille. Cette approche garantit des performances exceptionnelles tout en simplifiant l'accès à des résultats mathématiques complexes.</p>
        </div>
        <div class="video">
            <iframe width="560" height="315" src="https://www.youtube.com/embed/UKRYHQALlAI?si=RteuZWQKMDy-d63F" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>
    </div>
</div>
<?php
if (!isset($_SESSION["util_id"])){
    echo ('
        <div class="signup-button">
            <a href="signup/index.php" class="btn-inscription">S\'inscrire</a>
        </div>'
    );
}

?>
<br><br>
<div class="ten_last_calcul">
    <table>
        <thead>
        <th>Nom Calcul</th>
        <th>Entrée</th>
        <th>Sortie</th>
        </thead>
        <tbody>
        <?php
        // Récupérer les 10 derniers calculs de l'utilisateur
        $stmt = $conn->prepare("SELECT c.entree, c.sortie, p.nom_programme FROM Calculs c, Programmes p WHERE c.prog_id = p.prog_id ORDER BY c.calc_id DESC LIMIT 10");
        $stmt->execute();

        $calculs = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Remplissage dynamique des lignes du tableau
        foreach ($calculs as $calcul) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($calcul["nom_programme"]) . "</td>";
            echo "<td>" . htmlspecialchars($calcul["entree"]) . "</td>";
            echo "<td>" . htmlspecialchars($calcul["sortie"]) . "</td>";
            echo "</tr>";
        }

        // Si aucun calcul n'est trouvé
        if (empty($calculs)) {
            echo "<tr><td colspan='3'>Aucun calcul récent trouvé.</td></tr>";
        }
        ?>
        </tbody>
    </table>
</div>

<div class="manual-button">
    <a href="#" class="btn-manual">Manuel Utilisateur</a>
</div>
<footer>

</footer>
</body>
</html>
