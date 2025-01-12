<?php 
include "../ressources/fonction/header.php";
include "../ressources/fonction/db_connect.php";

session_start();
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
    $menuButtons[] = "Modules";
    $menuLinks[] = "modules/index.php";
    $loginButtons = ["Profil"];
    $loginLinks = ["../profile/index.php"];
}else{
    $loginButtons = ["Connexion"];
    $loginLinks = ["../login/index.html"];
}

echo genererHeader('../ressources/img/logo.png',$menuButtons, $menuLinks, $loginButtons, $loginLinks);
?>
    <div name="connexion-state" class="connexion-state">
        <h3>Status de connexion</h3>
        <div class="table">
            <table>
                <thead>
                    <tr>
                        <th>Architecture</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>RPI Zero 1</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>RPI Zero 2</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>RPI Zero 3</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>RPI Zero 4</td>
                        <td></td>
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