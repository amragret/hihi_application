<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HiHi - Ta Révélation</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <header>
        <div class="logo">
            <a href="index.php">LOGO</a>
        </div>
        <!-- Menu utilisateur connecté -->
        <nav class="user-nav">
            <ul>
                <li><a href="dashboard.php">TABLEAU DE BORD</a></li>
                <li><a href="my_sorority.php" class="active">MA SORORITE</a></li>
                <li><a href="members.php">MEMBRES</a></li>
                <li><a href="profile.php">MON PROFIL</a></li>
                <li><a href="logout.php">DECONNEXION</a></li>
            </ul>
        </nav>
    </header>


    <main class="revelation-container animation-reveal">
        <h1 class="revelation-title">TA HIHI</h1>

        <div class="hihi-showcase">
            <div class="hihi-visual-placeholder">
                <img src="assets/images/hihi-placeholder.png" alt="Visuel de la HiHi" class="hihi-image">
            </div>

            <!-- Nom de la HiHi récupéré depuis la base de données -->
            <h2 class="hihi-name">[ NOM DE LA HIHI ]</h2>
        </div>

        <p class="welcome-message">BIENVENUE DANS TA NOUVELLE SORORITE</p>

        <div class="revelation-actions">
            <a href="dashboard.php" class="btn-primary">ENTRER DANS MA SORORITE</a>

            <form action="send_recap.php" method="POST" class="inline-form">
                <button type="submit" class="btn-secondary">RECAPITULATIF PAR E-MAIL</button>
            </form>
        </div>
    </main>
</body>

</html>
