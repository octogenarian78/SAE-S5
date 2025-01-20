<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Page d'Inscription</title>
    <link rel="stylesheet" href="../ressources/style.css">
</head>
<body class="inscription">
<div class="signup-form-container">
    <form class="signup-form" action="signup.php" method="POST">
        <h2>Inscription</h2>

        <?php
        if(isset($_GET['id'])) {
            echo '<div class="erreur">';
            echo '<p>';
            if ($_GET['id'] == "1") { echo "ERREUR : Les champs mot de passe et confirmation du mot de passe sont différents"; }
            else if ($_GET['id'] == "2") { echo "ERREUR : L'utilisateur est déjà présent dans la base de données'"; }
            else if ($_GET['id'] == "4") { echo "ERREUR : Une erreur est survenue dans la base de données"; }
            else if ($_GET['id'] == "5") { echo "ERREUR : Le captcha est incorrect"; }
            else { echo "ERREUR : Une erreur est survenue"; }
            echo '</p>';
            echo '</div>';
        }
        ?>
        
        <div class="form-content">
            <div class="left-column">
                <div class="input-group">
                    <label for="username">Login :</label>
                    <input type="text" id="username" name="username" placeholder="Entrez votre login" required>
                </div>

                <div class="input-group">
                    <label for="password">Mot de passe :</label>
                    <input type="password" id="password" name="password" placeholder="Entrez votre mot de passe" required>
                </div>

                <div class="input-group">
                    <label for="confirm-password">Confirmation du mot de passe :</label>
                    <input type="password" id="confirm-password" name="confirm-password" placeholder="Confirmez votre mot de passe" required>
                </div>
            </div>

            <div class="right-column">
                <div class="input-group">
                    <label for="first-name">Prénom :</label>
                    <input type="text" id="first-name" name="first-name" placeholder="Entrez votre prénom" required>
                </div>

                <div class="input-group">
                    <label for="last-name">Nom :</label>
                    <input type="text" id="last-name" name="last-name" placeholder="Entrez votre nom" required>
                </div>

                <div class="input-group">
                    <label for="email">Email :</label>
                    <input type="email" id="email" name="email" placeholder="Entrez votre email" required>
                </div>
            </div>
        </div>

        <div class="input-group captcha-group">
            <label for="captcha">Captcha : <?php echo $num1 . " + " . $num2; ?> = ?</label>
            <input type="text" id="captcha" name="captcha" required>
        </div>

        <br>
        <button type="submit" class="btn-signup">S'inscrire</button>

        <br><br>
        <div class="login-link">
            <p>Déjà un compte ? <a href="../login/index.php">Connectez-vous ici</a></p>
        </div>
    </form>
</div>
</body>
</html>
