<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Page de modification mot de passe</title>
    <link rel="stylesheet" href="../ressources/style.css">
</head>
<body class="connexion">
    <div class="back-button">
        <a href="index.php">Retour</a>
    </div>
    <div class="login-form-container">
        <form class="login-form" action="modif_mdp.php" method="POST">
            <h2>Modifier votre mot de passe</h2>

            <?php
            if(isset($_GET['id'])) {
                echo '<div class="erreur">';
                echo '<p>';
                if ($_GET['id'] == "1a") { echo "ERREUR : Le champ login est vide"; }
                else if ($_GET['id'] == "1b") { echo "ERREUR : Le mot de passe est vide"; }
                else if ($_GET['id'] == "1c") { echo "ERREUR : Le nouveau mot de passe et sa confirmation sont différents "; }
                else if ($_GET['id'] == "1d") { echo "ERREUR : L'ancien mot de passe est vide est vide"; }
                else if ($_GET['id'] == "2") { echo "ERREUR : L'ancien mot de passe et le nouveau sont identiques"; }
                else if ($_GET['id'] == "3") { echo "ERREUR : L'ancien mot de passe est incorrect"; }
                else { echo "ERREUR : Une erreur est survenue"; }
                echo '</p>';
                echo '</div>';
            }
            ?>
            <div class="input-group">
                <label for="password">Ancien mot de passe :</label>
                <input type="password" id="ancien_password" name="ancien_password" placeholder="Entrez l'ancien mot de passe" required>
                <br><br>
                <label for="password">Nouveau mot de passe :</label>
                <input type="password" id="password" name="password" placeholder="Entrez votre mot de passe" required>
                <br><br>
                <label for="password">Confimer votre mot de passe :</label>
                <input type="password" id="confirmed_password" name="confirmed_password" placeholder="Confirmer votre mot de passe" required>
            </div>
            <button type="submit" class="btn-login">Modifier</button>
        </form>
    </div>
</body>
</html>
