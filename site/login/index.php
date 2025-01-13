<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Page de Connexion</title>
    <link rel="stylesheet" href="../ressources/style.css">
</head>
<body class="connexion">
<div class="login-form-container">
    <form class="login-form" action="login.php" method="POST">
        <h2>Connexion</h2>

        <?php
        if(isset($_GET['id'])) {
            echo '<div class="erreur">';
            echo '<p>';
            if ($_GET['id'] == "1a") { echo "ERREUR : Le champ login est vide"; }
            else if ($_GET['id'] == "1b") { echo "ERREUR : Le mot de passe est vide"; }
            else if ($_GET['id'] == "2") { echo "ERREUR : Le champ login ou mot de passe ou les deux sont incorrects"; }
            else { echo "ERREUR : Une erreur est survenue"; }
            echo '</p>';
            echo '</div>';
        }
        ?>

        <div class="input-group">
            <label for="username">Login :</label>
            <input type="text" id="username" name="username" placeholder="Entrez votre login" required>
        </div>

        <div class="input-group">
            <label for="password">Mot de passe :</label>
            <input type="password" id="password" name="password" placeholder="Entrez votre mot de passe" required>
        </div>
        <div class="forgot-password">
            <a href="erreur.html">Mot de passe oublié ?</a>
        </div>

        <br>
        <button type="submit" class="btn-login">Se connecter</button>

        <br><br>
        <div class="sign-up-link">
            <p>Pas de compte ? <a href="../signup/index.php">Inscrivez-vous ici</a></p>
        </div>

    </form>
</div>
</body>
</html>
