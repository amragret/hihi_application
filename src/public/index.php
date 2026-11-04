<?php
const DB_HOST = 'mariadb';
const DB_PORT = 3306;
const DB_NAME = 'my_database';
const DB_USER = 'username';
const DB_PASSWORD = 'password';

$dsn = "mysql:host=" . DB_HOST . ";port=" . DB_PORT . ";dbname=" . DB_NAME . ";charset=utf8mb4";

$pdo = new PDO($dsn, DB_USER, DB_PASSWORD);

$sql = "SELECT * FROM hihi";

$stmt = $pdo->prepare($sql);

$stmt->execute();

$results = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HiHi - Découvrez quelle poupée sommeille en vous</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <!-- En-tête / Navigation principale -->
    <header>
        <div class="logo">
            <a href="index.php">LOGO HIHI</a>
        </div>
        <nav>
            <ul>
                <li><a href="#mythologie">HIHI MYTHOLOGIE</a></li>
                <li><a href="login.php">CONNEXION</a></li>
                <li>
                    <!-- Sélecteur de langue -->
                    <select name="lang" id="lang-select">
                        <option value="fr">FR</option>
                        <option value="en">EN</option>
                    </select>
                </li>
            </ul>
            <a href="signup.php" class="btn-primary">CREER MON COMPTE</a>
        </nav>
    </header>

    <main>
        <!-- Section Héro (Bannière principale) -->
        <section class="hero">
            <div class="hero-content">
                <h1>QUELLE HIHI SOMMEILLE EN TOI ?</h1>
                <div class="hero-image-placeholder">
                    <img src="assets/images/hero-placeholder.jpg" alt="Illustration de la mythologie HiHi">
                </div>
                <a href="test.php" class="btn-large">DECOUVRE TA HIHI</a>
            </div>
        </section>

        <!-- Section des 4 Maisons / Sororités -->
        <section class="sororities">
            <h2>QUATRES HIHI, QUATRES SORORITES</h2>
            <div class="cards-container">
                <article class="card">
                    <h3>HIHI 1</h3>
                </article>
                <article class="card">

                    <h3>HIHI 2</h3>
                </article>
                <article class="card">

                    <h3>HIHI 3</h3>
                </article>
                <article class="card">
                    <h3>HIHI 4</h3>
                </article>
            </div>
        </section>

        <!-- Section Explicative -->
        <section class="how-it-works">
            <h2>COMMENT ÇA MARCHE</h2>
            <div class="steps-container">
                <div class="step">
                    <span class="step-number">1</span>
                    <p>CREE TON COMPTE</p>
                </div>
                <div class="step">
                    <span class="step-number">2</span>
                    <p>PASSE LE TEST</p>
                </div>
                <div class="step">
                    <span class="step-number">3</span>
                    <p>REJOINS TA SORORITE</p>
                </div>
            </div>
        </section>
    </main>

    <footer>
        <p>&copy; 2026 Projet HiHi - Eva Avila Muñoz & Kevin Grêt</p>
    </footer>

</body>

</html>
