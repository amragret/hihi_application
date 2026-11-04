<?php

require_once __DIR__ . '/../utils/autoloader.php';

use Auth\Session;
use Pages\RegisterPage;

(new RegisterPage(new Session()))->render();

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HiHi - Inscription</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <header>
        <div class="logo">
            <a href="index.php">LOGO</a>
        </div>
    </header>

    <main class="auth-container">
        <h1>INSCRIPTION</h1>

        <form action="signup.php" method="POST" class="auth-form">
            <div class="form-group">
                <label for="pseudo">PSEUDO</label>
                <input type="text" id="pseudo" name="pseudo" required>
            </div>

            <div class="form-group">
                <label for="email">ADRESSE E-MAIL</label>
                <input type="email" id="email" name="email" required>
            </div>

            <div class="form-group">
                <label for="mot_de_passe">MOT DE PASSE</label>
                <input type="password" id="mot_de_passe" name="mot_de_passe" required>
            </div>

            <button type="submit" class="btn-primary">S'INSCRIRE</button>
        </form>
    </main>
</body>

</html>
