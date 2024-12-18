<?php
session_start();

// Vérification si l'utilisateur est connecté
if (!isset($_SESSION["util_id"])) {
    // Rediriger vers la page de connexion si l'utilisateur n'est pas connecté
    header("Location: ../login/index.html");
    exit;
}

// Connexion à la base de données
$host = "localhost";
$dbname = "GestionCalculs";
$username = "root"; // Remplace par ton utilisateur MySQL si nécessaire
$password = ""; // Remplace par ton mot de passe MySQL

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

// Récupération des informations utilisateur depuis la base de données
$util_id = $_SESSION["util_id"];
$stmt = $conn->prepare("SELECT login, mdp FROM Utilisateurs WHERE util_id = :util_id");
$stmt->bindParam(":util_id", $util_id, PDO::PARAM_INT);
$stmt->execute();

$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    echo "Erreur : utilisateur introuvable.";
    exit;
}

// Remplissage des données dynamiques
$login = htmlspecialchars($user["login"]); // Le login de l'utilisateur
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Profil de <?php echo $login; ?></title>
    <link rel="stylesheet" href="../ressources/style.css">
</head>
<body class="profil">
<header>
    <nav class="nav">
        <a href="../index.html">
            <div name="logo" class="logo">
                <img src="../ressources/img/logo.png" alt="logo du site">
            </div>
        </a>
        <div name="menu" class="menu">
            <a href="../administration/index.html">Administration</a>
            <a href="../modules/index.html">Modules</a>
        </div>
        <div name="login" class="login">
            <a href="../index.html">Accueil</a>
        </div>
    </nav>
</header>
<div class="container-profil">
    <div class="profile-item">
        <span class="label">Nom d'utilisateur:</span>
        <span id="nom"><?php echo $login; ?></span>
    </div>
    <div class="profile-item">
        <span class="label">Mot de passe:</span>
        <span id="mdp">******</span>
        <button class="button">Modifier</button>
    </div>
</div>
<div name="ten_last_calcul" class="ten_last_calcul">
    <table>
        <thead>
            <tr>
                <th>Nom Calcul</th>
                <th>Entrée</th>
                <th>Sortie</th>
            </tr>
        </thead>
        <tbody>
        <?php
        // Récupérer les 10 derniers calculs de l'utilisateur
        $stmt = $conn->prepare("SELECT programme, entree, sortie FROM Calculs WHERE util_id = :util_id ORDER BY calc_id DESC LIMIT 10");
        $stmt->bindParam(":util_id", $util_id, PDO::PARAM_INT);
        $stmt->execute();

        $calculs = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Remplissage dynamique des lignes du tableau
        foreach ($calculs as $calcul) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($calcul["programme"]) . "</td>";
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
</body>
</html>
