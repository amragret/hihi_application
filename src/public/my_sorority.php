<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HiHi - Ma Sororité</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <header>
        <div class="logo">
            <a href="index.php">LOGO</a>
        </div>
        <nav class="user-nav">
            <ul>
                <li><a href="dashboard.php">TABLEAU DE BORD</a></li>
                <li><a href="ma_sororite.php" class="active">MA SORORITE</a></li>
                <li><a href="members.php">MEMBRES</a></li>
                <li><a href="profile.php">MON PROFIL</a></li>
                <li><a href="logout.php">DECONNEXION</a></li>
            </ul>
        </nav>
    </header>

    <main class="sororite-detail-container">
        <h1 class="page-title">TA SORORITE</h1>

        <div class="hihi-header">
            <img src="assets/images/hihi-placeholder.png" alt="Image de la HiHi" class="hihi-avatar">
            <h2 class="hihi-name">[ NOM DE LA HIHI ]</h2>
        </div>

        <div class="hihi-content">
            <!-- Bloc des spécificités -->
            <div class="hihi-specs">
                <article class="spec-box">
                    <h3>TRAITS</h3>
                    <p>[ Spécificité 1 : Traits récupérés depuis la base de données ]</p>
                </article>

                <article class="spec-box">
                    <h3>SYMBOLIQUE</h3>
                    <p>[ Spécificité 2 : Symbolique récupérée depuis la base de données ]</p>
                </article>
            </div>

            <!-- Bloc des descriptions -->
            <div class="hihi-descriptions">
                <article class="desc-box">
                    <h3>DESCRIPTION</h3>
                    <p>[ Courte description de la HiHi en question ]</p>
                </article>

                <article class="desc-box">
                    <h3>MYTHOLOGIE</h3>
                    <p>[ Courte description de sa mythologie ]</p>
                </article>
            </div>
        </div>
    </main>
</body>

</html>
