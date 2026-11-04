<?php

require_once __DIR__ . '/../utils/autoloader.php';

use Auth\Session;
use Pages\LoginPage;

(new LoginPage(new Session()))->render();

?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HiHi - Connexion</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <header>
        <div class="logo">
            <a href="index.php">LOGO</a>
        </div>
        <!-- Menu de navigation qui s'affichera une fois l'utilisateur connecté, 
             tel que présenté sur les maquettes de l'espace membre -->
        <nav class="user-nav">
            <ul>
                <li><a href="dashboard.php">TABLEAU DE BORD</a></li>
                <li><a href="my_sorority.php">MA SORORITE</a></li>
                <li><a href="members.php">MEMBRES</a></li>
                <li><a href="profile.php">MON PROFIL</a></li>
                <li><a href="logout.php">DECONNEXION</a></li>
            </ul>
        </nav>
    </header>

    <main class="auth-container">
        <h1>CONNEXION</h1>

        <form action="login.php" method="POST" class="auth-form">
            <div class="form-group">
                <label for="identifiant">IDENTIFIANT (E-MAIL OU PSEUDO)</label>
                <input type="text" id="identifiant" name="identifiant" required>
            </div>

            <div class="form-group">
                <label for="mot_de_passe">MOT DE PASSE</label>
                <input type="password" id="mot_de_passe" name="mot_de_passe" required>
            </div>

            <button type="submit" class="btn-primary">SE CONNECTER</button>
        </form>
    </main>
</body>

</html>
