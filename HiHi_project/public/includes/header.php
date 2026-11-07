<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'HiHi' ?> · HiHi</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <header>
        <a href="index.php">HiHi</a>
        <nav>
            <?php if (isset($_SESSION['user_id'])) { ?>
                <a href="result.php">Ma HiHi</a>
                <a href="logout.php">Se déconnecter</a>
            <?php } else { ?>
                <a href="login.php">Se connecter</a>
                <a href="signup.php">Créer un compte</a>
            <?php } ?>
        </nav>
    </header>
    <main>
